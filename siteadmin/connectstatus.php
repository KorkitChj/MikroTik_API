<?php
require('../site/conn.php');
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <?php
    error_reporting(0);
    $id = $_SESSION['cus_id'];
    $sql = "SELECT * FROM siteadmin WHERE cus_id = :id";
    $query = $conn->prepare($sql);
    $query->bindparam(':id',$id);
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
    if (isset($_POST['location_id'])) {
        $id = implode(", ", $_POST['location_id']);
        $sql = "DELETE FROM location WHERE location_id IN ($id)";
        $query = $conn->prepare($sql);
        $query->execute();
        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <strong>Success!</strong> ลบข้อมูลแล้ว
        </div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=connectstatus.php\">";
    }

    if (isset($_GET['id_del'])) {
        $id_del = $_GET['id_del'];
        $sql = "DELETE FROM location WHERE location_id = :id_del";
        $result =  $conn->prepare($sql);
        $result->bindparam(':id_del', $id_del);
        $result->execute();
        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <strong>Success!</strong> ลบข้อมูลแล้ว
        </div>";
        // echo "<meta http-equiv=\"refresh\" content=\"1;url=connectstatus.php\">";
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
                            <li class="nav-item active pad-a">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item pad">
                                <a href="addconnect.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fas fa-hotel"></i></span>
                                    เพิ่มสถานบริการ</a>
                            </li>
                            <!-- <li class="nav-item dropdown">
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
                                                                                    </li> -->
                            <li class="nav-item pad">
                                <a href="changpwsite.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item pad">
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
    <div class="container">
        <div class="row " style="padding-bottom:15%">
            <div class="col">
                <form action="#" method="post" id="confirm">
                    <button type="button" style="margin:1em 1em" class="btn btn-primary "><a style="color:black;text-decoration:none" href="addconnect.php">เพิ่มสถานบริการ</a></button>
                    <button onClick="return confirm('คุณต้องการที่จะลบข้อมูลที่เลือกนี้หรือไม่ ?');" class="btn btn-danger" style="margin-right:1em" name="del_all">ลบข้อมูลแถวที่เลือก</button>
                    <a href="connectstatus.php"><img src="../img/refresh.png" width="20" title="Refresh"></a>
                    <table id="example" class="table table-striped table-hover table-sm" style="width:100%">
                        <thead class="bg-info">
                            <tr>
                                <th></th>
                                <th>Number</th>
                                <th>IP Address</th>
                                <th>Username</th>
                                <th>Site Name</th>
                                <th>ซีพียู</th>
                                <th>แรม</th>
                                <th>ฮาร์ดดิส</th>
                                <th>Connect Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql1 = "SELECT * FROM location WHERE cus_id = :cus_id";
                            $query1 = $conn->prepare($sql1);
                            $query1->bindparam(':cus_id',$id);
                            $query1->execute();
                            $no = 0;
                            while ($result = $query1->fetch(PDO::FETCH_ASSOC)) {
                                $no++;
                                $API = new routeros_api();
                                $API->debug = false;
                                $port = $result['api_port'];
                                if ($API->connect($result['ip_address'] . ":" . $port, $result['username'], $result['password'])) {
                                    $ARRAY = $API->comm("/system/resource/print");
                                    $ram =    $ARRAY['0']['free-memory'] / 1048576;
                                    $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
                                    echo "<tr>";
                                    echo "<td><input type=\"checkbox\" class=\"cus_checkbox\" name=\"location_id[]\" value=" . $result['location_id'] . "></td>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $result['ip_address'] . "</td>";
                                    echo "<td>" . $result['username'] . "</td>";
                                    echo "<td>" . $result['working_site'] . "</td>";
                                    echo "<td>" . $ARRAY['0']['cpu-load'] . "%</td>";
                                    echo "<td>" . round($ram, 1) . " MB</td>";
                                    echo "<td>" . round($hdd, 1) . " MB</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i> CONNECT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></td>";
                                    $conn = "connect";
                                    echo "<td>                   
                                <a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการเข้าจัดการ')==true)
                                {window.location='../site/site_conn.php?id=" . $result['location_id'] . "&conn=" . $conn . "'}\">
                                <button type=\"button\" class=\"btn btn-success\" title=\"เข้าบริหารจัดการ\">
                                <i class=\"glyphicon glyphicon-new-window\"></i></button></a>
                                <a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการแก้ไขรายการนี้!')==true)
                                {window.location='addconnect.php?action=edit_site&id=" . $result['location_id'] . "'}\">
                                <button type=\"button\" class=\"btn btn-info\" title=\"แก้ไข\">
                                <i class=\"glyphicon glyphicon-edit\"></i></button></a>
                                <a onClick=\"return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');\" href='connectstatus.php?id_del=".$result['location_id']."'>
                                <button type=\"button\" class=\"btn btn-danger\" title=\"ลบ\">
                                <i class=\"glyphicon glyphicon-trash\"></i></button></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                } else {
                                    echo "<tr>";
                                    echo "<td><input type=\"checkbox\" class=\"cus_checkbox\" name=\"location_id[]\" value=" . $result['location_id'] . "></td>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $result['ip_address'] . "</td>";
                                    echo "<td>" . $result['username'] . "</td>";
                                    echo "<td>" . $result['working_site'] . "</td>";
                                    echo "<td> -% </td>";
                                    echo "<td> - MB </td>";
                                    echo "<td> - MB </td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-times\"></i> DISCONNECT</button></td>";
                                    $conn = "disconnect";
                                    echo "<td>
                                    <a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการเข้าจัดการ')==true)
                                    {window.location='../site/site_conn.php?id=" . $result['location_id'] . "&conn=" . $conn . "'}\">
                                    <button type=\"button\" class=\"btn btn-success\" title=\"เข้าบริหารจัดการ\">
                                    <i class=\"glyphicon glyphicon-new-window\"></i></button></a>
                                    <a href='javascript:void(0)' onClick=\"JavaScript:if(confirm('คุณต้องการแก้ไขรายการนี้!')==true)
                                    {window.location='addconnect.php?action=edit_site&id=" . $result['location_id'] . "'}\">
                                    <button type=\"button\" class=\"btn btn-info\" title=\"แก้ไข\">
                                    <i class=\"glyphicon glyphicon-edit\"></i></button></a>
                                    <a onClick=\"return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');\" href='connectstatus.php?id_del=".$result['location_id']."'>
                                    <button type=\"button\" class=\"btn btn-danger\" title=\"ลบ\">
                                    <i class=\"glyphicon glyphicon-trash\"></i></button></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php } ?>