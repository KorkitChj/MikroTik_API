<?php
session_start();
require('../template/template.html');
require('../include/connect_db.php');
require('../include/connect_db_router.php');
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <style>
        .container {
            background-color: white;
            padding: 20px;
        }
    </style>
    <title>User Online Group</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="employee.php">Employee: <?php print_r($_SESSION["emp_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item ">
                                <a href="employee.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <a href="useronline.php" class="dropdown-item ">สถานะ User</a>
                                    <a href="#" class="dropdown-item active">สถานะ User กลุ่ม</a>
                                    <a href="adduser.php" class="dropdown-item">เพิ่ม User ครั้งละ 1คน</a>
                                    <a href="addusergroup.php" class="dropdown-item">เพิ่ม User ครั้งละเป็นกลุ่ม</a>
                                    <a href="printuser.php" class="dropdown-item">ปริ้นคูปอง</a>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a href="changpwemp.php" class="nav-link">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item">
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

    <div class="container color-custom ">
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <!--หน้าถัดจากBrandner-->
                <p>
                    <h3 style="font-weight:bold">ข้อมูลพนักงานดูแลระบบ</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Prefix</th>
                            <th>Password Lenght</th>
                            <th>Name length</th>
                            <th>Commect</th>
                            <th>Profile</th>
                            <th>Number Users</th>
                            <th>Up Time</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="d1">
                            <td>1</td>
                            <td id="s1">AB</td>
                            <td id="f1">5</td>
                            <td id="u1">5</td>
                            <td id="c1">Customer</td>
                            <td id="p1">1d</td>
                            <td id="n1">10</td>
                            <td id="ut1">00:00:00</td>
                            <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm">
                                    <span class="glyphicon glyphicon-cog"></span></button></td>
                            <td><button type="button" data-toggle="modal" data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                                    <span class="glyphicon glyphicon-trash"></span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="edit" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class=" modal-title">Update Data</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post">
                            <div class="form-group row">
                                <label for="inputprefix" class="col-sm-3 col-form-label">Prefix: </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control " id="inputprefix" placeholder="อักษรนำหน้า" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputpassword" class="col-sm-3 col-form-label">Password Lenght:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputpassword" placeholder="จำนวนรหัสผ่าน" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputnamelength" class="col-sm-3 col-form-label">Name length:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputnamelength" placeholder="จำนวนชื่อ" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputcomment" class="col-sm-3 col-form-label">Comment:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputcomment" placeholder="Comment" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputprofile" class="col-sm-3 col-form-label">Profile:</label>
                                <div class="col-sm-9">
                                    <select class="form-control">
                                        <option>1d</option>
                                        <option>2d</option>
                                        <option>3d</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputnumberusers" class="col-sm-3 col-form-label">Number Users:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputnumberusers" placeholder="จำนวนผู้ใช้งาน" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputuptime" class="col-sm-3 col-form-label">Up Time:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputuptime" placeholder="Up Time" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="up" class="btn btn-warning" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Data</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you sure you want to delete this data?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="del" class="btn btn-danger" data-dismiss="modal">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.dropdown-menu li').on('click', function() {
                    var getValue = $(this).text();
                    $('.dropdown-select').text(getValue);
                });

            });

            $(document).ready(function() {
                var getValue;
                $(".update ").click(function() {
                    var id = $(this).data("uid");
                    var s1 = $("#s1").html();
                    var f1 = $("#f1").html();
                    var u1 = $("#u1").html();
                    var c1 = $("#c1").html();
                    var p1 = $("#p1").html();
                    var n1 = $("#n1").html();
                    var ut1 = $("#ut1").html();
                    if (id == 1) {
                        $("#prefix").val(s1);
                        $("#lwp").val(f1);
                        $("#nl").val(u1);
                        $("#cm").val(c1);
                        // $("#dropdown-select").val(p1);
                        $("#nu").val(n1);
                        $("#ut").val(ut1);
                    }
                    $('#demolist li').on('click', function() {
                        getValue = $(this).text();
                    });
                    $("#up").click(function() {
                        // alert(getValue);
                        if (id == 1) {
                            var s1 = $("#prefix").val();
                            var f1 = $("#lwp").val();
                            var u1 = $("#nl").val();
                            var c1 = $("#cm").val();
                            var n1 = $("#nu").val();
                            var ut1 = $("#ut").val();

                            $("#s1").html(s1);
                            $("#f1").html(f1);
                            $('#u1').html(u1);
                            $('#c1').html(c1);
                            $('#p1').html(getValue);
                            $('#n1').html(n1);
                            $('#ut1').html(ut1);
                        }


                    });
                });
                $(".delete").click(function() {
                    var id = $(this).data("uid");
                    $("#del").click(function() {
                        if (id == 1) {
                            $("#d1").html('');
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    </div>
<?php } ?>