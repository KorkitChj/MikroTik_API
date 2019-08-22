<?php
session_start();
require('template/template_products.html');
?>
<?php
if (!$_SESSION["register"]) {
  Header("Location:register.php");
} else { ?>
  <title>Payment</title>
  <style>
  </style>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img style="width:50px;height:50px" src="img/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
      <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item ">
            <a href="index.php" class="nav-link"><span class="badge badge-primary"><i class="fas fa-home"></i></span>
              หน้าหลัก</a>
          </li>
          <li class="nav-item">
            <a href="products.php" class="nav-link"><span class="badge badge-success"><i class="fab fa-product-hunt"></i></span>
              สินค้า</a>
          </li>
          <li class="nav-item active">
            <a href="#" class="nav-link active"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>
              สั่งซื้อ</a>
          </li>
          <li class="nav-item">
            <a href="transfer.php" class="nav-link"><span class="badge badge-danger"><i class="fas fa-clipboard-check"></i></span>
              แจ้งโอนเงิน</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="login.php" class="nav-link"><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i></span>
              เข้าสู่ระบบ/สมัครสมาชิก</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="col-dm-6 bg-warning">
      <h1 class="text-center very-large-text"><b>สร้างรายการใหม่</b></h1>
    </div>
    <form id="myform" action="s_payment.php" method="post">
      <div class="col-lg-12 bg-info">
        <h4 class='text'><b>ช่องทางติดต่อ</b></h4>
        <div class="row">
          <div class="col-dm-4 col-sm-6">
            <div class="form-group">
              <p><b><i class="fas fa-address-card"></i>&nbsp;Username</b></p>
              <input class="form-control" type="text" name="name" id="name" placeholder="ชื่อ-นามสกุล" required>
            </div>
          </div>
          <div class="form-group col-md-6">
            <div class="row">
              <div class="col-sm-6">
                <b><label for="my-input" style="margin-top:0.5em;"><i class="fab fa-get-pocket"></i>&nbsp;เลือกรายการสินค้า</label></b>
                <select id="my-input" id="sli" name="sli" class="custom-select" required>
                  <?php
                  error_reporting(0);
                  $aa = $_REQUEST['id'];
                  if (!empty($aa)) {
                    if ($aa == 1) {
                      echo '<option value=""></option>';
                      echo '<option value="500" selected>Mikrotik/6เดือนจำกัดUser 500 คน </option>';
                      echo '<option value="1000">Mikrotik/1ปี ไม่จำกัด User</option>';
                    } else {
                      echo '<option value=""></option>';
                      echo '<option value="500">Mikrotik/6เดือนจำกัดUser 500 คน </option>';
                      echo '<option value="1000" selected>Mikrotik/1ปี ไม่จำกัด User</option>';
                    }
                  }
                  if (empty($aa)) {
                    echo '<option value=""></option>';
                    echo '<option value="500">Mikrotik/6เดือนจำกัดUser 500 คน </option>';
                    echo '<option value="1000">Mikrotik/1ปี ไม่จำกัด User</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <p><b><i class="fas fa-money-check-alt"></i>&nbsp;ชำระเงินได้ที่</b></p>
            <table width="500" cellpadding="0" cellspacing="0" class="table-responsive">
              <thead>
                <tr>
                  <th width="90" height="25" bgcolor="#CCCC66"><b>ชื่อธนาคาร</b></th>
                  <th width="150" bgcolor="#CCCC66"><b>ชื่อบัญชี</b></th>
                  <th width="150" bgcolor="#CCCC66"><b>หมายเลขบัญชี</b></th>
                  <th width="70" bgcolor="#CCCC66"><b>ประเภท</b></th>
                </tr>
                <tr>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ธ.กรุงเทพ </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> นายก่อกิจ ชูจำ</td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> 123456890 </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ออมทรัพย์ </td>
                </tr>
                <tr>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ธ.ไทยพาณิชย์ </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> นายก่อกิจ ชูจำ</td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> 223344556 </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ออมทรัพย์ </td>
                </tr>
                <tr>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ธ.กรุงไทย </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> นายก่อกิจ ชูจำ</td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> 0987654321 </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ออมทรัพย์ </td>
                </tr>
                <tr>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ธ.กสิกรไทย </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> นายก่อกิจ ชูจำ</td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> 5678901234 </td>
                  <td width="150" height="25" align="center" bgcolor="#92C2C2"> ออมทรัพย์ </td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <br>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12 ">
            <?php
            $date = strtotime("+7 day");
            echo "<b>กำหนดชำระภายใน:<b> " . "<input class=\"dl btn btn-danger\" readonly=\"readonly\" value=\"" . date('Y-m-d', $date) . "\" name=\"date\" id=\"date\" />";
            ?>
            <p align="right"><label for="order_ยอดรวม">ยอดรวม</label>
              <input class="finalprice form-control." readonly="readonly" step="any" type="number" value="0.0" name="price" id="order_price" /> บาท
          </div>
        </div>
        <div class="row">
          <div class='col-md-12'>
            <div class="actions">
              <div class='form-group'>
                <div class='text-right'>
                  <button type="submit" class="btn btn-primary" name="sm">ยืนยันการสั่งซื้อ</button>
                  <!-- <button type="submit" class="btn btn-warning" name="in">ใบ Invoice</button> -->
                  <button type="bottom" class="btn btn-danger" onclick="window.history.back();">ยกเลิก</button>
                  <br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
    </form>
  </div>
  <script>
    $(document).ready(function() {
      $(window).on("load", function() {
        var ab = $("select.custom-select option:selected").val();
        $('#order_price').attr('value', ab)
      });
      $("select.custom-select").change(function() {
        var selectedit = $(this).children("option:selected").val();
        $('#order_price').attr('value', selectedit)
      });
    });
  </script>
<?php } ?>