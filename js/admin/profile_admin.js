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

function readURLProfile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#edit_profile').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function () {
    readURLProfile(this);
});

$(document).on('click', '#changeurl', function(event){
    event.preventDefault()
    var video = $("#video").val();
    if(video == ''){
        alert("กรุณากรอก URL");
    }else{
        $.ajax({
            url: '../process/admin/video_process.php',
            type: 'POST',
            data: {data:video},
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    $("#videopresentation")[0].reset();
                    $("#showVideoModal").modal('hide');
                }
            }
        });
    }
});