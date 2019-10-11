$("#addImageModalBtn").click(function () {
    $("#formimage")[0].reset();
    $("#formimage").off('submit').on('submit', function () {
        var form = $(this);
        var extension = $('#image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                swal("ผิดพลาด", "Invalid Image File", "error");
                $('#image').val('');
                return false;
            }
        }
        var image = $("#image").val();
        if (image) {
            $.ajax({
                url: '../process/admin/profile_process.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        $("#formimage")[0].reset();
                        $("#load").load(location.href + " #load>*", "");
                        $("#addImageModal").modal('hide');
                    }
                }
            });
        }
        return false;
    });
});