'use strict';

$(function () {

    $("#form_block").submit(function (e) {

        var formURL = '/module/users/store';
        var formData = new FormData(this);

        if (window.FormData !== undefined) {

            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,
                success: function (response, textStatus, jqXHR) {
                    var msg = response;
                    $("#form_block").trigger("reset");
                    $('#datatable').bootstrapTable('refresh');
                    var alertEl = $(".message").find('.alert');
                    alertEl.removeClass('alert-danger').addClass('alert-info').html(msg).show(500);
                    setTimeout(function () {
                        alertEl.fadeOut("slow", function() {
                            alertEl.html('');
                        });
                    }, 5000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var errorMsg = 'Coś poszło nie tak!...';
                    if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                        errorMsg = jqXHR.responseJSON.message;
                    }
                    var alertEl = $(".message").find('.alert');
                    alertEl.removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
                    setTimeout(function () {
                        alertEl.fadeOut("slow", function() {
                            alertEl.html('');
                        });
                    }, 5000);
                }
            });

        }

        e.preventDefault();
    });

    var table = $('#datatable');
    table.bootstrapTable({
        url: '/module/users/grid',
        search: true,
        pagination: true,
        buttonsClass: 'primary',
        showFooter: false,
        minimumCountColumns: 2,
        columns: [{
            field: 'state',
            sortable: false,
            width: '40px',
            align: 'center',
            valign: 'middle'
        },{
            field: 'action',
            title: 'Akcja',
            sortable: false,
            class: 'action nowrap',
            width: '105px'
        }, {
            field: 'lp',
            sortable: true,
            width: '40px',
            class: 'nowrap'
        }, {
            field: 'user_id',
            sortable: true,
            width: '40px'
        }, {
            field: 'first_name',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'last_name',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'email',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'phone',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'stand_name',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'symbol',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'department',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'user_level',
            sortable: false,
            class: 'nowrap'
        }
        ]
    });

    $(table).on("click", "tr", function () {
        $(this).toggleClass("bold-blue");
    });

    var remove = $('#remove');
    var selections = []

    function getIdSelections() {
        return $.map(table.bootstrapTable('getSelections'), function (row) {
            return row.user_id
        })
    }

    function ajax_delete(item, index) {
        $.ajax
            ({
                url: '/module/users/delete/' + item,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    var msg = response;
                    $('#datatable').bootstrapTable('refresh', {
                        url: '/module/users/grid'
                    });
                    var alertEl = $(".message").find('.alert');
                    alertEl.removeClass('alert-danger').addClass('alert-info').html(msg).show(500);
                    setTimeout(function () {
                        alertEl.fadeOut("slow", function() {
                            alertEl.html('');
                        });
                    }, 5000);
                }
            });
    }

    remove.on('click', function () {
        var ids = getIdSelections();
        if (!ids.length) return;
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybranych użytkowników?', function () {
            ids.forEach(ajax_delete);
            table.bootstrapTable('remove', { field: 'user_id', values: ids });
            remove.prop('disabled', true);
        });
    });

    table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        remove.prop('disabled', !table.bootstrapTable('getSelections').length)
        selections = getIdSelections()
    })

    $(document).on('click', 'a.delete-button', function (e) {
        e.preventDefault();
        var rowid = $(this).data('id');
        var ids = [String(rowid)];
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybranego użytkownika?', function () {
            $.ajax({
                url: '/module/users/delete/' + rowid,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    table.bootstrapTable('remove', { field: 'user_id', values: ids });
                    table.bootstrapTable('refresh', { url: '/module/users/grid' });
                    var alertEl = $(".message").find('.alert');
                    alertEl.removeClass('alert-danger').addClass('alert-info').html(response).show(500);
                    setTimeout(function () { alertEl.fadeOut("slow", function() { alertEl.html(''); }); }, 5000);
                },
                error: function (jqXHR) {
                    var errorMsg = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : 'Coś poszło nie tak!...';
                    $(".message").find('.alert').removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
                    setTimeout(function () { $(".message").find('.alert').fadeOut("slow", function() { $(this).html(''); }); }, 5000);
                }
            });
        });
    });

    /*
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
    */
});
