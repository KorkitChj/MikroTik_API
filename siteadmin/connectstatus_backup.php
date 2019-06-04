<?php
error_reporting(0);
session_start();
require('../include/connect_db_router.php');
require('../config/routeros_api.class.php');
require('../template/template.html');
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location: login.php");
} else { ?>
    <style>
        .container {
            background-color: white;
            padding: 20px;
        }
    </style>
    <title>Connect Status</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#"><span style="color:red">Site Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["cus_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="addconnect.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fas fa-hotel"></i></span>
                                    เพิ่มสถานบริการ</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-user"></i></span>
                                    พนักงานดูแล
                                </a>
                                <div class="dropdown-menu">
                                    <a href="employeestatus.php" class="dropdown-item">สถานะพนักงาน</a>
                                    <a href="addemployee.php" class="dropdown-item">เพิ่มพนักงาน</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <a href="profilestatus.php" class="dropdown-item">สถานะ Profile</a>
                                    <a href="addprofile.php" class="dropdown-item">เพิ่ม Profile</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-unlock"></i></span>
                                    ตั้งค่าเว็บไม่ต้อง Login
                                </a>
                                <div class="dropdown-menu">
                                    <a href="wallgardenstatus.php" class="dropdown-item ">สถานะ</a>
                                    <a href="addwallgarden.php" class="dropdown-item">เพิ่ม</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="changpwsite.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item">
                                <a href="cus_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    </div>
  
    <div class="container color-custom ">
        <div class="row">
            <div style="margin-left:25px;margin-top:-30px">
                <button type="button" class="btn btn-danger "><a style="color:white" href="addconnect.php">เพิ่มสถานบริการ</a></button>
            </div>
        </div>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <!--หน้าถัดจากBrandner-->
                <p>
                    <h3 style="font-weight:bold">รายการสถานบริการ</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <table id="example" class="table table-striped table-bordered table-hover costum-table-dark" style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox" id="select_all"></th> -->
                            <th>Number</th>
                            <th>Username</th>
                            <th>Site Name</th>
                            <th>ซีพียู</th>
                            <th>แรม</th>
                            <th>ฮาร์ดดิส</th>
                            <th>Connect Status</th>
                            <th>Edit</th>
                            <!-- <th>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $sql = "SELECT * FROM location";
                        $result1 = mysqli_query($link, $sql) or die("Could not connect");
                        $no = 0;
                        while ($result = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
                            $no++;
                            $API = new routeros_api();
                            $API->debug = false;
                            $port = $result['api_port'];
                            if ($API->connect($result['ip_address'].":".$port, $result['username'], $result['password'])) {
                                $ARRAY = $API->comm("/system/resource/print");
                                $ram =    $ARRAY['0']['free-memory'] / 1048576;
                                $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
                            }
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".$result['username']."</td>";
                            echo "<td>".$result['working_site']."</td>";
                            echo "<td>";
                            if ($ARRAY['0']['cpu-load'] == "") {
                                echo "-";
                            } else {
                                echo $ARRAY['0']['cpu-load'] . "%";
                            }
                            echo "</td>";
                            echo "<td>".round($ram, 1)." MB</td>";
                            echo "<td>".round($hdd, 1)." MB</td>";
                            echo "<td>";
                            if ($API->connect($result['ip_address'].":".$port, $result['username'], $result['password'])) {
                                echo "<button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i> CONNECT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>";
                                $conn = "connect";
                            } else {
                                echo "<button type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-times\"></i> DISCONNECT</button>";
                                $conn = "disconnect";
                            }
                            echo "</td>";
                            echo "<td><a href='../site/site_conn.php?id=".$result['location_id']."&conn=".$conn."'>
                            <button type=\"button\" class=\"btn btn-success\" title=\"เข้าบริหารจัดการ\">
                            <i class=\"glyphicon glyphicon-new-window\"></i></button></a>
                            <a href='index.php?opt=edit_site&id=".$result['location_id']."'>
                            <button type=\"button\" class=\"btn btn-info\" title=\"แก้ไข\">
                            <i class=\"glyphicon glyphicon-edit\"></i></button></a>
							<a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการลบหรือไม่!!!')==true)
                            {window.location='index.php?did=".$result['location_id']."'}\">
                            <button type=\"button\" class=\"btn btn-danger\" title=\"ลบ\">
                            <i class=\"glyphicon glyphicon-trash\"></i></button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- <tr>
                                    <span class="rows_selected" id="select_count">0 Selected </span>
                                    <button type="button" id="delete_records" class="btn btn-danger pull-right">Delete</button>
                                </tr> -->
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
                        <div class="form-group row">
                            <label for="inputipaddress" class="col-sm-4 col-form-label">IP Address Or Domain Name: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="inputipaddress" placeholder="ไอพี หรือ โดเมนเนม" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputusername" class="col-sm-4 col-form-label">Username:</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" class="form-control" id="inputusername" placeholder="ชื่อใช้งาน" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputpassword" class="col-sm-4 col-form-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputpassword" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputportapi" class="col-sm-4 col-form-label">API Port:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputportapi" placeholder="พอร์ตเอพีไอ" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnamesite" class="col-sm-4 col-form-label">Site Name:</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" class="form-control" id="inputnamesite" placeholder="ชื่อไซต์งาน" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-4 col-form-label">Address:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputaddress" placeholder="ที่อยู่" required>
                            </div>
                        </div>
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
                $(".update").click(function() {
                    var id = $(this).data("uid");
                    var n1 = $("#n1").html();
                    var s1 = $("#s1").html();
                    var p1 = $("#p1").html();
                    if (id == 1) {
                        $("#uname").val(n1);
                        $("#sname").val(s1);
                        $("#pnum").val(p1);
                    }
                    $("#up").click(function() {
                        if (id == 1) {
                            var n1 = $("#uname").val();
                            var s1 = $("#sname").val();
                            var p1 = $("#pnum").val();
                            $("#n1").html(n1);
                            $("#s1").html(s1);
                            $("#p1").html(p1);
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
    </div>
<?php } ?>