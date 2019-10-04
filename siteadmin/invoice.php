<?php
session_start();
include("../includes/template_backend/site_admin/a_config.php");
if (!$_SESSION["cus_id"]) {
  Header("Location:../index.php");
}
include('expired.php');
include('function.php');
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once("../includes/template_backend/admin/head-tag-contents.php"); ?>
</head>

<body>
  <?php include("../includes/template_backend/admin/bar_top.php"); ?>
  <div class="page-wrapper chiller-theme toggled">
    <?php include("../includes/template_backend/site_admin/navigation.php"); ?>
    <?php include('changpwsite.php'); ?>
    <main class="page-content">
      <div class="container-fluid">
        <h2>ใบ Invoice</h2>
        <div class="row">
          <div class="form-group col-md-12">
            <a href="<?php echo 'print_invoice.php?id=' . $_SESSION["cus_id"] . '' ?>" class="btn btn-primary pull pull-right" id="invoice">
              <span class="glyphicon glyphicon-print"></span>พิมพ์
            </a>
            <br /><br />
          </div>
        </div>
      </div>
      <?php include("../includes/template_backend/admin/footer.php"); ?>
      <?php include('useronlinejs.php');?>
    </main>
  </div>
</body>

</html>