<?php
require('template/template_customer.html');
?>
<title>index</title>
<div class="container-fluid">
    <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img style="width:50px;height:50px" src="photos/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <!--navbar-->
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a href="index.php" class="nav-link active"><span class="badge badge-primary"><i class="fas fa-home"></i></span>
                        หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a href="products.php" class="nav-link "><span class="badge badge-success"><i class="fab fa-product-hunt"></span></i>สินค้า</a>
                </li>
                <li class="nav-item">
                    <a href="payment.php" class="nav-link "><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>สั่งซื้อ</a>
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
<div class="container color-custom ">
    <div class="row ">
        <div class="col-3 ">
            <!--หน้าถัดจากBrandner-->
            <img src="photos/mikrotik router.png" alt="mikrotik router" class="mikrotik-margin-left img-fluid">
            <table class="mikrotik-margin-left table table-striped table-bordered table-info table-hover">
                <tbody>
                    <tr>
                        <td>ไม่จำกัด Mikrotik site</td>
                    </tr>
                    <tr>
                        <td>ไม่จำกัด พนักงานดูแลระบบ</td>
                    </tr>
                    <tr>
                        <td>ฟังก์ชันจัดการเราเตอร์/เปลี่ยนรหัสผ่าน</td>
                    </tr>
                    <tr>
                        <td>ยินดีให้คำปรึกษา</td>
                    </tr>
                </tbody>
            </table>
            <a href="payment.php"><img src="photos/Cart-512.png" style="margin-bottom: 2em" class="mikrotik-margin-left-cart api-logo1" alt="Cart-512"></a>
        </div>

        <div class="col ">
            <div align="right" style="margin:2em 2em;"><iframe width="560" height="315" src="https://www.youtube.com/embed/wlnJOZxW3LI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
        </div>
    </div>
</div>