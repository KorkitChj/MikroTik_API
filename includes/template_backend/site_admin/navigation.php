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
                <div id="load"><?php echo fetchimage($_SESSION["cus_id"]); ?></div>
            </div>
            <div class="user-info">
                <span class="user-name">
                    <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span>&nbsp;<?php print_r($_SESSION["cus_name"]); ?></a></strong>
                </span>
                <span class="user-role">ผู้ดูแล</span>
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
                <li class="<?php if ($CURRENT_PAGE == "connectstatus") { ?>pad-a<?php } ?>">
                    <a href="connect_status">
                        <i class="glyphicon glyphicon-home"></i>&nbsp;เชื่อมต่อ Site</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "invoice") { ?>pad-a<?php } ?>">
                    <a href="invoice">
                        <i class="glyphicon glyphicon-file"></i>&nbsp;ใบเสร็จ</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "orderreport") { ?>pad-a<?php } ?>">
                    <a href="order_report">
                        <i class="glyphicon glyphicon-signal"></i>&nbsp;รายงานสั่งซื้อ</a>
                </li>
                <li>
                    <a href="" data-toggle="modal" data-target="#changpwModal">
                        <i class="glyphicon glyphicon-edit"></i>
                        เปลี่ยนรหัสผ่าน</a>
                </li>
                <li>
                    <a href="" data-toggle="modal" data-target="#exampleModal" id="btnPacket">
                        <i class="fab fa-get-pocket"></i>&nbsp;อัพเดท Packet</a>
                </li>
                <li>
                    <a href="" data-toggle="modal" data-target="#addImageModal" id="addImageModalBtn">
                        <i class="fas fa-user-plus"></i>&nbsp;แก้ไข Profile </a>
                </li>
                <li>
                    <a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;
                        Logout</a>
                </li>
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
</nav>
<div class="modal fade" tabindex="-1" role="dialog" id="addImageModal">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content">
            <form id="formimage" action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-user-plus"></span>Add Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="col-sm control-label">Add Image:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                    </div>
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img id="add_profile" src="#" alt="your image" class="img-fluid rounded shadow-lg p-3 mb-5 bg-white" alt="Responsive image" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                        <button type="submit" class="btn btn-success" id="addImageBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content">
            <form id="packet_form" action="" enctype="multipart/form-data" name="form1" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">อัพเดท Packet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <strong>
                                        <div class="bg-warning">นายก่อกิจ ชูจำ ธ.ไทยพาณิชย์ 123456890 ออมทรัพย์<br>นายก่อกิจ ชูจำ ธ.กรุงไทย 223344556 ออมทรัพย์</div>
                                    </strong>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h6>เวลาที่ต้องการเพิ่ม:&nbsp;</h6>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" value="200" name="days" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadioInline1">1 เดือน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" value="400" name="days" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadioInline2">2 เดือน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline3" value="600" name="days" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadioInline3">5 เดือน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline4" value="1000" name="days" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadioInline4">1 ปี</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline5" value="1800" name="days" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadioInline5">2 ปี</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bank_info" class="control-label col-sm">ธนาคาร:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-university"></i>
                                        </div>
                                    </div>
                                    <select name="bank" id="bank" class="form-control bank_info" required>
                                        <option value="">----- เลือกธนาคาร-----</option>
                                        <option value="1">ธนาคารไทยพาญิชย์</option>
                                        <option value="2">ธนาคารกรุงไทย</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="control-label col-sm">เวลาชำระ:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="datetime-local" class="form-control" id="date" name="date" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="money" class="control-label col-sm">จำนวนเงิน:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-money-check-alt"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="money" placeholder="จำนวนเงิน" class="form-control" id="money" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fileslip" class="col-sm control-label">File:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="far fa-file-image"></i>
                                        </div>
                                    </div>
                                    <input type="file" name="fileslip" id="fileslip" onchange="readURL(this);" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img id="blah" src="#" alt="your image" class="img-fluid rounded shadow-lg p-3 mb-5 bg-white" alt="Responsive image" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" id="updatepacket" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/site_admin/site_image.js"></script>
<script>
    $('input[name=days]').change(function() {
        var value = $('input[name=days]:checked').val();
        $('#money').attr('value', value)
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLAddProfile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#add_profile').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        readURLAddProfile(this);
    });
</script>