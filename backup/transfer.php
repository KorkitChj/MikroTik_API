<?php
require('template/template_customer.html');
?>
<style>
    .container {
        background-color: white;
        padding: 20px;
    }
</style>
<title>Products</title>
<nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php"><img style="width:50px;height:50px" src="photos/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item ">
                <a href="index.php" class="nav-link "><span class="badge badge-primary"><i class="fas fa-home"></i></span>
                    หน้าหลัก</a>
            </li>
            <li class="nav-item ">
                <a href="products.php" class="nav-link "><span class="badge badge-success  "><i class="fab fa-product-hunt"></span></i>สินค้า</a>
            </li>
            <li class="nav-item ">
                <a href="payment.php" class="nav-link "><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>สั่งซื้อ</a>
            </li>
            <li class="nav-item">
                <a href="register.php" class="nav-link "><span class="badge badge-warning"><i class="fas fa-registered"></i></span>สมัครสมาชิก</a>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link active"><span class="badge badge-danger"><i class="fas fa-registered"></i></span>ยืนยันการสั่งซื้อ</a>
            </li>
            <li class="nav-item">
                <a href="login.php" class="nav-link "><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i></span>เข้าสู่ระบบ</a>
            </li>
        </ul>
    </div>
</nav>
</div>

<div class="container border-color">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <p>
                <h3 style="font-weight:bold">เเจ้งการโอนเงิน</h3>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <form action="s_transfer.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <div class="form-group row">
                    <label for="bank_info" class="col-sm-4 col-form-label">ชำระผ่าน: </label>
                    <div class="col-sm-8">
                        <select name="bank_info" id="bank_info" class="form-control bank_info" required>
                            <option value="">----- เลือกวิธีการชำระเงิน -----</option>
                            <option value="">ธนาคารไทยพาญิชย์</option>
                            <option value="">ธนาคารกรุงไทย</option>
                            <option value="">ธนาคารกสิกรไทย</option>
                            <option value="">ธนาคารกรุงเทพ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="time" class="col-sm-4 col-form-label">เวลาโอน:</label>
                    <div class="col-sm-8">
                        <input type="datetime-local" name="time" class="form-control" id="note" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="money" class="col-sm-4 col-form-label">จำนวนเงินที่โอน:</label>
                    <div class="col-sm-8">
                        <input type="number" name="money" class="form-control" id="money" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slips" class="col-sm-4 col-form-label">อัพโหลดไฟล์:</label>
                    <div class="col-sm-8">
                        <p>Image_name
                            <input class="btn btn-primary" name="image_name" type="file" id="image_name" size="40" />
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="b" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-8">
                        <button type="submit" name="MM_insert" value="form1" class="btn btn-primary">สมัครสมาชิก</button>
                        <button type="bottom" class="btn btn-danger">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>