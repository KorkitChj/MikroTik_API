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
    <title>Add Wall Garden</title>
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
                            <li class="nav-item dropdown ">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"profilestatus.php?location_id=$location_id\">สถานะ Profile</a>" ?>
                                    <?php echo "<a class=\"dropdown-item\" href=\"addprofile.php?location_id=$location_id\">เพิ่ม Profile</a>" ?>
                                    <!-- <a href="profilestatus.php" class="dropdown-item ">สถานะ Profile</a>
                                                                            <a href="addprofile.php" class="dropdown-item ">เพิ่ม Profile</a> -->
                                </div>
                            </li>
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-unlock"></i></span>
                                    ตั้งค่าเว็บไม่ต้อง Login
                                </a>
                                <div class="dropdown-menu">
                                    <?php echo "<a class=\"dropdown-item\" href=\"wallgardenstatus.php?location_id=$location_id\">สถานะ</a>" ?>
                                    <a href="#" class="dropdown-item active">เพิ่ม</a>
                                    <!-- <a href="wallgardenstatus.php" class="dropdown-item ">สถานะ</a> -->
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
        <!-- <div class="row ">
                                                    <div class="col d-flex justify-content-center">
                                                        หน้าถัดจากBrandner
                                                        <p>
                                                            <h3 style="font-weight:bold">ตั้งค่าเว็บไม่ต้อง Login</h3>
                                                        </p>
                                                    </div>
                                                </div> -->
        <?php echo "<button type=\"button\" style=\"margin:1em 1em\" class=\"btn btn-primary \"><a style=\"color:black;text-decoration:none\" href=\"wallgardenstatus.php?location_id=$location_id\">รายการ Wall Garden</a></button>"; ?>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <?php
                if (isset($_GET['action'])) {
                    if ($_GET['action'] = "edit_site") {
                        error_reporting(0);
                        $name = $_GET['name'];
                        $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/print",array("from" => $name,));
                        echo "<div id=\"border-login\">";
                        echo "<form action=\"con_editwallgarden.php?location_id=$location_id&cus_id=$id&comment={$ARRAY[0]['comment']}\" method=\"post\">";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"domainname\" class=\"col-sm-4 col-form-label\">Domain Name:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"domainname\" value=\"{$ARRAY[0]['dst-host']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"action\" class=\"col-sm-4 col-form-label\">Action: </label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<select class=\"form-control\" name=\"action\">";
                        if($ARRAY[0]['action'] == "accept"){
                            echo "<option value=\"accept\" selected>Accept</option>";
                            echo "<option value=\"drop\">Drop</option>";
                            echo "<option value=\"reject\">Reject</option>";
                        }elseif($ARRAY[0]['action'] == "drop"){
                            echo "<option value=\"accept\">Accept</option>";
                            echo "<option value=\"drop\" selected>Drop</option>";
                            echo "<option value=\"reject\">Reject</option>";
                        }else{
                            echo "<option value=\"accept\">Accept</option>";
                            echo "<option value=\"drop\">Drop</option>";
                            echo "<option value=\"reject\" selected>Reject</option>";
                        }                       
                        echo "</select>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"status\" class=\"col-sm-4 col-form-label\">Status:</label>";
                        echo "<div class=\"col-sm-8\">";
                        echo "<input type=\"text\" class=\"form-control\" name=\"comment\" value=\"{$ARRAY[0]['comment']}\" required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group row\">";
                        echo "<label for=\"bk\" class=\"col-sm-4 col-form-label\"></label>";
                        echo "<div class=\" col-sm-8\">";
                        echo "<button type=\"submit\" name=\"sm\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                        echo "<a href=\"javascript:history.go(-1)\" class=\"btn btn-danger\">ยกเลิก</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<div id=\"border-login\">";
                    echo "<form action=\"con_addwallgarden.php?location_id=$location_id\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"domainname\" class=\"col-sm-4 col-form-label\">Domain Name:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"domainname\" placeholder=\"ชื่อเว็บไซต์\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"action\" class=\"col-sm-4 col-form-label\">Action: </label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<select class=\"form-control\" name=\"action\">";
                    echo "<option value=\"accept\">Accept</option>";
                    echo "<option value=\"drop\">Drop</option>";
                    echo "<option value=\"reject\">Reject</option>";
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"status\" class=\"col-sm-4 col-form-label\">Status:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"status\" placeholder=\"หมายเหตุ\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"bk\" class=\"col-sm-4 col-form-label\"></label>";
                    echo "<div class=\" col-sm-8\">";
                    echo "<button type=\"submit\" name=\"sm\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                    echo "<a href=\"javascript:history.go(-1)\" class=\"btn btn-danger\">ยกเลิก</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- <script>
                                        $(document).ready(function() {
                                            $('.a li').on('click', function() {
                                                var getValue = $(this).text();
                                                $('.dropdown-select1').text(getValue);
                                            });
                                            $('.b li').on('click', function() {
                                                var getValue = $(this).text();
                                                $('.dropdown-select2').text(getValue);
                                            });
                                        });
                                    </script> -->
<?php } ?>