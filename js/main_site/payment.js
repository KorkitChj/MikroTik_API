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
                success: function (data) {
                    if (data.success == true) {
                        swal("สำเร็จ", data.messages, "success");
                        $("#s_payment")[0].reset();
                        setTimeout(function () {
                            window.location = data.link;
                        }, 2000);
                    } else {
                        swal("ผิดพลาด", data.messages, "error");
                        $("#s_payment")[0].reset();
                        if (data.messages == "คุณสามารถซื้อได้1รายการ") {
                            setTimeout(function () {
                                window.location = data.link;
                            }, 3000);
                        } else if (data.messages == "คุณยังไม่ได้ลงทะเบียน") {
                            setTimeout(function () {
                                window.location = data.link;
                            }, 3000);
                        } else {

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
