'use strict';

$(function () {

    $("#form_block").submit(function (e) {

        var formURL = '/module/access/update/' + $('#edit_id').val();
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

    $(".backtolist").on('click', function () {
        window.location = "/module/access/";
    });

});
