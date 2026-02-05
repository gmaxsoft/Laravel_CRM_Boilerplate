'use strict';

$(function () {

    var table = $('#datatable');
    table.bootstrapTable({
        url: '/module/calendar/grid',
        search: true,
        pagination: true,
        buttonsClass: 'primary',
        showFooter: false,
        minimumCountColumns: 2,
        columns: [{
            field: 'state',
            title: '',
            sortable: false,
            width: '40px',
            align: 'center',
            valign: 'middle'
        }, {
            field: 'lp',
            sortable: true,
            width: '40px'
        }, {
            field: 'cal_id',
            sortable: true,
            width: '40px'
        }, {
            field: 'cal_name',
            sortable: true,
        }, {
            field: 'cal_category',
            sortable: true,
        }, {
            field: 'cal_start',
            sortable: true,
        }, {
            field: 'cal_end',
            sortable: true,
        }, {
            field: 'cal_annotations',
            sortable: false,
        }, {
            field: 'cal_user_id',
            sortable: true,
        }, {
            field: 'created_at',
            sortable: true,
        }, {
            field: 'action',
            sortable: false,
            class: 'action',
            width: '105px'
        }]
    });

    var remove = $('#remove');
    var selections = []

    function getIdSelections() {
        return $.map(table.bootstrapTable('getSelections'), function (row) {
            return row.cal_id
        })
    }

    function ajax_delete(item, index) {
        $.ajax
            ({
                url: '/module/calendar/delete/' + item,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    var msg = response;
                    $('#datatable').bootstrapTable('refresh', {
                        url: '/module/calendar/grid'
                    });
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

    remove.on('click', function () {
        var ids = getIdSelections();
        if (!ids.length) return;
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybrane wydarzenia?', function () {
            ids.forEach(ajax_delete);
            table.bootstrapTable('remove', { field: 'cal_id', values: ids });
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
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybrane wydarzenie?', function () {
            $.ajax({
                url: '/module/calendar/delete/' + rowid,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    table.bootstrapTable('remove', { field: 'cal_id', values: ids });
                    table.bootstrapTable('refresh', { url: '/module/calendar/grid' });
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
});
