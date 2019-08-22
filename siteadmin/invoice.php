<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
  Header("Location:../login.php");
} else { ?>
  <title>Invoice</title>
  <?php
  include('expired.php');
  require('../template/template.html');
  include('useronlinejs.php');
  include('changpwsite.php');
  ?>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-light" href="#">
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
            <li>
              <a href="connectstatus.php">
                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
            </li>
            <li class="pad-a bor-red">
              <a href="">
                <i class="glyphicon glyphicon-paperclip"></i>&nbsp;Invoice</a>
            </li>
            <li>
              <a href="" data-toggle="modal" data-target="#changpwModal">
                <i class="glyphicon glyphicon-edit"></i>
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
        <h2>รายการ Invoice</h2>
        <hr>
        <div class="row">
          <div class="form-group col-md-12">
            <a href="<?php echo 'print_invoice.php?id=' . $_SESSION["cus_id"] . '' ?>" class="btn btn-primary pull pull-right" id="invoice">
              <span class="glyphicon glyphicon-print"></span>พิมพ์
            </a>
            <br /><br />
          </div>
        </div>
      </div>
    </main>
    <!-- page-content" -->
  </div>
<?php } ?>