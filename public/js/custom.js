$(document).ready(function () {
    let timer;
    $('#ajaxform').on('input', function (event) {
        event.preventDefault();

        // Clear the previous timer
        clearTimeout(timer);

        // Set a new timer to execute the AJAX call after 3 seconds
        timer = setTimeout(function () {
            var form = $('#ajaxform')[0];
            var data = new FormData(form);

            $.ajax({
                url: '/form',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#dbid').val(response.id);
                },
                error: function (e) { }
            });
        }, 1000);
    });
});