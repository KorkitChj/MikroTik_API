<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../index.php");
}
include('../includes/db_connect.php');
include('../includes/datethai_function.php');
include('../process/site_admin/function.php');
$statement = $conn->prepare("SELECT * FROM orderpd AS a 
INNER JOIN product AS b on a.product_id = b.product_id 
INNER JOIN siteadmin AS c on a.cus_id = c.cus_id 
INNER JOIN payment AS d on a.order_id = d.order_id 
WHERE c.cus_id = :cus_id");
$statement->bindParam(':cus_id', $_SESSION['cus_id']);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/site_admin/navigation.php"); ?>
        <?php include('changpwsite.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <h2>รายงานการสั่งซื้อ</h2>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-info">
                                    <tr>
                                        <th scope="col">หมายเลขสั่งซื้อ</th>
                                        <th scope="col">ราคา</th>
                                        <th scope="col">ชื่อสินค้า</th>
                                        <th scope="col">วันชำระเงิน</th>
                                        <th scope="col">วันหมดอายุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $result2) { ?>
                                        <tr>
                                            <th scope="row"><?= $result2['order_id'] ?></th>
                                            <td><?= $result2['total_cash'] ?></td>
                                            <td><?= $result2['product_name'] ?></td>
                                            <td><?= dateThai($result2['transfer_date']) ?></td>
                                            <td><?= dateThai($result2['expired_date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <br /><br />
                    </div>
                </div>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
            <?php include('../process/site_admin/useronlinejs_process.php'); ?>
        </main>
    </div>
</body>

</html>