<?php
require('conn.php');
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <style>
            #border-login {
            background:honeydew;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 1.5em;
            border-radius: 5px;
            margin-top: 0.5em;
            margin-bottom: 1em;
            border:brown solid 1px;
        }
        .btn-danger,
        .btn-primary,
        .btn-info {
            background-color: white;
            color: black;
        }
    </style>
    <title>Add Employee</title>
    <?php
    error_reporting(0);
    $idc = $_SESSION['cus_id'];
    if ($result = $conn->query("SELECT * FROM siteadmin WHERE cus_id = '$idc'")) {
        $numrows = $result->num_rows;
        if ($numrows == 0) {
            echo "<script>";
            echo "alert(\"หมดอายุแล้ว\");";
            echo "</script>";
            unset($_SESSION["cus_id"]);
            echo "<a style=\"margin:5em 5em\" href=\"../index.php\"><bottom type=\"bottom\" class=\"btn btn-danger\">กลับสู่หน้าหลัก</a>";
            exit(0);
        }
    }
    if (isset($_GET['location_id'])) {
        $location_id = $_GET['location_id'];
    }
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = MD5($_POST["password"]);
        $site = $_POST["site"];
        $id = $_POST['id'];
        if ($id) {
            $sql1 = "UPDATE employee SET pass_w='$password'
        ,full_name='$name' WHERE emp_id = '$id'";
            if ($conn->query($sql1)) {
                echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">บันทึกข้อมูลแล้ว</h5>";
                echo "<meta http-equiv='refresh' content='0;url=employeestatus.php?location_id=" . $location_id . "' />";
                exit(0);
            } else {
                echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ไม่สามารถแก้ไขข้อมูลได้กรุณาเปลี่ยน Username</h5>";
            }
        } else {
            $idc = $_GET['cus_id'];
            $location_id = $_GET['location_id'];
            $result = $conn->query("SELECT * FROM employee WHERE username = '$username'");
            if ($result->num_rows != 0) {
                echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน Username</h5>";
            } else {
                $min = 11111;
                $max = 99999;
                $pass_router = rand($min, $max);
                $employee = "$pass_router";
                $group = "full";
                $sql = "SELECT * FROM location WHERE cus_id='" . $idc . "' AND location_id ='" . $location_id . "'";
                $result = mysqli_query($link, $sql) or die("Could not connect");
                $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $ip = $rows['ip_address'];
                $port = $rows['api_port'];
                $user = $rows['username'];
                $pass = $rows['password'];

                if ($API->connect($ip . ":" . $port, $user, $pass)) {
                    $ARRAY1 = $API->comm("/user/print");
                    $count = count($ARRAY1);
                    for ($i = 0; $i < $count; $i++) {
                        $a[] = $ARRAY1[$i]['name'];
                        if ($a[$i] == $username) {
                            echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน Usernameaa</h5>";
                            echo "<meta http-equiv='refresh' content='1;url=addemployee.php?location_id=" . $location_id . "&cus_id=$idc' />";
                            exit(0);
                        }
                    }
                    $ARRAY = $API->comm("/user/add", array(
                        "name" => $username,
                        "password" => $pass_router,
                        "comment" => $employee,
                        "group" => $group,
                    ));
                    $sql = "INSERT INTO  employee VALUES
                                ('','$username','$password','$pass_router','$name','$location_id')";
                    ($conn->query($sql));
                    echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">บันทึกข้อมูลแล้ว</h5>";
                    echo "<meta http-equiv='refresh' content='1;url=employeestatus.php?location_id=" . $location_id . "&cus_id=$idc' />";
                    //exit(0);
                } else {
                    echo "<script language='javascript'>alert('Disconnect')</script>";
                    echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
                    exit(0);
                }
            }
        }
    }


    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="../siteadmin/connectstatus.php"><span style="color:red">Site Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["cus_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <!-- <li class="nav-item ">
                                                            <a href="../siteadmin/connectstatus.php" class="nav-link ">
                                                                <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                                                หน้าหลัก</a>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item ">
                                                            <a href="../siteadmin/addconnect.php" class="nav-link ">
                                                                <span class="badge badge-primary"><i class="fas fa-hotel"></i></span>
                                                                เพิ่มสถานบริการ</a>
                                                        </li> -->
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-user"></i></span>
                                    พนักงานดูแล
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"employeestatus.php?location_id=$location_id\">สถานะพนักงาน</a>" ?>
                                    <a href="#" class="dropdown-item active">เพิ่มพนักงาน</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"profilestatus.php?location_id=$location_id\">สถานะ Profile</a>" ?>
                                    <?php echo "<a class=\"dropdown-item\" href=\"addprofile.php?location_id=$location_id\">เพิ่ม Profile</a>" ?>
                                    <!-- <a href="profilestatus.php" class="dropdown-item">สถานะ Profile</a>
                                                                <a href="addprofile.php" class="dropdown-item">เพิ่ม Profile</a> -->
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-unlock"></i></span>
                                    ตั้งค่าเว็บไม่ต้อง Login
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"wallgardenstatus.php?location_id=$location_id\">สถานะ</a>" ?>
                                    <?php echo "<a class=\"dropdown-item\" href=\"addwallgarden.php?location_id=$location_id\">เพิ่ม</a>" ?>
                                    <!-- <a href="wallgardenstatus.php" class="dropdown-item ">สถานะ</a>
                                                                <a href="addwallgarden.php" class="dropdown-item">เพิ่ม</a> -->
                                </div>
                            </li>
                            <!-- <li class="nav-item">
                                                            <a href="../siteadmin/changpwsite.php" class="nav-link ">
                                                                <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                                                เปลี่ยนรหัสผ่าน</a>
                                                        </li> -->
                            <li class="nav-item">
                                <a href="../siteadmin/cus_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
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
        <!-- <div class="row">
                                                        <div class="col d-flex justify-content-center">
                                                            <p>
                                                                <h3 style="font-weight:bold">เพิ่มพนักงานดูแล</h3>
                                                            </p>
                                                        </div>
                                                    </div> -->
        <?php echo "<button type=\"button\" style=\"margin:1em 1em\" class=\"btn btn-info \"><a style=\"color:black;text-decoration:none\" href=\"employeestatus.php?location_id=$location_id\">รายการสถานะพนักงาน</a></button>" ?>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <?php if (isset($_GET['action']) && (isset($_GET['id']))) {
                    if ($_GET['action'] == "edit_site") {
                        $emp_id = $_GET['id'];
                        $sql = "SELECT * FROM employee WHERE emp_id = '$emp_id'";
                        $result = $conn->query($sql);
                        $rows = $result->fetch_array(MYSQLI_ASSOC);
                        echo "<div id=\"border-login\">";
                        echo "<form action=\"\" method=\"post\">";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"id\" class=\"col-sm-4 col-form-label\">ID: </label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"id\" value=\"{$rows['emp_id']}\" readonly required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"name\" class=\"col-sm-4 col-form-label\">Full Name: </label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"name\" value=\"{$rows['full_name']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        // echo "<div class=\"form-group row\">";
                        // echo "<label for=\"username\" class=\"col-sm-4 col-form-label\">Username:</label>";
                        // echo "<div class=\"col-sm-8\">";
                        // echo "<input type=\"text\" class=\"form-control\" name=\"username\" value=\"{$rows['username']}\" required>";
                        // echo "</div>";
                        // echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"password\" class=\"col-sm-4 col-form-label\">Password:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"password\" class=\"form-control\" name=\"password\" value=\"{$rows['pass_w']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"site\" class=\"col-sm-4 col-form-label\">Site:</label>";
                        echo "<div class=\"col-sm-8\">";
                        $sql = "SELECT * FROM location WHERE location_id = '$location_id'";
                        $result = $conn->query($sql);
                        $rows = $result->fetch_array(MYSQLI_ASSOC);
                        echo "<input type=\"text\" class=\"form-control\" name=\"site\" value=\"{$rows['working_site']}\" readonly required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"s\" class=\"col-sm-4 col-form-label\"></label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                        echo "<button type=\"bottom\" class=\"btn btn-danger\" onClick=\"history.go(-1); return false;\">ยกเลิก</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<div id=\"border-login\">";
                    echo "<form action=\"addemployee.php?cus_id=$idc&location_id=$location_id\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"name\" class=\"col-sm-4 col-form-label\">Full Name: </label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"name\" placeholder=\"ชื่อพนักงาน\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"username\" class=\"col-sm-4 col-form-label\">Username:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"ชื่อเข้าสู่ระบบ\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"password\" class=\"col-sm-4 col-form-label\">Password:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"รหัสผ่าน\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"site\" class=\"col-sm-4 col-form-label\">Site:</label>";
                    echo "<div class=\"col-sm-8\">";
                    $sql = "SELECT * FROM location WHERE location_id = '$location_id'";
                    $result = $conn->query($sql);
                    $rows = $result->fetch_array(MYSQLI_ASSOC);
                    echo "<input type=\"text\" class=\"form-control\" name=\"site\" value=\"{$rows['working_site']}\" readonly required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"s\" class=\"col-sm-4 col-form-label\"></label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                    echo "<button type=\"bottom\" class=\"btn btn-danger\" onClick=\"history.go(-1); return false;\">ยกเลิก</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                } ?>
            </div>
        </div>
    </div>
    <!-- <script>
                                        $(document).ready(function() {
                                            $('.dropdown-menu li').on('click', function() {
                                                var getValue = $(this).text();
                                                $('.dropdown-select').text(getValue);
                                            });
                                        });
                                    </script> -->
<?php } ?>