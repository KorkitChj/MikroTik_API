$(document).on('submit', '#transfer', function (event) {
    event.preventDefault();
    var username = $("#username2").val();
    var date = $("#date").val();
    var bank = $("#bank").val();
    var money = $("#money").val();
    var file = $("#file").val();
    if (username != '' && date != '' && bank != '' && money != '' && file != '') {
        $.ajax({
            url: "process/main_site/transfer_process.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.success == "success") {
                    swal({
                            title: "สำเร็จ?",
                            text: data.messages,
                            type: "success",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "OK",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                $("#transfer")[0].reset();
                                window.location.href = 'home';
                            }
                        }
                    );
                } else if (data.success == "fail") {
                    swal({
                            title: "ไม่สำเร็จ?",
                            text: data.messages,
                            type: "error",
                            confirmButtonColor: "#FF0000",
                            confirmButtonText: "OK",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                $("#transfer")[0].reset();
                                window.location.href = 'home';
                            }
                        });
                } else {
                    swal("ผิดพลาด", data.messages, "home");
                }
            }
        });
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function () {
    readURL(this);
});