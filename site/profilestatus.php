<?php
require('conn.php');
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <?php
    include('../siteadmin/useronlinejs.php');
    error_reporting(0);
    if (isset($_GET['location_id'])) {
        $location_id = $_GET['location_id'];
    }
    $id = $_SESSION['cus_id'];
    $sql = "SELECT * FROM siteadmin WHERE cus_id = :id";
    $query = $conn->prepare($sql);
    $query->bindparam(':id', $id);
    if ($query->execute()) {
        $numrows = $query->rowCount();
        if ($numrows == 0) {
            echo "<script>";
            echo "alert(\"หมดอายุแล้ว\");";
            echo "</script>";
            unset($_SESSION["cus_id"]);
            echo "<a style=\"margin:5em 5em\" href=\"../index.php\"><bottom type=\"bottom\" class=\"btn btn-danger\">กลับสู่หน้าหลัก</a>";
            exit(0);
        }
    }
    $sql = "SELECT * FROM location WHERE cus_id= :id  AND location_id = :location_id ";
    $query1 = $conn->prepare($sql);
    $query1->bindparam(':id', $id);
    $query1->bindparam(':location_id', $location_id);
    $query1->execute();
    $rows = $query1->fetch(PDO::FETCH_ASSOC);
    $ip = $rows['ip_address'];
    $port = $rows['api_port'];
    $user = $rows['username'];
    $pass = $rows['password'];
    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        if ($_GET['name_del']) {
            $name_del = $_GET['name_del'];
            $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
            $num = count($ARRAY);
            echo "<meta charset='utf-8'>";
            if ($num == '0') {
                echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                <strong>Unsuccess!</strong>Default profile can not be removed.
                                </div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php?opt=profile' />";
            } else {
                if ($name_del == "default") {
                    echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                <strong>Unsuccess!</strong>ไม่สามารถลบ Profile ได้.
                                </div>";
                    echo "<meta http-equiv='refresh' content='1;url=profilestatus.php?location_id=$location_id' />";
                } else {
                    $ARRAY = $API->comm("/ip/hotspot/user/profile/remove", array(
                        "numbers" => $name_del,
                    ));
                    echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                <strong>Success!</strong>ทำการลบแพคเกจเรียบร้อยแล้ว.
                                </div>";
                    echo "<meta http-equiv='refresh' content='1;url=profilestatus.php?location_id=$location_id' />";
                }
            }
        } elseif ($_POST['profile_id']) {
            $ide = implode(", ", $_POST['profile_id']);
            $ARRAY = $API->comm("/ip/hotspot/user/profile/remove", array(
                "numbers" => $ide,
            ));
            echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                <strong>Success!</strong>ลบข้อมูลที่เลือกแล้ว.
                                </div>";
            echo "<meta http-equiv='refresh' content='1;url=profilestatus.php?location_id=$location_id' />";
        } else {
            $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
        }
    } else {
        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                <strong>Unsuccess!</strong>Disconnect
                                </div>";
        echo "<meta http-equiv='refresh' content='1;url=../siteadmin/connectstatus.php'/>";
    }
    ?>
    <style>
        .btn-danger,
        .btn-success,
        .btn-warning,
        .btn-info,
        .btn-primary {
            background-color: white;
            color: black;
        }

        .bg-info {
            background: #bdc3c7;
            background: linear-gradient(to bottom, #bdc3c7, #2c3e50);
            background: -webkit-linear-gradient(to bottom, #2c3e50, #bdc3c7);
        }

        th {
            color: darkblue;
        }
        td{
            color:white;
        }
        table.dataTable thead th{
            border-bottom: 0;
        }
        .pad-a{
            background-color:rgba(0, 0, 0, 0.3);
        }
    </style>
    <title>Profile Status</title>
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
                            <li class="nav-item dropdown pad">
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
                            <li class="nav-item dropdown active pad-a">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item active">สถานะ Profile</a>
                                    <?php echo "<a class=\"dropdown-item\" href=\"addprofile.php?location_id=$location_id\">เพิ่ม Profile</a>" ?>
                                    <!-- <a href="addprofile.php" class="dropdown-item">เพิ่ม Profile</a> -->
                                </div>
                            </li>
                            <li class="nav-item dropdown pad">
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
                            <li class="nav-item pad">
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
        <div class="row">
            <div class="col">
                <form action="#" method="post" id="confirm">
                    <?php echo "<button type=\"button\" style=\"margin:1em 1em\" class=\"btn btn-primary \"><a style=\"color:black;text-decoration:none\" href=\"addprofile.php?location_id=$location_id\">เพิ่ม Profile</a></button>"; ?>
                    <button onClick="return confirm('คุณต้องการที่จะลบข้อมูลที่เลือกนี้หรือไม่ ?');" class="btn btn-danger" style="margin-right:1em" name="del_all">ลบข้อมูลแถวที่เลือก</button>
                    <table id="example" class="table table-striped  table-sm" style="width:100%">
                        <thead class="bg-info">
                            <tr>
                                <th></th>
                                <th>Number</th>
                                <th>Profile</th>
                                <th>Rate Limit(RX/TX)</th>
                                <th>Shared User</th>
                                <th>Mac Cookie Timeout</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = count($ARRAY);
                            for ($i = 0; $i < $num; $i++) {
                                $no = $i + 1;
                                echo "<tr id ='$no'>";
                                echo "<td><input type=\"checkbox\" class=\"profile_checkbox\" name=\"profile_id[]\" value=" . $ARRAY[$i]['name'] . "></td>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $ARRAY[$i]['name'] . "</td>";
                                echo "<td>";
                                if ($ARRAY[$i]['rate-limit'] == "") {
                                    echo "Unlimited";
                                } else {
                                    echo $ARRAY[$i]['rate-limit'];
                                }
                                echo "</td>";
                                echo "<td>" . $ARRAY[$i]['shared-users'] . "</td>";
                                echo "<td>" . $ARRAY[$i]['mac-cookie-timeout'] . "</td>";
                                echo "</td>";
                                echo "<td>                   
                                <a onClick=\"return confirm('คุณต้องการแก้ไขรายการนี้!');\" href='addprofile.php?action=edit_site&name=" . $ARRAY[$i]['name'] . "&location_id=" . $location_id . "'}\">
                                <button type=\"button\" class=\"btn btn-info\" title=\"แก้ไข\">
                                <i class=\"glyphicon glyphicon-edit\"></i></button></a>
                                <a onClick=\"return confirm('คุณต้องการลบหรือไม่!!!');\" href='profilestatus.php?name_del=" . $ARRAY[$i]['name'] . "&location_id=" . $location_id . "'}\">
                                <button type=\"button\" class=\"btn btn-danger\" title=\"ลบ\">
                                <i class=\"glyphicon glyphicon-trash\"></i></button></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php } ?>