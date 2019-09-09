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

        include('service_fetch.php');

        list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

        if ($API->connect($ip . ":" . $port, $user, $pass)) {
            $ARRAY = $API->comm("/system/resource/print");
            $cpu = $ARRAY['0']['cpu-load'] . "%";
            $boardname =    $ARRAY['0']['board-name'];
            $version =    $ARRAY['0']['version'];
            $uptime =    $ARRAY['0']['uptime'];
        }

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
                        <?php echo fetchimage($cus_id); ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span>&nbsp;<?php print_r($_SESSION["cus_name"]); ?></a></strong>
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
                            <a href="interfacemonitor.php">
                                <i class="glyphicon glyphicon-signal"></i>
                                &nbsp;Interface Monitor</a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการพนักงานดูแล</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="employeestatus.php" id="addemployee">
                                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;เพิ่มพนักงาน
                                        </a>
                                    </li>
                                    <li>
                                        <a href="employeeactive.php" id="employeeactive">
                                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;พนักงานออลไลน์
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-flag"></i>
                                &nbsp;Address List</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="addresslist.php" id="addresslistBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Address List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pool.php" id="addPoolBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Address Pool
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-wrench"></i>
                                &nbsp;Hotspot Setup</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="addserverprofile.php" id="addserverprofileBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="addserver.php" id="addserverBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
                        <!-- <li>
                            <?php
                                if ($service == 1) {
                                    echo '<a href="">
                                    <i class="glyphicon glyphicon-menu-hamburger"></i>
                                    &nbsp;รายการ AA</a>';
                                } else {
                                    echo '<a href="">
                                    <i class="glyphicon glyphicon-menu-hamburger"></i>
                                    &nbsp;รายการ BB</a>';
                                }
                                ?>
                        </li> -->
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
                <a href="#" class="logout">
                    <i class="fas fa-sign-out-alt">ออกจากระบบ</i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2>ข้อมูลเราเตอร์</h2>
                <hr>
                <div style="margin-bottom:20px">
                    <h5><a href="../siteadmin/connectstatus.php">หน้าหลัก</a>><a href="#" style="color:black;text-decoration:underline">Dashboard</a></h5>
                </div>
                <!-- <button type="button" style="margin-bottom:20px" class="btn btn-warning" onclick="window.location.href='dashboard.php'"><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button> -->
                <div class="box-1">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">CPU Load</h6>
                                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $cpu ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Boardname</h6>
                                    <h2 class="text-right"><i class="fas fa-user f-left"></i><span><?php echo $boardname ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Version</h6>
                                    <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo $version ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">UP Time</h6>
                                    <h2 class="text-right"><i class="fab fa-cloudversify f-left"></i><span><?php echo $uptime ?></span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="row">
                        <div class="col col-sm">
                            <div id="container" style="width:100%; height:400px;"></div>
                        </div>
                        <div class="col col-sm">
                            <div id="container2" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        // //RAM RESOURCES
                        Ramr();
                        setInterval(function() {
                            Ramr();
                        }, 50000);

                        function Ramr() {
                            Highcharts.getOptions().plotOptions.pie.colors = ['#ffcc00', '#ff751a'];
                            $.getJSON("resources_ram_router.php", function(data) {
                                seriesData = data;
                                $('#container').highcharts({
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'หน่วยความจำ Ram'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y} MB or {point.percentage:.1f} %',
                                                style: {
                                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                                }
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'จำนวน',
                                        colorByPoint: true,
                                        data: seriesData

                                    }]
                                });
                            });
                        }

                        //HDD RESOURCES
                        Hdd();
                        setInterval(function() {
                            Hdd();
                        }, 50000);

                        function Hdd() {
                            $.getJSON("resources_hdd_router.php", function(data2) {
                                seriesData = data2;
                                $('#container2').highcharts({
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'หน่วยความจำ HDD'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y} MB or {point.percentage:.1f} %',
                                                style: {
                                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                                }
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'จำนวน',
                                        colorByPoint: true,
                                        data: seriesData

                                    }]
                                });
                            });
                        }
                    });
                </script>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
<?php } ?>