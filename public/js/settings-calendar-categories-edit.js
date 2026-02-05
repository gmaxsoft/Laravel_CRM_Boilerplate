'use strict';

$(function () {
    var categoryId = $('#edit_id').val();
    $("#form_block").submit(function (e) {
        var formURL = window.location.pathname.replace('/edit', '');
        var formData = new FormData(this);

        if (window.FormData !== undefined) {
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                contentType: false,
                cache: false,
                processData: false,
                success: function (response, textStatus, jqXHR) {
                    var msg = response.success || 'Kategoria została zaktualizowana!';
                    $(".message").find('.alert').removeClass('alert-danger').addClass('alert-info').html(msg).show(500);
                    setTimeout(function () {
                        window.location.href = '/module/settings/calendar-categories';
                    }, 1500);
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

    $('.backtolist').on('click', function () {
        window.location.href = '/module/settings/calendar-categories';
    });
});
