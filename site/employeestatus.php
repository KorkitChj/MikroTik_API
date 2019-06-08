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
    //bug***********************************
    if (isset($_POST['del_all'])) {
        $idc = $_GET['cus_id'];
        $location_id = $_GET['location_id'];
        $ide = implode(", ", $_POST['emp_id']);
        $sql2 = "SELECT pass_router FROM employee WHERE emp_id IN($ide)";
        $result4 = $conn->query($sql2);
        $result5 = $result4->fetch_array(MYSQLI_ASSOC);
        $pass_router = "employee" . $result5['pass_router'];
        $sql = "SELECT * FROM location WHERE cus_id='" . $idc . "' AND location_id ='" . $location_id . "'";
        $result = mysqli_query($link, $sql) or die("Could not connect");
        $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $ip = $rows['ip_address'];
        $port = $rows['api_port'];
        $user = $rows['username'];
        $pass = $rows['password'];
        $conn->query("DELETE FROM employee WHERE emp_id IN($ide)");
        if ($API->connect($ip . ":" . $port, $user, $pass)) {
            $ARRAY = $API->comm("/user/remove", array(
                "numbers" => $pass_router,
            ));
        } else {
            echo "<script language='javascript'>alert('Disconnect')</script>";
            echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
            exit(0);
        }
        echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ลบข้อมูลแล้ว</h5>";
        echo "<meta http-equiv='refresh' content='1;url=employeestatus.php?location_id=$location_id' />";
    }
    //*********************
    if (isset($_GET['del'])) {
        $ida = $_GET['del'];
        $idc = $_GET['cus_id'];
        $location_id = $_GET['location_id'];
        $sql2 = "SELECT pass_router FROM employee WHERE emp_id = '$ida'";
        if ($result2 = $conn->query($sql2)) {
            $result3 = $result2->fetch_array(MYSQLI_ASSOC);
            $pass_router = "employee" . $result3['pass_router'];
            $sql = "SELECT * FROM location WHERE cus_id='" . $idc . "' AND location_id ='" . $location_id . "'";
            $result = mysqli_query($link, $sql) or die("Could not connect");
            $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $ip = $rows['ip_address'];
            $port = $rows['api_port'];
            $user = $rows['username'];
            $pass = $rows['password'];
            $sql = "DELETE FROM employee WHERE emp_id = '$ida'";
            $conn->query($sql);
            if ($API->connect($ip . ":" . $port, $user, $pass)) {
                $ARRAY = $API->comm("/user/remove", array(
                    "numbers" => $pass_router,
                ));
            } else {
                echo "<script language='javascript'>alert('Disconnect')</script>";
                echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
                exit(0);
            }
            echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ลบข้อมูลแล้ว</h5>";
            echo "<meta http-equiv='refresh' content='1;url=employeestatus.php?location_id=$location_id' />";
        }
    }
    ?>
    <!-- <style>
                                .container {
                                    background-color: white;
                                    padding: 20px;
                                }
                            </style> -->
    <title>Employee Status</title>
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
                                    <a href="#" class="dropdown-item active">สถานะพนักงาน</a>
                                    <?php echo "<a class=\"dropdown-item\" href=\"addemployee.php?location_id=$location_id\">เพิ่มพนักงาน</a>" ?>
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
    </div>

    <div class="container-fluid">
        <!-- <div class="row ">
                                    <div class="col d-flex justify-content-center">
                                        หน้าถัดจากBrandner
                                        <p>
                                            <h3 style="font-weight:bold">ข้อมูลพนักงานดูแลระบบ</h3>
                                        </p>
                                    </div>
                                </div> -->
        <div class="row ">
            <div class="col">
                <form action="#" method="post" id="confirm">
                    <?php echo "<button type=\"button\" style=\"margin:1em 1em\" class=\"btn btn-info \"><a style=\"color:white\" href=\"addemployee.php?location_id=$location_id\">เพิ่มพนักงาน</a></button>" ?>
                    <!-- <?php echo "<button type=\"button\" style=\"margin-right:1em\" name=\"del_all\" class=\"btn btn-danger \"><a style=\"color:white\" href=\"employeestatus.php?location_id=$location_id&cus_id=$idc\">ลบข้อมูลแถวที่เลือก</a></button>" ?> -->
                    <!-- <button class="btn btn-danger" style="margin-right:1em" name="del_all">ลบข้อมูลแถวที่เลือก</button> -->
                    <table id="example" class="table table-striped table-bordered table-dark table-sm" style="width:100%">
                        <thead class="bg-danger">
                            <tr>
                                <th></th>
                                <th>Number</th>
                                <th>working_site</th>
                                <th>full_name</th>
                                <th>Username</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['location_id'])) {
                                $location_id = $_GET['location_id'];
                                $sql = "SELECT b.emp_id,a.working_site,b.full_name,b.username FROM location AS a INNER JOIN employee AS b
                        on a.location_id = b.location_id WHERE a.location_id = '$location_id'";
                                $result = $conn->query($sql);
                                $n = 0;
                                while ($rows = $result->fetch_array(MYSQLI_ASSOC)) {
                                    $n++;
                                    echo "<tr>";
                                    echo "<td><input type=\"checkbox\" class=\"cus_checkbox\" name=\"emp_id[]\" value=" . $rows['emp_id'] . "></td>";
                                    echo "<td>" . $n . "</td>";
                                    echo "<td>" . $rows['working_site'] . "</td>";
                                    echo "<td>" . $rows['full_name'] . "</td>";
                                    echo "<td>" . $rows['username'] . "</td>";
                                    echo "<td>                   
                                <a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการแก้ไขรายการนี้!')==true)
                                {window.location='addemployee.php?action=edit_site&id=" . $rows['emp_id'] . "&location_id=" . $location_id . "'}\">
                                <button type=\"button\" class=\"btn btn-info\" title=\"แก้ไข\">
                                <i class=\"glyphicon glyphicon-edit\"></i></button></a>
                                <a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการลบหรือไม่!!!')==true)
                                {window.location='employeestatus.php?del=" . $rows['emp_id'] . "&cus_id=" . $idc . "&location_id=" . $location_id . "'}\">
                                <button type=\"button\" class=\"btn btn-danger\" title=\"ลบ\">
                                <i class=\"glyphicon glyphicon-trash\"></i></button></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                $conn->close();
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php } ?>