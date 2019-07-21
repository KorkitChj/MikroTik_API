<?php
session_start();
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Chang Password Employee</title>
    <?php
    require('../template/template.html');
    ?>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Web API MikroTik</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img src="../img/iconuser.jpg" alt="user" style="height:70px;width:60px">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Employee</span>&nbsp;<?php print_r($_SESSION["emp_name"]); ?></a></strong>
                        </span>
                        <span class="user-role">พนักงาน</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>ทั่วไป</span>
                        </li>
                        <li>
                            <a href="employee.php">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                        </li>
                        <li class="pad-a bor-green">
                            <a href="">
                                <i class="glyphicon glyphicon-edit"></i>&nbsp;
                                เปลี่ยนรหัสผ่าน</a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#" class="logout">
                    <i class="fas fa-sign-out-alt">ออกจากระบบ</i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2><i class="glyphicon glyphicon-edit"></i> เปลี่ยนรหัสผ่าน</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
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
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="history.back();"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
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
                        minlength:8
                    },
                    renewpassword: {
                        required: true,
                        minlength:8,
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
                        url: 's_changpw.php',
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
    <script src="../js/logout.js"></script>
<?php } ?>