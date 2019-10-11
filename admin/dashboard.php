<?php
session_start();
include("../includes/template_backend/admin/page_link_config.php");
$admin_name = $_SESSION["admin_name"];
if (!$_SESSION["admin_id"]) {
    Header("Location:../index.php");
}
include('../includes/db_connect.php');
include('../process/admin/function.php');

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
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
<?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
    <?php include("../includes/template_backend/admin/navigation.php"); ?>
    <?php include('changpw.php');?>
        <main class="page-content">
            <div class="container-fluid">
                <!-- <h2>ข้อมูลการใช้บริการระบบ</h2>
                <hr> -->
                <!-- <div class="box-1">
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
                </div> -->
                <div class="row">
                    <div class="col col-sm">
                        <div class="box">
                            <div id="container" style="width:100%; height:400px;"></div>
                        </div>
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
                            // Build the chart
                            Highcharts.chart('container', {
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie'
                                },
                                title: {
                                    text: 'ข้อมูลการใช้บริการ'
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f} คน</b><br/>'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: {
                                            enabled: false
                                        },
                                        showInLegend: true
                                    }
                                },
                                series: [{
                                    name: 'Users',
                                    colorByPoint: true,
                                    data: [{
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
                                    ]
                                }]
                            });
                        }
                    });
                </script>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
</body>
</html>