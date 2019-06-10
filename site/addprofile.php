<?php
require('conn.php');
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <?php
    if (isset($_GET['location_id'])) {
        $location_id = $_GET['location_id'];
    }
    $id = $_SESSION['cus_id'];
    if ($result = $conn->query("SELECT * FROM siteadmin WHERE cus_id = '$id'")) {
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
    $sql = "SELECT * FROM location WHERE cus_id='" . $id . "' AND location_id ='" . $location_id . "'";
    $result = mysqli_query($link, $sql) or die("Could not connect");
    $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $ip = $rows['ip_address'];
    $port = $rows['api_port'];
    $user = $rows['username'];
    $pass = $rows['password'];

    if ($API->connect($ip . ":" . $port, $user, $pass)) {} else {
        echo "<script language='javascript'>alert('Disconnect')</script>";
        echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
        exit(0);
    }
    ?>
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
        .btn-info,
        .btn-warning {
            background-color: white;
            color: black;
        }
    </style>
    <title>Add Profile</title>
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
                                        <a href="connectstatus.php" class="nav-link ">
                                            <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                            หน้าหลัก</a>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="addconnect.php" class="nav-link ">
                                            <span class="badge badge-primary"><i class="fas fa-hotel"></i></span>
                                            เพิ่มสถานบริการ</a>
                                    </li> -->
                            <li class="nav-item dropdown ">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-user"></i></span>
                                    พนักงานดูแล
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"employeestatus.php?location_id=$location_id\">สถานะพนักงาน</a>" ?>
                                    <?php echo "<a class=\"dropdown-item\" href=\"addemployee.php?location_id=$location_id\">เพิ่มพนักงาน</a>" ?>
                                    <!-- <a href="employeestatus.php" class="dropdown-item ">สถานะพนักงาน</a>
                                            <a href="addemployee.php" class="dropdown-item ">เพิ่มพนักงาน</a> -->
                                </div>
                            </li>
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"profilestatus.php?location_id=$location_id\">สถานะ Profile</a>" ?>
                                    <!-- <a href="profilestatus.php" class="dropdown-item ">สถานะ Profile</a> -->
                                    <a href="#" class="dropdown-item active">เพิ่ม Profile</a>
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
    </div>

    <div class="container">
        <!-- <div class="row ">
                    <div class="col d-flex justify-content-center">
                        หน้าถัดจากBrandner
                        <p>
                            <h3 style="font-weight:bold">เพิ่ม Profile</h3>
                        </p>
                    </div>
                </div> -->
        <?php echo "<button type=\"button\" style=\"margin:1em 1em\" class=\"btn btn-primary \"><a style=\"color:black;text-decoration:none\" href=\"profilestatus.php?location_id=$location_id\">รายการ Profile</a></button>"; ?>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <?php
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == "edit_site") {
                        error_reporting(0);
                        $name = $_GET['name'];
                        $ARRAY = $API->comm("/ip/hotspot/user/profile/print",array("from" => $name,));
                        echo "<div id=\"border-login\">";
                        echo "<form action=\"con_editprofile.php?location_id=$location_id&cus_id=$id&profile={$ARRAY[0]['name']}\" method=\"post\">";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"name\" class=\"col-sm-4 col-form-label\">Name: </label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control \" name=\"name\" value=\"{$ARRAY[0]['name']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"idle\" class=\"col-sm-4 col-form-label\">IdleTimeout:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"idle\" value=\"{$ARRAY[0]['idle-timeout']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"session\" class=\"col-sm-4 col-form-label\">SessionTimeout:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"session\" value=\"{$ARRAY[0]['session-timeout']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"use\" class=\"col-sm-4 col-form-label\">Shared:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"use\" value=\"{$ARRAY[0]['shared-users']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"maccookie\" class=\"col-sm-4 col-form-label\">Mac Cookie Timeout:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"maccookie\" value=\"{$ARRAY[0]['mac-cookie-timeout']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"limit\" class=\"col-sm-4 col-form-label\">Rate Limit(RX/TX):</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"limit\" value=\"{$ARRAY[0]['rate-limit']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"ia\" class=\"col-sm col-form-label\"></label>";
                        echo "<div class=\" col-sm-12\">";
                        echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                        echo "<a href=\"profilestatus.php?location_id=$location_id\" class=\"btn btn-danger\">ยกเลิก</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<div id=\"border-login\">";
                    echo "<form action=\"con_addprofile.php?location_id=$location_id&cus_id=$id\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"name\" class=\"col-sm-4 col-form-label\">Name: </label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control \" name=\"name\" placeholder=\"ชื่อ Profile\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"idle\" class=\"col-sm-4 col-form-label\">IdleTimeout:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"idle\" placeholder=\"เวลาตัดการเชื่อมต่อเมื่อ User ไม่ Active Pattern 00:00:00\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"session\" class=\"col-sm-4 col-form-label\">SessionTimeout:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"session\" placeholder=\"เวลาเชื่อมต่อนานที่สุด\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"use\" class=\"col-sm-4 col-form-label\">Shared:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"use\" placeholder=\"จำนวนผู้ใช้งาน\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"maccookie\" class=\"col-sm-4 col-form-label\">Mac Cookie Timeout:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"maccookie\" placeholder=\"ระยะเวลา Login โดยใช้ Mac Cookie Pattern 00:00:00\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"limit\" class=\"col-sm-4 col-form-label\">Rate Limit(RX/TX):</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"limit\" placeholder=\"อัตราการอัพโหลดดาวน์โหลด Pattern 0M/0M\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"ia\" class=\"col-sm col-form-label\"></label>";
                    echo "<div class=\" col-sm-12\">";
                    echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                    echo "<button type=\"reset\" class=\"btn btn-warning\">ล้างหน้าจอ</button>&nbsp;";
                    echo "<button type=\"bottom\" class=\"btn btn-danger\" Onclick=\"javascript:history.back()\">ยกเลิก</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>