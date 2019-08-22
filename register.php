<?php
session_start();
?>
<?php
require('template/template_login&register.html');
if (!$_SESSION["order"]) {
    Header("Location:products.php");
} else { ?>
    <title>Register</title>
    <div class="container" style="width:100%; max-width:800px">
        <div class="row ">
            <div class="col">
                <div class="card text-white bg-info border-danger">
                    <div class="card-header">
                        <p align="center">Register</p>
                    </div>
                    <div class="card-body">
                        <form id="register" action="" method="">
                            <div class="form-row">
                                <div class="col">
                                    <label for="username" class="control-label col-sm">Username:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="password" class="control-label col-sm">Password:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="fullname" class="control-label col-sm">ชื่อ-สกุล:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-badge"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="ชื่อ-สกุล">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="email" class="control-label col-sm">E-mail Address:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope-square"></i>
                                            </div>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="number" class="control-label col-sm">หมายเลขโทรศัพท์:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone-square"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="number" name="number" placeholder="หมายเลขโทรศัพท์">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="site" class="control-label col-sm">ชื่อสถานที่ตั้ง:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-location-arrow"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="site" name="site" placeholder="ชื่อสถานที่ตั้ง">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="address" class="control-label col-sm">ที่อยู่:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-at"></i>
                                            </div>
                                        </div>
                                        <textarea id="address" name="address" class="form-control" placeholder="ที่อยู่"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="col-sm-12">
                                        <hr />
                                        <button type="submit" id="registerBtn" name="registerBtn" class="btn btn-primary">สมัครสมาชิก</button>
                                        <button type="reset" name="reset" class="btn btn-warning">รีเซ็ต</button>
                                        <button type="bottom" class="btn btn-danger" onclick="window.history.back()">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.validation = {
            messages: {}
        };

        $.extend($.validation.messages, {
            required: '<i class="fa fa-exclamation-circle"></i> required.'
        });

        $(document).ready(function() {
            validateSignupForm();
        });

        var validateSignupForm = function() {
            var register = $('#register');

            register.validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    number: {
                        required: true
                    },
                    site: {
                        required: true
                    },
                    address: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: $.validation.messages.required
                    },
                    password: {
                        required: $.validation.messages.required
                    },
                    fullname: {
                        required: $.validation.messages.required
                    },
                    email: {
                        required: $.validation.messages.required
                    },
                    number: {
                        required: $.validation.messages.required
                    },
                    site: {
                        required: $.validation.messages.required
                    },
                    address: {
                        required: $.validation.messages.required
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);

                    $(window).resize(function() {
                        error.remove();
                    });
                },
                invalidHandler: function(event, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {} else {}
                }
            });

            register.on('submit', function(e) {
                if (register.valid()) {
                    var form = $(this);
                    var ajaxRequest = $.ajax({
                        url: 's_register.php',
                        type: 'POST',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                swal({
                                        title: "สำเร็จ?",
                                        text: response.messages,
                                        type: "success",
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            window.location.href = 'payment.php';
                                        }
                                    }
                                );
                            } else {
                                swal("ผิดพลาด", response.messages, "error");
                            }
                        },
                        beforeSend: function() {}
                    });
                }
                e.preventDefault();
                e.stopPropagation();
            });
        }
    </script>
<?php } ?>