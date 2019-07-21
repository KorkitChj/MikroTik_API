<!-- changpw modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="changpwModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>&nbsp;เปลี่ยนรหัสผ่าน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="changpw" name="contact" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputoldpassword" class="control-label col-sm">รหัสผ่านเก่า:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="รหัสผ่านเก่า" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputnewpassword" class="control-label col-sm">รหัสผ่านใหม่:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="รหัสผ่านใหม่" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputrenewpassword" class="control-label col-sm">ยืนยันรหัสผ่านใหม่:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="renewpassword" id="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                    <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </form>
        </div>
    </div>
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

        $(".logout").click(function() {
            swal({
                    title: "ออกจากระบบ?",
                    text: "คุณกำลังจะออกจากระบบ!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("ออกจากระบบ!", "ออกจากระบบเสร็จสิ้น!", "success");
                        window.location.href = "cus_logout.php";
                    } else {
                        swal("ยกเลิก", "ยกเลิกออกจากระบบ :)", "error");
                        e.preventDefault();
                    }
                });
        });
    });

    var validateSignupForm = function() {
        var changpwModal = $('#changpwModal');
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
                ajaxRequest.fail(function(data, status, errorThrown) {
                    changpwModal.modal('hide');
                });
                ajaxRequest.done(function(response) {
                    changpwModal.modal('hide');
                });
            }
            e.preventDefault();
            e.stopPropagation();
        });
        changpwModal.on('hide.bs.modal', function(e) {
            changpw.validate().resetForm();
            changpw.trigger('reset');
        });
    }
</script>