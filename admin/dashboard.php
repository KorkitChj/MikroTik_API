<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
<title>Dashboard</title>
<?php
    $admin_name = $_SESSION["admin_name"];
    require('../include/connect_db.php');
    require('../template/template.html');
    require('function.php');
    include('changpw.php');

    $query = $conn->prepare("SELECT * FROM siteadmin");
    $query->execute();
    $numrow = $query->rowCount();
    $result = $query->fetchAll();

    $result =  $conn->prepare("SELECT*
FROM siteadmin AS a INNER JOIN orderpd AS b ON
a.cus_id = b.cus_id INNER JOIN payment AS c ON
b.order_id = c.order_id WHERE c.paid = 0");
    $result->execute();
    $numrow2 = $result->rowCount();

    $result2 =  $conn->query("SELECT*
    FROM siteadmin AS a INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id INNER JOIN payment AS c ON
    b.order_id = c.order_id WHERE c.paid = 1");
    $result2->execute();
    $numrow3 = $result2->rowCount();

    $query2 = "SELECT* FROM login_details 
    INNER JOIN siteadmin 
    ON login_details.cus_id = siteadmin.cus_id WHERE last_activity > DATE_SUB(NOW(),INTERVAL 5 SECOND)";
    $statement = $conn->prepare($query2);
    $statement->execute();
    $count = $statement->rowCount();
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
                    <?php echo admin_image_profile($admin_name); ?>
                </div>
                <div class="user-info">
                    <span class="user-name">
                        <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span>&nbsp;<?php print_r($_SESSION["admin_name"]); ?></a></strong>
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
                    <li class="pad-a bor-red">
                        <a href="#">
                            <i class="fas fa-tachometer-alt"></i>&nbsp;dashboard</a>
                    </li>
                    <li>
                        <a href="admin.php">
                            <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                    </li>
                    <li>
                        <a href="checkpayment.php">
                            <i class="glyphicon glyphicon-check"></i>&nbsp;
                            ยืนยันการชำระเงิน</a>
                    </li>
                    <li>
                        <a href="manage.php">
                            <i class="glyphicon glyphicon-list"></i>&nbsp;
                            จัดการเจ้าของไซต์</a>
                    </li>
                    <li>
                        <a href="useronline.php">
                            <i class="glyphicon glyphicon-globe"></i>&nbsp;
                            User Online</a>
                    </li>
                    <li>
                        <a href="" data-toggle="modal" data-target="#changpwModal">
                            <i class="glyphicon glyphicon-edit"></i>&nbsp;
                            เปลี่ยนรหัสผ่าน</a>
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
            <h2>ข้อมูลการใช้บริการระบบ</h2>
            <hr>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">จำนวนลูกค้าทั้งหมด</h6>
                            <h2 class="text-right"><i class="fas fa-users f-left"></i><span><?php echo $numrow . " คน" ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">จำนวนลูกค้าที่รอยืนยันชำระเงิน</h6>
                            <h2 class="text-right"><i class="fas fa-user f-left"></i><span><?php echo   $numrow2 . " คน" ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">จำนวนลูกค้าที่ใช้งานทั้งหมด</h6>
                            <h2 class="text-right"><i class="fas fa-users  f-left"></i><span><?php echo $numrow3 . " คน" ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">จำนวนลูกค้าที่ออนไลน์</h6>
                            <h2 class="text-right"><i class="fas fa-signal  f-left"></i><span><?php echo $count . " คน" ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm">
                    <div id="container" style="width:100%; height:400px;"></div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    //RESOURCES
                    resource();
                    setInterval(function() {
                        resource();
                    }, 50000);

                    function resource() {
                        // Create the chart
                        Highcharts.chart('container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ข้อมูลการใช้บริการ'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: 'จำนวนคน'
                                }

                            },
                            legend: {
                                enabled: false
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y:1f} คน'
                                    }
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f} คน</b><br/>'
                            },
                            series: [{
                                name: "Users",
                                colorByPoint: true,
                                data: [
                                    {
                                        name: "จำนวนลูกค้าทั้งหมด",
                                        y: <?php echo $numrow ?>
                                    },
                                    {
                                        name: "จำนวนลูกค้าที่รอยืนยันชำระเงิน",
                                        y: <?php echo $numrow2 ?>
                                    },
                                    {
                                        name: "จำนวนลูกค้าที่ใช้งานทั้งหมด",
                                        y: <?php echo $numrow3 ?>
                                    },
                                    {
                                        name: "จำนวนลูกค้าที่ออนไลน์",
                                        y: <?php echo $count ?>
                                    }
                                ],
                            }]
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