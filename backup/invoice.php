<title>Invoice</title>
<style type="text/css">
  @media print {
    #hid {
      display: none;
    }
</style>

<div class="row float-right" id="hid">
  <div class="col">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a href="#" class="nav-link">หน้าหลัก</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link ">สินค้า</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link active">สมัครสมาชิก</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link ">เข้าสู่ระบบ</a>
      </li>
    </ul>
  </div>
</div>
<?php
require('template_customer.html');
?>
<h1> ใบสรุปรายการสินค้า </h1>
<div class="invoice-border">
  <div class="row">
    <div class="col-md-8 col-xs-8">
      <div class="semi-bold">หมายเลขใบสั่งซื้อ : 12323058694 </div>
      <div class="pull-left"> </div>
      <div class="clearfix"></div>
      <div class="pull-left semi-bold"> วันที่ : 02/04/62 </div>
      <div class="pull-right"> </div>
      <div class="clearfix"></div>
      <div class="pull-left semi-bold"> ชำระภายใน : 10/04/62 </div>
      <div class="pull-right"> </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-4 col-xs-4"> <br>
      <div class='col-md-offset-5'>
        <div class="pull-left semi-bold"> Invoice to : </div>
        <div class="pull-right"> คุณ ABCD </div>
        <div class="clearfix"></div>
      </div>
      <div class='col-md-offset-5'>
        <div class="pull-left semi-bold"> ที่อยู่ : </div>
        <div class="pull-right">457 /tg m.5 </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-offset-5">
        <div class="pull-left semi-bold"> Phone : </div>
        <div class="pull-right"> 087-369798 </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-offset-5">
        <div class="pull-left semi-bold"> E-mail : </div>
        <div class="pull-right"> </div>
        <div class="clearfix"></div>
      </div>
      <br />
    </div>
  </div>
  <div>
    <table class="table table-condensed">
      <thead>
        <tr style="background-color: light-grey;">
          <th class="unseen text-center"></th>
          <th class="text-left">รายการสินค้า</th>
          <th class="text-left">ราคา</th>
          <th class="text-right">โปรโมชั่น</th>
          <th class="text-right">จำนวนเงิน(฿)</th>
          <th class="text-right">รวม(฿)</th>


        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="unseen text-center">

          </td>
          <td class="text-left"> Microtik</td>
          <td class="text-left ">500</td>
          <td class="text-right">- </td>
          <td class="text-right">1000 </td>
          <td class="text-right">1000 </td>

          </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td class='text-right bold text-success large-text'></td>
          <!-- <td></td> -->

          <td class="text-right"><strong>ยอดรวม</strong></td>
          <td class="text-right"> 1000</td>
        </tr>



      </tbody>
    </table>
  </div>
</div>
<br>
<div class='text-right'>
  <a onclick="window.print();return false;" class="btn btn-success" href="#">print</a>
  <a class="btn btn-default" href="payment.php">Edit</a>
</div>
</div>
</div>
</div>
</div>
</div>
