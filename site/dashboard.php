<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../index.php");
}
include('../process/site_admin/expired_process.php');
include('function.php');
error_reporting(0);
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/system/resource/print");
    $boardname =    $ARRAY['0']['board-name'];
    $version =    $ARRAY['0']['version'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/site_admin/bar_top.php"); ?>
        <?php include("../includes/template_backend/site_admin/navigation_site.php"); ?>
        <?php include('../siteadmin/changpwsite.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">การใช้งาน CPU</h6>
                                <div id="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">รุ่นอุปกรณ์</h6>
                                <h2 class="text-right"><i class="fas fa-user f-left"></i><span><?php echo $boardname ?></span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">เวอร์ชั่นซอฟแวร์</h6>
                                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo $version ?></span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">เวลาใช้งาน</h6>
                                <div id="uptime"></div>
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
                        RAMR();
                        setInterval(function() {
                            RAMR();
                        }, 50000);

                        function RAMR() {
                            Highcharts.getOptions().plotOptions.pie.colors = ['#66ccff', '#ffcc00'];
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
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f} %</b><br/>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: false,
                                            },
                                            showInLegend: true
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

                        HDD();
                        setInterval(function() {
                            HDD();
                        }, 50000);

                        function HDD() {
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
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f} %</b><br/>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: false,
                                            },
                                            showInLegend: true
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
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
    <?php include('../process/site_admin/useronlinejs_process.php'); ?>
</body>

</html>