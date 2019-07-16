<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Dashboard</title>
    <?php
    require('../template/template.html');
    include('../siteadmin/expired.php');
    include('../siteadmin/useronlinejs.php');
    include('../siteadmin/changpwsite.php');
    include('function.php');

    $cus_id = $_SESSION['cus_id'];
    $location_id = $_SESSION['location_id'];

    list($ip,$port,$user,$pass,$site,$conn,$API) = fatchuser($cus_id,$location_id);

    ?>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Web API MikroTik</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img src="../img/iconuser.jpg" alt="user" style="height:70px;width:60px">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["cus_name"]); ?></a></strong>
                        </span>
                        <span class="user-role">ผู้ดูแล</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>ทั่วไป</span>
                        </li>
                        <li class="pad-a bor-yellow">
                            <a href="#">
                                <i class="glyphicon glyphicon-dashboard"></i>
                                &nbsp;Dashboard</a>
                        </li>
                        <li>
                            <a href="employeestatus.php">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการพนักงานดูแล</a>
                        </li>
                        <li>
                            <a href="profilestatus.php">
                                <i class="glyphicon glyphicon-th-list"></i>
                                &nbsp;รายการ Profile</a>
                        </li>
                        <li>
                            <a href="wallgardenstatus.php">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                                &nbsp;รายการ ByPass</a>
                        </li>
                        <li>
                            <a href="../siteadmin/connectstatus.php">
                                <i class="glyphicon glyphicon-log-out"></i>&nbsp;
                                กลับหน้าหลัก</a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#" data-toggle="modal" data-target="#logoutModalCenter">
                    <i class="fa fa-power-off">ออกจากระบบ</i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2>ข้อมูลเราเตอร์</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="container">
                            <div class="row">
                                <?php
                                if ($API->connect($ip.":".$port,$user,$pass)) {
                                    $ARRAY = $API->comm("/system/resource/print");
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
                                    ?>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <span class="user-status">
                                                    <i class="fas fa-globe"></i>
                                                    <span>Online</span>
                                                </span>
                                                <h6 class="m-b-20">IP Address/Domain name</h6>
                                                <h2 class="text-right"><i class="fas fa-link f-left"></i><span><?php echo $ip. "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Username</h6>
                                                <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $user ?></span></h2>
                                                <h3><?php echo "Site " . $site . "<hr>" ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-yellow order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Port</h6>
                                                <h2 class="text-right"><i class="fas fa-server f-left"></i><span><?php echo $port . "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Board Name</h6>
                                                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo $boardname . "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-yellow order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Version</h6>
                                                <h2 class="text-right"><i class="fab fa-cloudversify f-left"></i><span><?php echo $version . "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">UpTime</h6>
                                                <h2 class="text-right"><i class="fas fa-clock f-left"></i><span><?php echo $uptime . "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Resource</h6>
                                                <h6>Cpu-Load<h6>
                                                        <h2 class="text-right"><i class="fas fa-microchip f-left"></i><span><?php echo $cpu ?></span></h2>
                                                        <h6>Free-Memory</h6>
                                                        <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo $ram ?></span></h2>
                                                        <h6>Free-HDD-Space</h6>
                                                        <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo $hdd . "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Total</h6>
                                                <h6>Total-HDD</h6>
                                                <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo $totalhdd . "MB" ?></span></h2>
                                                <h6>Total-Memory</h6>
                                                <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo $totalram . "MB<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else { ?>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <span class="user-status">
                                                    <i class="fas fa-globe"></i>
                                                    <span>Offline</span>
                                                </span>
                                                <h6 class="m-b-20">IP Address/Domain name</h6>
                                                <h2 class="text-right"><i class="fas fa-link f-left"></i><span><?php echo $ip ."<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Username</h6>
                                                <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $user ?></span></h2>
                                                <h3><?php echo "Site ".$site."<hr>" ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-yellow order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Port</h6>
                                                <h2 class="text-right"><i class="fas fa-server f-left"></i><span><?php echo $port . "<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Board Name</h6>
                                                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo "- <hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-yellow order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Version</h6>
                                                <h2 class="text-right"><i class="fab fa-cloudversify f-left"></i><span><?php echo "- <hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">UpTime</h6>
                                                <h2 class="text-right"><i class="fas fa-clock f-left"></i><span><?php echo "- <hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Resource</h6>
                                                <h6>Cpu-Load<h6>
                                                        <h2 class="text-right"><i class="fas fa-microchip f-left"></i><span><?php echo "-" ?></span></h2>
                                                        <h6>Free-Memory</h6>
                                                        <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo "-" ?></span></h2>
                                                        <h6>Free-HDD-Space</h6>
                                                        <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo "- <hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Total</h6>
                                                <h6>Total-HDD</h6>
                                                <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo "- MB" ?></span></h2>
                                                <h6>Total-Memory</h6>
                                                <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo "- MB<hr>" ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
<?php } ?>