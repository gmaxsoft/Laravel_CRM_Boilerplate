'use strict';

$(function () {

    $("#form_block").submit(function (e) {

        var formURL = '/module/advertisements/store';
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
                    } else if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                        var errors = [];
                        $.each(jqXHR.responseJSON.errors, function(key, value) {
                            errors.push(value[0]);
                        });
                        errorMsg = errors.join('<br>');
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
        url: '/module/advertisements/grid',
        search: true,
        pagination: true,
        buttonsClass: 'primary',
        showFooter: false,
        minimumCountColumns: 2,
        pageSize: 15,
        pageList: [15, 25, 50, 100, 500, 1000],
        columns: [{
            field: 'state',
            sortable: false,
            width: '40px',
            align: 'center',
            valign: 'middle'
        }, {
            field: 'lp',
            sortable: true,
            width: '40px',
            class: 'nowrap'
        }, {
            field: 'adv_id',
            sortable: true,
            width: '40px'
        }, {
            field: 'action',
            title: 'Akcja',
            sortable: false,
            class: 'action nowrap',
            width: '105px'
        }, {
            field: 'adv_status',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'adv_reservation',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'adv_machine_type',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'adv_producer',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'adv_model',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_year',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_serial_number',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_state',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'adv_reservation_user_id',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'adv_location',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_production_date',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_price_netto',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_price',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_register',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'adv_created_at',
            sortable: true,
            class: 'nowrap'
        }]
    });

    $(table).on("click", "tr", function () {
        $(this).toggleClass("bold-blue");
    });

    var remove = $('#remove');
    var selections = []

    function getIdSelections() {
        return $.map(table.bootstrapTable('getSelections'), function (row) {
            return row.adv_id
        })
    }

    function ajax_delete(item, index) {
        $.ajax
            ({
                url: '/module/advertisements/delete/' + item,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    var msg = response;
                    $('#datatable').bootstrapTable('refresh', {
                        url: '/module/advertisements/grid'
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
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybrane ogłoszenia?', function () {
            ids.forEach(ajax_delete);
            table.bootstrapTable('remove', { field: 'adv_id', values: ids });
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
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybrane ogłoszenie?', function () {
            $.ajax({
                url: '/module/advertisements/delete/' + rowid,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    table.bootstrapTable('remove', { field: 'adv_id', values: ids });
                    table.bootstrapTable('refresh', { url: '/module/advertisements/grid' });
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
