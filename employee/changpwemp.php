<?php
session_start();
include("../includes/template_backend/employee/page_link_config.php");
if (!$_SESSION["emp_id"]) {
    Header("Location:../index.php");
}
include('function.php');

$emp_id = $_SESSION['emp_id'];

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/employee/navigation.php"); ?>
        <main class="page-content">
            <div class="container-fluid">
            <h5><i class="glyphicon glyphicon-edit"></i> เปลี่ยนรหัสผ่าน</h5>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="box">
                            <form id="changpw" action="" method="post">
                                <div class="form-group">
                                    <label for="oldpassword" class="control-label col-sm">รหัสผ่านเก่า:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="รหัสผ่านเก่า">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword" class="control-label col-sm">รหัสผ่านใหม่:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="รหัสผ่านใหม่">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="renewpassword" class="control-label col-sm">ยืนยันรหัสผ่านใหม่:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="renewpassword" id="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm"></label>
                                    <div class="col-sm-12 input-group">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="history.back();"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>&nbsp;
                                        <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>&nbsp;
                                        <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
    <script>
        $.validation = {
            messages: {}
        };

        $.extend($.validation.messages, {
            required: '<i class="fa fa-exclamation-circle"></i> required.',
            signup_confirm_password: '<i class="fa fa-exclamation-circle"></i> Confirm password must match the password.'
        });

        $(document).ready(function() {
            validateSignupForm();
        });

        var validateSignupForm = function() {
            var changpw = $('#changpw');

            changpw.validate({
                rules: {
                    oldpassword: {
                        required: true
                    },
                    newpassword: {
                        required: true,
                        minlength: 8
                    },
                    renewpassword: {
                        required: true,
                        minlength: 8,
                        equalTo: '#newpassword'
                    }
                },
                messages: {
                    oldpassword: {
                        required: $.validation.messages.required
                    },
                    newpassword: {
                        required: $.validation.messages.required
                    },
                    renewpassword: {
                        required: $.validation.messages.required,
                        equalTo: $.validation.messages.signup_confirm_password
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

            changpw.on('submit', function(e) {
                if (changpw.valid()) {
                    var form = $(this);
                    var ajaxRequest = $.ajax({
                        url: '../process/site_emp/changpw_process.php',
                        type: 'POST',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                swal("สำเร็จ", response.messages, "success");
                                $("#changpw")[0].reset();
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
</body>

</html>