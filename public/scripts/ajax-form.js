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
            success: function(result) {
                if (el.attr('id') == 'add-form') {
                    el[0].reset();
                }
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = json.url;
                } else {
                    alert(json.message);
                }
            },
        });
    });
});