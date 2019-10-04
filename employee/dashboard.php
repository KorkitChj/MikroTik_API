<?php
session_start();
include("../includes/template_backend/employee/a_config.php");
if (!$_SESSION["emp_id"]) {
    Header("Location:../index.php");
}
include('function.php');

$emp_id = $_SESSION['emp_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($emp_id);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../includes/template_backend/admin/head-tag-contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/employee/navigation_site.php"); ?>
        <main class="page-content">
            <div class="container-fluid">
                <h5>ข้อมูลเราเตอร์</h5>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="box">
                            <div class="row">
                                <div class="col-md">
                                    <button type=" button" class="btn btn-sm btn-warning" onclick="window.location.href='dashboard.php'"><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;Reconnect</button>
                                </div>
                                <div class="col-md">
                                    <div class="float-right">
                                        <div id="disconnect">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <?php
                                if ($API->connect($ip . ":" . $port, $user, $pass)) {
                                    $ARRAY = $API->comm("/system/resource/print");
                                    $ARRAY1 = $API->comm("/ip/hotspot/user/print");
                                    $ram =    $ARRAY['0']['free-memory'] / 1048576;
                                    $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
                                    $cpu = $ARRAY['0']['cpu-load'] . "%";
                                    $ram = round($ram, 1) . "MB";
                                    $hdd = round($hdd, 1) . "MB";
                                    $boardname =    $ARRAY['0']['board-name'];
                                    $version =    $ARRAY['0']['version'];
                                    $uptime =    $ARRAY['0']['uptime'];
                                    $totalhdd =    $ARRAY['0']['total-hdd-space'] / 1048576;
                                    $totalram =    $ARRAY['0']['total-memory'] / 1048576;
                                    $user_router1 = count($ARRAY1);
                                    $user_router = $user_router1 - 1;
                                    ?>
                                    <div class="col-md-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Username</h6>
                                                <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $user ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-c-yellow order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Users</h6>
                                                <div id="usercount"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">UpTime</h6>
                                                <div id="uptime"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else { ?>
                                    <div class="col-md-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Username</h6>
                                                <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $user ?></span></h2>
                                                <h3><?php echo "Site " . $site . "<hr>" ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">UpTime</h6>
                                                <h2 class="text-right"><i class="fas fa-clock f-left"></i><span><?php echo "- <hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
    <script src="../js/alert_disconnect_emp_site.js"></script>
</body>

</html>