$(document).ready(function() {
    $('form').submit(function(event) {
        var el = $(this);
        var json;
        event.preventDefault();
        $.ajax({
            type: el.attr('method'),
            url: el.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function(err) {
                if (err.status == 403) {
                    $('#ajax-message div.alert').remove();
                    $('#ajax-message').append(
                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка:</strong> Требуется авторизация!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
                }
            },
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (el.attr('id') == 'add-form' && json.status == 'success') {
                    el[0].reset();
                }

                if (json.url) {
                    window.location.href = json.url;
                } else {
                    $('#ajax-message div.alert').remove();
                    let ajax_status = json.status ? json.status : 'info';
                    $('#ajax-message').append(
                    `<div class="alert alert-` + ajax_status + ` alert-dismissible fade show" role="alert">
                        ` + json.message + `
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
                }
            },
        });
    });
});