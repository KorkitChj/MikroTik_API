<!-- changpw modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="changpwModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>&nbsp;เปลี่ยนรหัสผ่าน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="myform" name="contact" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputoldpassword" class="control-label col-sm">รหัสผ่านเก่า:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="oldpassword" placeholder="รหัสผ่านเก่า" required>
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
                            <input type="password" class="form-control" name="newpassword" placeholder="รหัสผ่านใหม่" required>
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
                            <input type="password" class="form-control" name="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
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
    $(document).ready(function() {
        $("#myform").submit(function(event) {
            submitForm();
            return false;
        });

        function submitForm() {
            $.ajax({
                type: "POST",
                url: "s_changpw.php",
                cache: false,
                data: $('form#myform').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#changpwModal").modal('hide');
                    } else {
                        $('input[type="password"]').val('');
                        swal("ผิดพลาด", response.messages, "error");
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        }
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
</script>