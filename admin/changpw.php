<!-- changpw modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="changpwModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span>เปลี่ยนรหัสผ่าน</h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="submit">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>