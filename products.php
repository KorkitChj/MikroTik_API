<?php
session_start();
require('template/template_customer.html');
$_SESSION['order'] = "order";
?>
<title>Products</title>
<link rel="stylesheet" href="css/style.css">
<style>
    .color-custom {
        padding: 2em;
        background-image: url('img/marble-1.jpg');
        background-size:cover;
        background-repeat: no-repeat;
    }

    .ax {
        /* margin-bottom:1em; */
        border-bottom: red 0.5em solid;
    }

    .a {

        border-bottom: red 0.5em solid;
    }
    .ho:hover{
        box-shadow: 0px 0px 12px 6px rgb(0, 0, 0);
    }
</style>
<nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php"><img style="width:50px;height:50px" src="img/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item ">
                <a href="index.php" class="nav-link z"><span class="badge badge-primary"><i class="fas fa-home"></i></span>
                    หน้าหลัก</a>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link active z"><span class="badge badge-success"><i class="fab fa-product-hunt"></i></span>
                    สินค้า</a>
            </li>
            <li class="nav-item ">
                <a href="payment.php" class="nav-link z"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>
                    สั่งซื้อ</a>
            </li>
            <!-- <li class="nav-item">
                <a href="register.php" class="nav-link z"><span class="badge badge-warning"><i class="fas fa-registered"></i></span>
                    สมัครสมาชิก</a>
            </li> -->
            <li class="nav-item">
                <a href="transfer.php" class="nav-link z"><span class="badge badge-danger"><i class="fas fa-clipboard-check"></i></span>
                    แจ้งโอนเงิน</a>
            </li>
            <li class="nav-item">
                <a href="login.php" class="nav-link z"><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i></span>
                    เข้าสู่ระบบ/สมัครสมาชิก</a>
            </li>
        </ul>
    </div>
</nav>
</div>
<div class="container-fluid a color-custom">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="col-md-4 ho">
                <div class="card mb-4">
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
                        class=\"btn btn-outline-dark btn-sm\">สั่งซื้อ</a>"?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ho">
                <div class="card mb-4">
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
                        class="btn btn-outline-dark btn-sm">สั่งซื้อ</a>'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>