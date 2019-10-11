<?php
session_start();
include('includes/datethai_function.php');
include("includes/template_frontend/page_link_config.php");
?>
<!DOCTYPE html>
<html>

<head>
  <?php include("includes/template_frontend/head_tag_contents.php"); ?>
</head>

<body>
  <?php include("includes/template_frontend/navigation.php"); ?>
  <div class="container margin-top">
    <form id="s_payment" action="" method="post">
      <div class="col-lg-12 bg-light shadow-lg p-3 mb-5 rounded border border-danger">
        <h1 style="padding:3px" class="text-center very-large-text bg-light"><b>สร้างรายการสั่งซื้อ</b></h1>
        <h4 class='text'><b>ช่องทางติดต่อ</b></h4>
        <div class="row">
          <?php
          if (isset($_SESSION['user_register']) == '') { ?>

          <?php } else { ?>
            <div class="col-md-6 form-group">
              <p><b><i class="fas fa-address-card"></i>&nbsp;Username</b></p>
              <div class="col-sm-12 input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $_SESSION['user_register'] ?>" required>
              </div>
            </div>
          <?php } ?>
          <div class="form-group col-md-6">
            <b><label for="my-input" style="margin-top:0.5em;"><i class="fab fa-get-pocket"></i>&nbsp;เลือกรายการสินค้า</label></b>
            <select id="my-input" id="sli" name="sli" class="custom-select" required>
              <?php
              $aa = $_REQUEST['id'];
              if (!empty($aa)) {
                if ($aa == 1) { ?>
                  <option value="200" selected>1 เดือน</option>';
                <?php } else if ($aa == 2) { ?>
                  <option value="300" selected>3 เดือน</option>';
                <?php } else if ($aa == 3) { ?>
                  <option value="500" selected>6 เดือน</option>';
                <?php } else if ($aa == 4) { ?>
                  <option value="1000" selected>1 ปี</option>';
                <?php } else if ($aa == 5) { ?>
                  <option value="1500" selected>1 ปี 6 เดือน</option>';
                <?php } else if ($aa == 6) { ?>
                  <option value="2000" selected>2 ปี</option>';
              <?php }
              } ?>
              <?php if (empty($aa)) { ?>
                <option value="200">Mikrotik/1 เดือน</option>';
                <option value="300">Mikrotik/3 เดือน</option>';
                <option value="500">Mikrotik/6 เดือนจำกัดUser 500 คน</option>';
                <option value="1000">Mikrotik/1 ปี ไม่จำกัด User</option>';
                <option value="1500">Mikrotik/1 ปี 6 เดือน</option>';
                <option value="2000">Mikrotik/2 ปี</option>';
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md">
            <p id="py"><b><i class="fas fa-money-check-alt"></i>&nbsp;ชำระเงินได้ที่</b></p>
            <div class="table-responsive">
              <table class="table-sm table-striped border border-danger rounded shadow-lg p-3 mb-5 bg-white">
                <thead class="table-info">
                  <tr>
                    <th><b>ชื่อธนาคาร</b></th>
                    <th><b>ชื่อบัญชี</b></th>
                    <th><b>หมายเลขบัญชี</b></th>
                    <th><b>ประเภท</b></th>
                  </tr>
                </thead>
                <tbody class="table-warning">
                  <tr>
                    <td> ธ.กรุงเทพ </td>
                    <td> นายก่อกิจ ชูจำ</td>
                    <td> 123456890 </td>
                    <td> ออมทรัพย์ </td>
                  </tr>
                  <tr>
                    <td> ธ.ไทยพาณิชย์ </td>
                    <td> นายก่อกิจ ชูจำ</td>
                    <td> 223344556 </td>
                    <td> ออมทรัพย์ </td>
                  </tr>
                  <tr>
                    <td> ธ.กรุงไทย </td>
                    <td> นายก่อกิจ ชูจำ</td>
                    <td> 0987654321 </td>
                    <td> ออมทรัพย์ </td>
                  </tr>
                  <tr>
                    <td> ธ.กสิกรไทย </td>
                    <td> นายก่อกิจ ชูจำ</td>
                    <td> 5678901234 </td>
                    <td> ออมทรัพย์ </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <br>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <?php
            $date = strtotime("+7 day");
            $datethai = date('Y-m-d H:i:s', $date);
            $datetime = date('Y-m-d H:i:sa', $date);
            echo "<label for=\"date\"><b><i class=\"far fa-calendar-alt\"></i>&nbsp;กำหนดชำระภายใน:</b></label>" . "<input class=\"dl btn form-control\" readonly=\"readonly\" value=\"" . DateThai($datethai) ."  (7 วัน)\" name=\"date\" id=\"date\" />";
            ?>
            <input type="hidden" class="form-control" name="datetime" id="datetime" value="<?php echo $datetime ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="order_price">&nbsp;&nbsp;<b><i class="fas fa-hand-holding-usd"></i>&nbsp;ยอดรวม</b></label>
            <div class="col-sm-12 input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-hand-holding-usd"></i>
                </div>
              </div>
              <input class="finalprice form-control" readonly="readonly" step="any" type="number" name="order_price" id="order_price" /> &nbsp;&nbsp;บาท
            </div>
          </div>
        </div>
        <div class="row">
          <div class='form-group col-md-12'>
            <?php if (isset($_SESSION['user_register']) == '') { ?>
              <button type="bottom" class="btn btn-primary" name="register" onclick="window.location.href='register.php?user=user_register'">สมัครสมาชิก</button>
              <button type="bottom" class="btn btn-danger" onclick="window.history.back();">ยกเลิก</button>
            <?php } else { ?>
              <button type="submit" class="btn btn-primary" name="sm">ยืนยันการสั่งซื้อ</button>
              <button type="bottom" class="btn btn-danger" onclick="window.history.back();">ยกเลิก</button>
            <?php } ?>
            <br><br>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="js/main_site/payment.js"></script>
  <?php include("includes/template_frontend/footer.php"); ?>

</body>

</html>