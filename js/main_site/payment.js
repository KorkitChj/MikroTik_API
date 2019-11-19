$(document).ready(function () {
    $(document).on('submit', 'form#s_payment', function (event) {
        event.preventDefault();
        var form = $(this);
        var name = $("#name").val();
        var date = $("#datetime").val();
        var order_price = $("#order_price").val();
        //console.log(submit);
        //return false;
        if (name != '' && date != '' && order_price != '') {
            $.ajax({
                url: "process/main_site/payment_process.php?post=confirm",
                method: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $(".modalx").show();
                },
                complete: function () {
                    $(".modalx").hide();
                },
                success: function (data) {
                    if (data.success == true) {
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
                                    $("#s_payment")[0].reset();
                                    window.location = data.link;
                                }
                            });

                    } else {
                        if (data.messages == "คุณสามารถซื้อได้1รายการ") {
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
                                        $("#s_payment")[0].reset();
                                        window.location = data.link;
                                    }
                                });
                        } else if (data.messages == "คุณยังไม่ได้ลงทะเบียน") {
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
                                        $("#s_payment")[0].reset();
                                        window.location = data.link;
                                    }
                                });
                        }
                    }
                }
            });
        }
    });
    /*$(window).on("load", function () {
        var ab = $("select.custom-select option:selected").val();
        $('#order_price').attr('value', ab)
    });
    $("select.custom-select").change(function () {
        var selectedit = $(this).children("option:selected").val();
        $('#order_price').attr('value', selectedit)
    });*/
});