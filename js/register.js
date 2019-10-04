$(document).on('submit', '#register', function (event) {
    event.preventDefault();
    var form = $(this);
    $.ajax({
        url: 's_register.php',
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
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
                            window.location.href = 'payment.php';
                        }
                    }
                );
            } else {
                swal("ผิดพลาด", response.messages, "error");
            }
        },
        beforeSend: function () { }
    });
});