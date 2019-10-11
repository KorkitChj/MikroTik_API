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
                    <a href="connectstatus.php">
                        <i class="glyphicon glyphicon-home"></i>&nbsp;เชื่อมต่อ Site</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "invoice") { ?>pad-a<?php } ?>">
                    <a href="invoice.php">
                        <i class="glyphicon glyphicon-paperclip"></i>&nbsp;Invoice</a>
                </li>
                <li>
                    <a href="" data-toggle="modal" data-target="#changpwModal">
                        <i class="glyphicon glyphicon-edit"></i>
                        เปลี่ยนรหัสผ่าน</a>
                </li>
                <!-- <li>
                    <a href="" data-toggle="modal" data-target="#exampleModal" id="btnPacket">
                        <i class="fab fa-get-pocket"></i>&nbsp;
                        แจ้งอัพเดท Packet</a>
                </li> -->
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formimage" action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-user-plus"></span>Add Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="submit" class="btn btn-success" id="addImageBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="packet_form" action="" enctype="multipart/form-data" name="form1" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แจ้งอัพเดท Packet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 style="color:red">Packet ที่ใช้งานอยู่คือ </h4>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" value="3" name="customRadioInline1" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline3">เปลี่ยน Packet เป็นราคา 200 บาท</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" value="2" name="customRadioInline1" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline4">เปลี่ยน Packet เป็นราคา 300 บาท</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline6" value="3" name="customRadioInline1" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline6">เปลี่ยน Packet เป็นราคา 500 บาท</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline9" value="4" name="customRadioInline1" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline9">เปลี่ยน Packet เป็นราคา 1000 บาท</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline10" value="5" name="customRadioInline1" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline10">เปลี่ยน Packet เป็นราคา 1500 บาท</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline11" value="6" name="customRadioInline1" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline11">เปลี่ยน Packet เป็นราคา 2000 บาท</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" id="updatepacket" class="btn btn-primary">บันทึก</button>
                        </div>
                </form>
            <form id="packet_form" action="" enctype="multipart/form-data" name="form1" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แจ้งอัพเดท Packet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 style="color:red">Packet ที่ใช้งานอยู่คือ </h4>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" value="2" name="customRadioInline1" class="custom-control-input" required>
                        <label class="custom-control-label" for="customRadioInline1">เปลี่ยน Packet เป็นราคา 1000 บาท</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" value="1" name="customRadioInline1" class="custom-control-input" required>
                        <label class="custom-control-label" for="customRadioInline2">เปลี่ยน Packet เป็นราคา 500 บาท</label>
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
                                <option value="3">ธนาคารกสิกรไทย</option>
                                <option value="4">ธนาคารกรุงเทพ</option>
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
                            <input type="number" name="money" placeholder="จำนวนเงิน" class="form-control" id="money" required>
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
                            <input type="file" name="fileslip" id="fileslip">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" id="updatepacket" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<script src="../js/site_admin/site_image.js"></script>