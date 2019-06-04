<title>Invoice</title>
<style type="text/css">
    @media print {
        #hid {
            display: none;
        }
</style>
<?php
require('template/template_customer.html');
?>
<h1>&nbsp; ใบสรุปรายการสินค้า </h1>
<div class="container">
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
                    <div class="pull-left semi-bold"> Invoice to : คุณ ABCD </div>
                    <div class="pull-right "></div>
                    <div class="clearfix"></div>
                </div>
                <div class='col-md-offset-5'>
                    <div class="pull-left semi-bold"> ที่อยู่ : 457/1 ม.7  ต.ควนปริง อ.เมือง จ.ตรัง </div>
                    <div class="pull-right"> </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-offset-5">
                    <div class="pull-left semi-bold"> เบอรโทรศัพท์ : 087-369798 </div>
                    <div class="pull-right">  </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-offset-5">
                    <div class="pull-left semi-bold"> E-mail : - </div>
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
                        
                        <th class="text-right">จำนวนเงิน(฿)</th>
                        <th class="text-right">รวม(฿)</th </tr> </thead> <tbody>
                    <tr>
                        <td class="unseen text-center">

                        </td>
                        <td class="text-left"> Mikrotik</td>
                        <td class="text-left ">1000</td>
                      
                        <td class="text-right">1000 </td>
                        <td class="text-right">1000 </td>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <!-- <td></td> -->

                        <td class="text-right"><strong>ยอดรวม</strong></td>
                        <td class="text-right"> 1000</td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>
    <br>
    <div class='text-right'>
        <a onclick="window.print();return false;" class="btn btn-success" href="#">พิมพ์ใบเสร็จ</a>
        <a class="btn btn-danger" href="payment.php">เเก้ไข</a>
    </div>
