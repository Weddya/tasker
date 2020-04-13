$(document).ready(function() {
    $('.change-status').click(function () {
        var el = $(this);
        var status = parseInt($(this).attr('data-status'));
        var id = parseInt($(this).attr('data-id'));
        var new_status = (status === 0) ? 1 : 0;
        var json;
        $.ajax({
            type: 'POST',
            url: '/',
            data: {
                id: id,
                status: new_status,
            },
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (json.success) {
                    if (status === 1) {
                        el.text('Не выполнена');
                        el.attr('data-status', 0);
                        el.parents('tr').removeClass('table-success');
                    } else if (status === 0) {
                        el.text('Выполнена');
                        el.attr('data-status', 1);
                        el.parents('tr').addClass('table-success');
                    }
                }
            },
        });
    });
});