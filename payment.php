<?php
session_start();
include('includes/datethai_function.php');
include("includes/template_frontend/page_link_config.php");
//error_reporting(0);
if(isset($_SESSION['fullname']) == '' && isset($_SESSION['price']) == ''){
  Header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include("includes/template_frontend/head_tag_contents.php"); ?>
</head>

<body>
  <div class="container" style="margin-top:10px">
    <form id="s_payment" action="" method="POST">
      <div class="row" style="margin:5px">
        <div class="col-lg-12 bg-light shadow-lg p-3 mb-5 rounded border border-danger">
          <h2 style="margin-top:1em" class="text-center very-large-text bg-light"><b>ยืนยันการสั่งซื้อ</b></h2>
          <br>
          <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              <label for="name"><b><i class='fas fa-user'></i>&nbsp;ชื่อ-นามสกุล:</b></label>
              <input class="form-control" readonly="readonly"  value="<?php echo $_SESSION['fullname'];?>" type="text" name="name" id="name" />
            </div>
          </div><br>
          <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              <label for="phone"><b><i class='fas fa-phone'></i>&nbsp;หมายเลขโทรศัพท์:</b></label>
              <input class="form-control" readonly="readonly"  value="<?php echo $_SESSION['phone'];?>" type="text" name="phone" id="phone" />
            </div>
          </div><br>
          <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              <?php
              $date = strtotime("+1 day");
              $datethai = date('Y-m-d H:i:s', $date);
              $datetime = date('Y-m-d H:i:s', $date);
              echo "<label for=\"date\"><b><i class=\"far fa-calendar-alt\"></i>&nbsp;กำหนดชำระภายใน:</b></label>" . "<input class=\"dl btn form-control\" readonly=\"readonly\" value=\"" . DateThai($datethai) . "  (1 วัน)\" name=\"date\" id=\"date\" />";
              ?>
              <input type="hidden" class="form-control" name="datetime" id="datetime" value="<?php echo $datetime ?>">
            </div>
          </div><br>
          <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              <label for="order_name"><b><i class='fas fa-product-hunt'></i>&nbsp;สินค้า:</b></label>
              <input class="form-control" value="<?php echo $_SESSION['title']?>" readonly="readonly" type="text" name="order_name" id="order_name" />
            </div>
          </div><br>
          <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              <label for="order_price"><b><i class='fab fa-btc'></i>&nbsp;ยอดรวม: (บาท)</b></label>
              <input class="finalprice form-control" value="<?php echo $_SESSION['price']?>" readonly="readonly" step="any" type="number" name="order_price" id="order_price" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <center>
                <div class="table-responsive">
                  <table class="table-sm table-striped border border-danger rounded shadow-lg p-3 mb-5 bg-white">
                    <thead class="table-info">
                      <tr>
                        <th><b>ชื่อธนาคาร</b></th>
                        <th><b>ชื่อบัญชี</b></th>
                        <th><b>หมายเลขบัญชี</b></th>
                        <th><b>ประเภท</b></th>
                        <th><b>สาขา</b></th>
                      </tr>
                    </thead>
                    <tbody class="table-warning">
                      <tr>
                        <td><i class="fas fa-dot-circle"></i> ธ.ไทยพาณิชย์ </td>
                        <td> นายก่อกิจ ชูจำ</td>
                        <td><b>512-292422-9</b></td>
                        <td> ออมทรัพย์ </td>
                        <td> ตรัง </td>
                      </tr>
                      <tr>
                        <td><i class="fas fa-dot-circle"></i> ธ.กรุงไทย </td>
                        <td> นายก่อกิจ ชูจำ</td>
                        <td><b>903-0-76826-6</b></td>
                        <td> ออมทรัพย์ </td>
                        <td> ตรัง </td>
                      </tr>
                    </tbody>
                  </table>
              <img src="img/SCB.png" alt="scb">
              <img src="img/KTB.png" alt="KTB"></center>
            </div>
          </div><br>
          <div class="row d-flex justify-content-center">
            <div class='col-md-6'>
              <center>
                <input type="submit" class="btn btn-primary" name="submitBtn" id="submitBtn" value="ยืนยัน">
                <button type="button" class="btn btn-danger" onclick="window.history.back();">ยกเลิก</button></center>
            </div>
          </div>
          <br><br>
          <div class="row d-flex justify-content-center">
            <div class='col-md-6'>
            <center><i class="fas fa-link"></i><a href="transfer.php">แจ้งโอนเงิน</a></center>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="js/main_site/payment.js"></script>
  <?php include("includes/template_frontend/footer.php"); ?>

</body>

</html>