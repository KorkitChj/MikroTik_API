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
    <title>Employee</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="employee.php"><span style="color:red">Site Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["emp_name"]); ?></a>
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
                            <li class="nav-item dropdown ">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <a href="useronline.php" class="dropdown-item ">สถานะ User</a>
                                    <a href="useronlinegroup.php" class="dropdown-item">สถานะ User กลุ่ม</a>
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
                                <a href="emp_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
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
                    <h3 style="font-weight:bold">ข้อมูลการใช้งาน</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ชื่อสถานบริการ</th>
                            <th>สถานะ</th>
                            <th>ซีพียู</th>
                            <th>แรม</th>
                            <th>ฮาร์ดดิส</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            // $user = $_SESSION['emp_name'];
                            // $sql = "SELECT*FROM location b INNER JOIN 
                            // employee a ON a.location_id = b.location_id WHERE username = '$user'";
                            // $result = $conn->query($sql);
                            // $rows = $result->fetch_array(MYSQLI_ASSOC);
                            // $working_site = $rows['working_site'];
                            // echo "<tr id=\"d1\">";
                            // echo "<td>".$working_site."</td>";
                            // echo "<td><button type=\"button\" class=\"btn btn-success\">เชื่อมต่อ</button></td>";
                            // echo "</tr>";
                           
                            
                            ?>

                            <td>reception</td>
                            <td id="s1"><button type="button" class="btn btn-success">เชื่อมต่อ</button></td>
                            <td id="f1">10%</td>
                            <td id="u1">7M</td>
                            <td id="e1">7M</td>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- <script>
            $(document).ready(function() {
                $('.dropdown-menu li').on('click', function() {
                    var getValue = $(this).text();
                    $('.dropdown-select').text(getValue);
                });
            });
            $(document).ready(function() {
                $(".update ").click(function() {
                    var id = $(this).data("uid");
                    var s1 = $("#s1").html();
                    var f1 = $("#f1").html();
                    var u1 = $("#u1").html();
                    if (id == 1) {
                        $("#fname").val(f1);
                        $("#uname").val(u1);
                    }
                    $('#demolist li').on('click', function() {
                        var getValue = $(this).text();
                        $("#up").click(function() {
                            // alert(getValue);
                            if (id == 1) {
                                var f1 = $("#fname").val();
                                var u1 = $("#uname").val();
                                $("#f1").html(f1);
                                $("#u1").html(u1);
                                $('#s1').html(getValue);
                            }
                        });
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
        </script> -->
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    </div>
<?php } ?>