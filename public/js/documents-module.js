'use strict';

$(function () {
    var table = $('#datatable');
    var gridUrl = '/module/documents/grid';

    table.bootstrapTable({
        url: gridUrl,
        search: true,
        pagination: true,
        buttonsClass: 'primary',
        showFooter: false,
        minimumCountColumns: 2,
        columns: [
            { field: 'id', sortable: true, width: '60px' },
            { field: 'original_name', sortable: true },
            { field: 'size', sortable: true, width: '90px' },
            { field: 'mime_type', sortable: true, width: '120px' },
            { field: 'uploaded_by', sortable: true },
            { field: 'created_at', sortable: true, width: '140px' },
            { field: 'action', sortable: false, width: '120px' }
        ]
    });

    $('#form_upload').submit(function (e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);

        $.ajax({
            url: '/module/documents/store',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var msg = response.success || 'Plik został przesłany.';
                form.reset();
                table.bootstrapTable('refresh');
                $('.message').find('.alert').removeClass('alert-danger').addClass('alert-info').html(msg).show(500);
                setTimeout(function () {
                    $('.message').find('.alert').fadeOut('slow');
                }, 5000);
            },
            error: function (jqXHR) {
                var errors = jqXHR.responseJSON && jqXHR.responseJSON.errors;
                var errorMsg = 'Wystąpił błąd podczas przesyłania.';
                if (errors && typeof errors === 'object') {
                    errorMsg = Object.values(errors).flat().join('<br>');
                }
                $('.message').find('.alert').removeClass('alert-info').addClass('alert-danger').html(errorMsg).show(500);
            }
        });
    });

    $(document).on('click', 'a.delete-button', function (e) {
        e.preventDefault();
        var rowid = $(this).data('id');
        window.showConfirmModal('Usuwanie', 'Czy na pewno chcesz usunąć ten plik?', function () {
            $.ajax({
                url: '/module/documents/delete/' + rowid,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'POST',
                success: function (response) {
                    var msg = response.message || response || 'Plik został usunięty.';
                    table.bootstrapTable('refresh');
                    $('.message').find('.alert').removeClass('alert-danger').addClass('alert-info').html(msg).show(500);
                    setTimeout(function () { $('.message').find('.alert').fadeOut('slow'); }, 5000);
                },
                error: function () {
                    $('.message').find('.alert').removeClass('alert-info').addClass('alert-danger').html('Wystąpił błąd podczas usuwania.').show(500);
                }
            });
        });
    });
});
