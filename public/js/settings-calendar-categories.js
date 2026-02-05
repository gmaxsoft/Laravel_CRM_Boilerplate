'use strict';

$(function () {
    var table = $('#datatable');
    var gridUrl = '/module/settings/calendar-categories/grid';
    table.bootstrapTable({
        url: gridUrl,
        search: true,
        pagination: true,
        buttonsClass: 'primary',
        showFooter: false,
        minimumCountColumns: 2,
        columns: [{
            field: 'cal_cat_id',
            sortable: true,
            width: '80px'
        }, {
            field: 'cal_cat_name',
            sortable: true,
        }, {
            field: 'cal_cat_value',
            sortable: true,
        }, {
            field: 'action',
            sortable: false,
            width: '105px'
        }]
    });

    $("#form_block").submit(function (e) {
        var formURL = window.location.pathname;
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
                    var msg = response.success || 'Kategoria została dodana!';
                    $("#form_block").trigger("reset");
                    $('#datatable').bootstrapTable('refresh');
                    $(".message").find('.alert').html(msg).show(500);
                    setTimeout(function () {
                        $(".message").find('.alert').fadeOut("slow");
                    }, 5000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var errors = jqXHR.responseJSON?.errors || {};
                    var errorMsg = 'Wystąpił błąd!';
                    if (Object.keys(errors).length > 0) {
                        errorMsg = Object.values(errors).flat().join('<br>');
                    }
                    $(".message").find('.alert').removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
                }
            });
        }

        e.preventDefault();
    });

    $(document).on('click', 'a.delete-button', function (e) {
        e.preventDefault();
        var rowid = $(this).data('id');
        var ids = [String(rowid)];
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybraną kategorię?', function () {
            $.ajax({
                url: window.location.origin + '/module/settings/calendar-categories/' + rowid,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'DELETE',
                success: function (response) {
                    var msg = response.message || 'Kategoria została usunięta!';
                    table.bootstrapTable('remove', { field: 'cal_cat_id', values: ids });
                    table.bootstrapTable('refresh', { url: gridUrl });
                    $(".message").find('.alert').removeClass('alert-danger').addClass('alert-info').html(msg).show(500);
                    setTimeout(function () { $(".message").find('.alert').fadeOut("slow"); }, 5000);
                },
                error: function () {
                    $(".message").find('.alert').removeClass('alert-info').addClass('alert-danger').html('Wystąpił błąd podczas usuwania!').show(500);
                }
            });
        });
    });

    $('#datatable').on('reorder-row.bs.table', function (e, data) {
        JSON.stringify($(this).bootstrapTable('getData').map(function (row, i) {
            $.post('/module/settings/calendar-categories/order', {
                id: row.cal_cat_id,
                position: i,
                _token: $('meta[name="csrf-token"]').attr('content')
            });
        }))
    });
});
