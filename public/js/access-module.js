'use strict';

$(function () {

    var table = $('#datatable');
    var columns = [];
    if ($('#remove').length) {
        columns.push({ field: 'state', sortable: false, width: '40px', align: 'center', valign: 'middle' });
    }
    columns.push(
        { field: 'id', title: 'Id', sortable: true, width: '80px' },
        { field: 'name', title: 'Nazwa', sortable: true },
        { field: 'level', title: 'Poziom', sortable: true },
        { field: 'action', title: 'Akcja', sortable: false, width: '105px' }
    );
    table.bootstrapTable({
        url: '/module/access/grid',
        search: true,
        pagination: true,
        buttonsClass: 'primary',
        showFooter: false,
        minimumCountColumns: 2,
        columns: columns
    });

    $("#form_block").submit(function (e) {

        var formURL = '/module/access/store';
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

    var remove = $('#remove');
    function getIdSelections() {
        return $.map(table.bootstrapTable('getSelections'), function (row) { return row.id; });
    }
    function ajax_delete(item) {
        $.ajax({
            url: '/module/access/delete/' + item,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                $('#datatable').bootstrapTable('refresh', { url: '/module/access/grid' });
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
    }
    remove.on('click', function () {
        var ids = getIdSelections();
        if (!ids.length) return;
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybrane uprawnienia?', function () {
            ids.forEach(ajax_delete);
            table.bootstrapTable('remove', { field: 'id', values: ids });
            remove.prop('disabled', true);
        });
    });
    table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        remove.prop('disabled', !table.bootstrapTable('getSelections').length);
    });

    $(document).on('click', 'a.delete-button', function (e) {
        e.preventDefault();
        var rowid = $(this).data('id');
        var ids = [String(rowid)];
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć wybrane uprawnienie?', function () {
            $.ajax({
                url: '/module/access/delete/' + rowid,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    table.bootstrapTable('remove', { field: 'id', values: ids });
                    table.bootstrapTable('refresh', { url: '/module/access/grid' });
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
