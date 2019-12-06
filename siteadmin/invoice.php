<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
  Header("Location:../home");
}
include('../process/site_admin/function.php');
require_once '../includes/db_connect.php';
$statement = $conn->prepare('SELECT * FROM siteadmin AS a 
INNER JOIN orderpd AS b ON a.cus_id = b.cus_id
INNER JOIN payment AS c ON b.order_id = c.order_id
INNER JOIN product AS d ON d.product_id = b.product_id  
WHERE a.cus_id = :id');
$statement->execute(
  array(
    ':id' => (int) $_SESSION["cus_id"]
  )
);
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once("../includes/template_backend/admin/head_tag_contents.php"); ?>
  <link rel="stylesheet" href="../css/styles_pdf.css">
  <style>
    .col-md-12 {
      padding-right: 15px;
      padding-left: 15px;
    }
  </style>
</head>

<body>
  <?php include("../includes/template_backend/admin/bar_top.php"); ?>
  <div class="page-wrapper chiller-theme toggled">
    <?php include("../includes/template_backend/site_admin/navigation.php"); ?>
    <?php include('changpwsite.php'); ?>
    <main class="page-content">
      <div class="container-fluid">
        <div class="box">
          <h2>ใบ Invoice</h2>
          <div class="row">
            <div class="form-group col-md-12">
              <a href="../process/site_admin/print_invoice_process.php?id=<?= $_SESSION["cus_id"] ?>" class="btn btn-success pull pull-right" id="invoice">
                <span class="glyphicon glyphicon-download-alt"></span>&nbsp;PDF
              </a>
              <br /><br />
              <header class="clearfix">
                <div id="logo">
                  <img src="../img/api-logo1.png" width="130px">
                </div>
                <h1 style="background: url('../img/dimension.png');">INVOICE </h1>
                <div id="company" class="clearfix">
                  <div>ThaiMikrotikAPI.com</div>
                  <div>15/6 ต.โคกยาง อ.กันตัง จ.ตรัง,<br /> 92110, TRG</div>
                  <div>(+66) 950244234</div>
                  <div><a class="amail" href="mailto:kokig_kao@hotmail.com">kokig_kao@hotmail.com</a></div>
                </div>
                <div id="project">
                  <div><span>ลูกค้า&nbsp;&nbsp;</span><?= $row['full_name'] ?></div>
                  <div><span>ที่อยู่&nbsp;&nbsp;</span><?= $row['add_ress'] ?></div>
                  <div><span>หมายเลขโทรศัพท์&nbsp;&nbsp;</span><?= $row['work_phone'] ?></div>
                  <div><span>อีเมล&nbsp;&nbsp;</span> <a class="amail" href="mailto:<?= $row['e_mail'] ?>"><?= $row['e_mail'] ?></a></div>
                  <div><span>ไซต์งาน&nbsp;&nbsp;</span><?= $row['site_name'] ?></div>
                </div>
              </header>
              <main>
                <div class="table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <th class="service">สินค้า</th>
                        <th class="desc">รายละเอียด</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="service"><?= $row['product_name'] ?></td>
                        <td class="desc"><?= $row['title'] ?></td>
                        <td class="unit"><?= $row['price'] ?></td>
                        <td class="qty">1</td>
                        <td class="total"><?= $row['price'] ?></td>
                      </tr>
                      <tr>
                        <td colspan="4" class="grand total">ราคารวม</td>
                        <td class="grand total"><?= $row['price'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </main>
              <!-- <div id="foot" style="margin-top:1em;">
                  ขอบคุณที่ใช้บริการของเรา จากเรา ThaiMikrotikAPI.com
                </div> -->
            </div>
          </div>
        </div>
        <?php include("../includes/template_backend/admin/footer.php"); ?>
        <?php include('../process/site_admin/useronlinejs_process.php'); ?>
    </main>
  </div>
  </div>
</body>

</html>