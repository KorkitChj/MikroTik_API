<?php
session_start();
//require('../site/conn.php');
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <style>
        th {
            color: darkblue;
        }

        td {
            color: white;
        }

        table.dataTable thead th {
            border-bottom: 0;
        }

        .pad-a {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .bg-info {
            background: #bdc3c7;
            background: linear-gradient(to bottom, #bdc3c7, #2c3e50);
            background: -webkit-linear-gradient(to bottom, #2c3e50, #bdc3c7);
        }
    </style>
    <title>User Online</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="employee.php"><span style="color:White">Employee</span><span style="color:blue">|</span><?php print_r($_SESSION["emp_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active pad-a">
                                <a href="#" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    สถานะ User</a>
                            </li>
                            <li class="nav-item pad">
                                <a href="adduser.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    เพิ่ม User ครั้งละ 1คน</a>
                            </li>
                            <li class="nav-item pad">
                                <a href="addusergroup.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    เพิ่ม User ครั้งละเป็นกลุ่ม</a>
                            </li>
                            <!-- <li class="nav-item pad">
                                                                            <a href="printuser.php" class="nav-link ">
                                                                                <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                                                                คูปอง</a>
                                                                        </li> -->
                            <li class="nav-item pad">
                                <a href="emp_logout.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <!--หน้าถัดจากBrandner-->
                <p>
                    <h3 style="font-weight:bold;margin-top:1em;color:white">Users</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <button type="button" style="margin-left:1em" class="btn btn-light" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add Member
                </button>
                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#addMemberGroup" id="addMemberModalBtnGroup">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add Member Group
                </button>
                <button onClick="return confirm('คุณต้องการที่จะลบข้อมูลที่เลือกนี้หรือไม่ ?');" class="btn btn-danger" style="margin-right:1em" name="del_all" data-toggle="modal" data-target="#DelMemberGroup" id="DelMemberModalBtnGroup">
                    <span class="glyphicon glyphicon-remove"></span> ลบข้อมูลแถวที่เลือก
                </button>

                <table id="manageMemberTable" class="table table-striped table-sm" style="width:100%">
                    <thead class="bg-info">
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Server</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Profile</th>
                            <th>Limit-UpTime</th>
                            <th>UpTime</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- add modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <form class="form-horizontal" action="adduser.php" method="POST" id="createMemberForm">

                        <div class="modal-body">
                            <div class="messages"></div>

                            <div class="form-group row">
                                <label for="inputname" class="col-sm-3 col-form-label">Name: </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control " id="name" name="name" placeholder="ชื่อลูกค้า" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputpassword" class="col-sm-3 col-form-label">Password:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcomment" class="col-sm-3 col-form-label">Comment:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="comment" name="comment" placeholder="แสดงความคิดเห็น" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputprofile" class="col-sm-3 col-form-label">Profile:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="profile" name="profile">
                                        <option>1d</option>
                                        <option>2d</option>
                                        <option>3d</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputuptime" class="col-sm-3 col-form-label">Limit Up-Time:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="limituptime" name="limituptime" placeholder="Up Time" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /add modal -->

        <!-- remove modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove Member</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to remove ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /remove modal -->

        <!-- edit modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editMemberModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Member</h4>
                    </div>

                    <form class="form-horizontal" action="php_action/update.php" method="POST" id="updateMemberForm">

                        <div class="modal-body">

                            <div class="edit-messages"></div>

                            <div class="form-group">
                                <!--/here teh addclass has-error will appear -->
                                <label for="editName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="editName" name="editName" placeholder="Name">
                                    <!-- here the text will apper  -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editAddress" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="editAddress" name="editAddress" placeholder="Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editContact" class="col-sm-2 control-label">Contact</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="editContact" name="editContact" placeholder="Contact">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editActive" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="editActive" id="editActive">
                                        <option value="">~~SELECT~~</option>
                                        <option value="1">Activate</option>
                                        <option value="2">Deactivate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer editMemberModal">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /edit modal -->
        <script type="text/javascript" src="useronline.js"></script>
    </div>
<?php } ?>