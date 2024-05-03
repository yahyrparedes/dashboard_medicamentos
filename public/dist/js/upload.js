const input = document.querySelector("input[type=file]");

$(function () {
    $(document).on('change', 'input[type="file"]', function (e) {
        var file = e.currentTarget.files[0];
        var filesize = ((file.size / 1024) / 1024).toFixed(4); // MB
        if (filesize > 1) {
            e.currentTarget.value = null;
            alert('Limite maximo permitido 1 MB');
        }
    });
});
