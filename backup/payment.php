<?php
require('template/template_customer.html');
?>
<title>Payment</title>
<div class="container-fluid">
  <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php"><img style="width:50px;height:50px" src="photos/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item ">
          <a href="index.php" class="nav-link"><span class="badge badge-primary"><i class="fas fa-home"></i></span>
            หน้าหลัก</a>
        </li>
        <li class="nav-item">
          <a href="products.php" class="nav-link "><span class="badge badge-success"><i class="fab fa-product-hunt"></span></i>สินค้า</a>
        </li>
        <li class="nav-item active">
          <a href="#" class="nav-link active"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>สั่งซื้อ</a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link "><span class="badge badge-warning"><i class="fas fa-registered"></i></span>สมัครสมาชิก</a>
        </li>
        <li class="nav-item">
          <a href="transfer.php" class="nav-link "><span class="badge badge-danger"><i class="fas fa-clipboard-check"></i></span>ยืนยันการสั่งซื้อ</a>
        </li>
        <li class="nav-item">
          <a href="login.php" class="nav-link "><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i></span>เข้าสู่ระบบ</a>
        </li>
      </ul>
    </div>
  </nav>
</div>

<div class="container-fluid">
  <div class="col-dm-6 bg-warning">
    <h1 class="text-center very-large-text"><b>สร้างรายการใหม่</b></h1>
  </div>
  <div class="col-lg-12 bg-info">
    <h4 class='text'><b>ช่องทางติดต่อ</b></h4>
    <div class="row">
      <div class="col-dm-4 col-sm-6">
        <div class="form-group">
          <p><b><i class="fas fa-address-card"></i>&nbsp;ชื่อลูกค้า</b></p>
          <input class="form-control" type="text" name="order[name]" id="order_name" placeholder="ชื่อ-นามสกุล" required>
        </div>
      </div>

      <div class="col-xs-6 col-md-4">
        <p><b><i class="fa fa-map-marker"></i>&nbsp; ที่อยู่ลูกค้า</b></p>
        <textarea rows="3" class="form-control" name="order[address]" id="order_address" placeholder="ที่อยู่" required>
     </textarea>

        <div id="address-suggestion-output"></div>

      </div>

      <div class="form-group  col-md-6">
        <div class="row">
          <div class="col-sm-6">
            <p><b><i class="fa fa-phone"></i>&nbsp;เบอร์โทรศัพท์</b></p>
            <input class="form-control" type="text" name="order[tel]" id="order_tel" placeholder="เบอร์โทรศัพท์" required />
          </div>


          <div class="col-sm-6">
            <p><b><i class="fa fa-envelope"></i>&nbsp;E-Mail</b></p>
            <input class="form-control" type="email" name="order[email]" id="order_email" placeholder="E-mail" required />
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <p><b><i class="fas fa-money-check-alt"></i>&nbsp;ชำระเงินได้ที่</b></p>
        <table width="500" border="1" cellpadding="0" cellspacing="0" class="textNormal">
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
  </div>
  <br>

  <div class="fields">
    <div class='table-responsive'>
      <table class="table mytable">
        <thead>
          <tr>
            <th class="large-text-center" style="width:450px" bgcolor="#FFE4E1">ชื่อสินค้า</th>
            <th class="large-text center " style="width:370px" bgcolor="#FFE4E1">จำนวน</th>
            <th class="large-text" align="center" bgcolor="#FFE4E1">ราคา</th>
            </th>
            <th class="large-text" bgcolor="#FFE4E1">เลือกสินค้า</th>
          <tr>
            <td class="large-text" style="width:450px" bgcolor="#FFFFFF">Mikrotik/6เดือน จำกัดUser 400 คน </TD>
            <td class="large-text" style="width:370px" align="center" bgcolor="#FFFFFF">1 </TD>
            <td class="large-text" style="width:370px" align="center" bgcolor="#FFFFFF">500</TD>
            <td class="large-text" style="width:370px" align="center" bgcolor="#FFFFFF"><input type="radio" name="product" value="500"> </input></td>
          </tr>
          <tr>
            <td class="large-text" style="width:450px" bgcolor="#FFFFFF">Mikrotik/1ปี ไม่จำกัด User</TD>
            <td class="large-text" style="width:370px" align="center" bgcolor="#FFFFFF">1 </TD>
            <td class="large-text" style="width:370px" align="center" bgcolor="#FFFFFF">1000</TD>
            <td class="large-text" style="width:370px" align="center" bgcolor="#FFFFFF"> <input type="radio" name="product" value="1000"> </input></td>
          </tr>
          </tr>
        </thead>
        <tbody id="order-purchases">
        </tbody>
      </table>
    </div>




    <div class="row">

      <div class="form-group col-md-12 ">
        <p align="right"><label for="order_ยอดรวม">ยอดรวม</label>
          <input class="finalprice form-control." readonly="readonly" step="any" type="number" value="0.0" name="order[price]" id="order_price" />
      </div>
    </div>

    <div class="row">
      <div class='col-md-12'>
        <div class="actions">
          <div class='form-group'>
            <div class='text-right'>

              <a href="invoices.php" class="btn btn-primary">ยืนยันการสั่งซื้อ</button></a>

              <a class="btn btn-danger pull-right" style="margin-right:7px;" href="/">ยกเลิก</a>
              <br><br>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

<script language="javascript">
  function CheckNum() {
    if (event.keyCode < 48 || event.keyCode > 57) {
      event.returnValue = false;
    }
  }
</script>

<input type="text" name="s_money" size="10" onKeyPress="CheckNum()" style="text-align:right">
<style>
  .modal-dialog {
    overflow-y: initial !important
  }

  .modal-body {
    max-height: 550px;
    overflow-y: auto;
  }

  th {
    text-align: center;
  }
</style>

</div>



<br>
</div>
</div>





</div>
</div>
</body>

</html>