'use strict';

$(function () {

    $("#form_block").submit(function (e) {

        var formURL = '/module/customers/store';
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
        url: '/module/customers/grid',
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
            field: 'customers_id',
            sortable: true,
            width: '40px'
        }, {
            field: 'customers_code',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_firmname',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_firstname',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_lastname',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_nip',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_email',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_phone',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_area',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'customers_postcode',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_county',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'customers_trader_id',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'customers_rodo',
            sortable: false,
            class: 'nowrap'
        }, {
            field: 'customers_re_contact_date',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_agricultural_land',
            sortable: true,
            class: 'nowrap'
        }, {
            field: 'customers_legalform',
            sortable: false,
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
            return row.customers_id
        })
    }

    function ajax_delete(item, index) {
        $.ajax
            ({
                url: '/module/customers/delete/' + item,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    var msg = response;
                    $('#datatable').bootstrapTable('refresh', {
                        url: '/module/customers/grid'
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
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybranych klientów?', function () {
            ids.forEach(ajax_delete);
            table.bootstrapTable('remove', { field: 'customers_id', values: ids });
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
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybranego klienta?', function () {
            $.ajax({
                url: '/module/customers/delete/' + rowid,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    table.bootstrapTable('remove', { field: 'customers_id', values: ids });
                    table.bootstrapTable('refresh', { url: '/module/customers/grid' });
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
