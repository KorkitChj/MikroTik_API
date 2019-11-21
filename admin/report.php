<?php
session_start();
include("../includes/template_backend/admin/page_link_config.php");
$admin_name = $_SESSION["admin_name"];
if (!$_SESSION["admin_id"]) {
    Header("Location:../home");
}
include('../includes/db_connect.php');
include('../includes/datethai_function.php');
include('../process/admin/function.php');

$result =  $conn->prepare("SELECT b.product_name,b.title,b.price,COUNT(*) AS c,SUM(price)  AS s
FROM orderpd AS a INNER JOIN product AS b ON a.product_id = b.product_id
INNER JOIN payment AS c ON c.order_id = a.order_id
WHERE c.paid = 1 GROUP BY b.product_id ORDER BY 4 DESC");
$result->execute();
$numrow2 = $result->rowCount();

$result2 =  $conn->prepare("SELECT SUM(total_cash) AS sum FROM orderpd AS a INNER JOIN payment AS b ON a.order_id = b.order_id WHERE b.paid = 1");
$result2->execute();
$sum = $result2->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
    <link rel="stylesheet" href="../css/styles_sale.css">
</head>

<body>
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/admin/navigation.php"); ?>
        <?php include('changpw.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-sm">
                        <div class="box">
                            <div id="container">
                                <div id="body">
                                    <main>
                                        <div id="details" class="clearfix">
                                            <div id="invoice">
                                                <h1 class="name">รายงานการขาย</h1>
                                                <div class="date">วันที่ <?= dateThai(date('Y-m-d H:i:s')) ?></div>
                                            </div>
                                            <div id="client">
                                                <h2 class="name">รายการขายดี</h2>
                                                <div class="name">รายการขายดีเรียงจากมากไปน้อย</div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <p><a href="../process/admin/print_sale_process.php?id=print" class="btn btn-success pull pull-right" id="invoice">
                                                <span class="glyphicon glyphicon-download-alt"></span>&nbsp;PDF
                                            </a></p>
                                            <h2 id="count"><?= $numrow2 ?>&nbsp;รายการ</h2>
                                            <table class="shadow p-3 mb-5" border="0" cellspacing="0" cellpadding="0">
                                                <thead>
                                                    <tr>
                                                        <th class="no">#</th>
                                                        <th class="desc">รายละเอียด</th>
                                                        <th class="unit">ราคา<br>(บาท)</th>
                                                        <th class="qty">จำนวน<br>(รายการ)<br><i class="fas fa-sort-amount-up"></i> </th>
                                                        <th class="total">รวมราคา<br>(บาท)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0;
                                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <td class="no"><?= $i ?></td>
                                                            <td class="desc">
                                                                <h3><?= $row['product_name'] ?></h3><?= $row['title'] ?>
                                                            </td>
                                                            <td class="unit"><?= $row['price'] ?></td>
                                                            <td class="qty"><?= $row['c'] ?></td>
                                                            <td class="total"><?= $row['s'] ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td colspan="2">ราคาทั้งสิน</td>
                                                        <td><?= $sum['sum'] ?>&nbsp;บาท</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
</body>

</html>