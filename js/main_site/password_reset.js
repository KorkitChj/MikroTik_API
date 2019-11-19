$(document).on('submit', '#password_reset', function (event) {
    event.preventDefault();
    var form = $(this);
    $.ajax({
        url: 'process/main_site/password_reset_process.php',
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        beforeSend: function () {
            $(".modalx").show();
        },
        complete: function () {
            $(".modalx").hide();
        },
        success: function (response) {
            if (response.success == true) {
                swal({
                        title: "สำเร็จ?",
                        text: response.messages,
                        type: "success",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            window.location.href =  response.link;
                        }
                    }
                );
            } else {
                swal("ผิดพลาด", response.messages, "error");
            }
        }
    });
});