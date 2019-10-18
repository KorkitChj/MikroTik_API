<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
  Header("Location:../index.php");
}
include('../process/site_admin/function.php');
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
        <h2>ใบ Invoice</h2>
        <div class="row">
          <div class="form-group col-md-12">
            <a href="<?php echo '../process/site_admin/print_invoice_process.php?id=' . $_SESSION["cus_id"] . '' ?>" class="btn btn-primary pull pull-right" id="invoice">
              <span class="glyphicon glyphicon-print"></span>พิมพ์
            </a>
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