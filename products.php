<?php
session_start();
require('template/template_products.html');
$_SESSION['order'] = "order";
?>
<title>Products</title>
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
            <li class="nav-item active">
                <a href="#" class="nav-link active"><span class="badge badge-success"><i class="fab fa-product-hunt"></i></span>
                    สินค้า</a>
            </li>
            <li class="nav-item ">
                <a href="payment.php" class="nav-link"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>
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
<div class="container">
    <div id="gridContainer">
        <div class="row grid-row d-flex justify-content-center">
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="img/a.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">ระบบจัดการ Router MikroTik แบบ6เดือน</h5>
                        <p style="font-weight:bold">ฟังก์ชัน</p>
                        <p class="card-text">- ใช้งานง่าย<br>
                            - รองรับการจัดการเจ้าของไซต์<br>
                            - รองรับการจัดการพนักงาน<br>
                            ราคา 500 บาท ต่อ 6 เดือน<br>
                            รองรับ User 400 คน<br>
                            - สามารถจัดการเราเตอร์/เปลี่ยนรหัสผ่าน</p>
                        <?php echo "<a href=\"payment.php?id=1\" onclick=\"return confirm('คุณต้องการสั่งซื้อ');\" 
                        class=\"btn btn-outline-dark btn-sm\">สั่งซื้อ</a>" ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="img/b.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">ระบบจัดการ Router MikroTik แบบ 1 ปี</h5>
                        <p style="font-weight:bold">ฟังก์ชัน</p>
                        <p class="card-text">- ใช้งานง่าย<br>
                            - รองรับการจัดการเจ้าของไซต์<br>
                            - รองรับการจัดการพนักงาน<br>
                            ราคา 1000 บาท ต่อ 1 เดือน<br>
                            - รองรับ Userไม่จำกัด<br>
                            - สามารถจัดการเราเตอร์/เปลี่ยนรหัสผ่าน</p>
                        <?php echo '<a href="payment.php?id=2" onclick="return confirm(\'คุณต้องการสั่งซื้อ\');" 
                        class="btn btn-outline-dark btn-sm">สั่งซื้อ</a>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>