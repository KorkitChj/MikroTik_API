<?php
require('../site/conn.php');
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <style>
        .container {
            margin-top: 0.1em;
            background-color:white;
            padding: 20px;
        }
        th {
            color: darkblue;
        }
        table.dataTable thead th{
            border-bottom: 0;
        }
        .pad-a{
            background-color:rgba(0, 0, 0, 0.3);
        }
        .bg-info {
            background: #bdc3c7;
            background: linear-gradient(to bottom, #bdc3c7, #2c3e50);
            background: -webkit-linear-gradient(to bottom, #2c3e50, #bdc3c7);
        }
        #refresh{
            margin-left:1em;
            padding: 1em;
        }
        #refresh:hover{
            background-color: rgba(0, 0, 0, 0.3);
            width: 5%;
        }
    </style>
    <title>Employee</title>
    <?php
    error_reporting(0);
	if (!empty($_GET['id_conn'])) {
		$_SESSION['emp_id'] = $_GET['id_conn'];
		$emp_id =  $_GET['id_conn'];
		if ($_GET['conn'] == "connect") {
			echo "<meta http-equiv='refresh' content='0;url=useronline.php?emp_id=" . $emp_id . "' />";
		} else {
			echo "<script language='javascript'>alert('Disconnect')</script>";
			echo "<script language='javascript'>window.location='employee.php'</script>";
			exit();
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
                    <a class="navbar-brand" href="employee.php"><span style="color:White">Employee</span><span style="color:blue">|</span><?php print_r($_SESSION["emp_name"]); ?></a>
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
                                <a href="changpwemp.php" class="nav-link">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item pad">
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
                    <h3 style="font-weight:bold;margin:1em">Site Detial</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
            <div id="refresh"><a href="employee.php"><img src="../img/refresh.png" width="20" title="Refresh"></a></div>
                <table id="example" class="table table-striped table-sm" style="width:100%">
                    <thead class="bg-info">
                        <tr>
                            <th>IP Address</th>
                            <th>Port</th>
                            <th>Site</th>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>Harddisk</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $_SESSION['emp_id'];
                        $sql = "SELECT a.emp_id,a.username,a.pass_router,b.api_port,b.ip_address,b.working_site FROM employee AS a INNER JOIN 
                            location AS b ON a.location_id = b.location_id WHERE a.emp_id = :id";
                        $query = $conn->prepare($sql);
                        $query->bindparam(':id', $id);
                        $query->execute();
                        $result = $query->fetch(PDO::FETCH_ASSOC);
                        $ip_address = $result['ip_address'];
                        $port = $result['api_port'];
                        $working_site = $result['working_site'];
                        $username = $result['username'];
                        $pass_router = $result['pass_router'];
                        if ($API->connect($ip_address . ":" . $port, $username, $pass_router)) {
                            $ARRAY = $API->comm("/system/resource/print");
                            $ram =    $ARRAY['0']['free-memory'] / 1048576;
                            $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
                            echo "<tr>";
                            echo "<td>" . $result['ip_address'] . "</td>";
                            echo "<td>" . $result['api_port'] . "</td>";
                            echo "<td>" . $result['working_site'] . "</td>";
                            echo "<td>" . $ARRAY['0']['cpu-load'] . "%</td>";
                            echo "<td>" . round($ram, 1) . " MB</td>";
                            echo "<td>" . round($hdd, 1) . " MB</td>";
                            echo "<td><button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i> CONNECT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></td>";
                            $conn = "connect";
                            echo "<td>                   
                                <a onclick=\"return confirm('คุณต้องการเข้าจัดการ')\" href=\"employee.php?id_conn=" . $result['emp_id'] . "&conn=" . $conn . "\">
                                <button type=\"button\" class=\"btn btn-success\" title=\"เข้าบริหารจัดการ\">
                                <i class=\"glyphicon glyphicon-new-window\"></i></button></a>";
                            echo "</td>";
                            echo "</tr>";
                        } else {
                            echo "<tr>";
                            echo "<td>" . $result['ip_address'] . "</td>";
                            echo "<td>" . $result['api_port'] . "</td>";
                            echo "<td>" . $result['working_site'] . "</td>";
                            echo "<td> -% </td>";
                            echo "<td> - MB </td>";
                            echo "<td> - MB </td>";
                            echo "<td><button type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-times\"></i> DISCONNECT</button></td>";
                            $conn = "disconnect";
                            echo "<td>
                                    <a onclick=\"return confirm('คุณต้องการเข้าจัดการ')\" href=\"employee.php?id_conn=" . $result['emp_id'] . "&conn=" . $conn . "\">
                                    <button type=\"button\" class=\"btn btn-success\" title=\"เข้าบริหารจัดการ\">
                                    <i class=\"glyphicon glyphicon-new-window\"></i></button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').dataTable({
                "bProcessing": true,
                "sAutoWidth": false,
                "bDestroy": true,
                "sPaginationType": "bootstrap", // full_numbers
                "iDisplayStart ": 10,
                "iDisplayLength": 10,
                "bPaginate": false, //hide pagination
                "bFilter": false, //hide Search bar
                "bInfo": false, // hide showing entries
            })
        });
    </script>
<?php } ?>