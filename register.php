<?php
session_start();
?>
<?php
require('template/template_customer.html');
if (!$_SESSION["order"]) {
    Header("Location:products.php");
} else { ?>
<title>Register</title>
<link rel="stylesheet" href="css/style.css">
<style>
    html {
        height: 100%;
        border-top: red 0.25em solid;
    }

    body {
        /* background-image: linear-gradient(to top, #99CC66 0%, #FFFFCC 100%); */
        margin-top: 1em;
        margin-bottom: 4em;
        background-image: url('img/16948.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        /* background: rgb(255,255,255);
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(227,227,227,1) 100%, rgba(186,186,186,1) 100%, rgba(181,181,181,1) 100%, rgba(175,238,255,1) 100%); */
    }

    .container-fluid {
        /* background-color: white; */
        /* padding: 2px; */
    }

    #border-login {
        /* background: #e3e3e3; */
        /* background: url('img/3.jpg');
        background-color: rgba(255, 0, 0, 0.4); */
        background:#ccffff;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 1.5em;
        border-radius: 5px;
        border-left:#0099ff 5px solid;
        /* box-shadow: 0px 0px 8px 4px rgb(0, 0, 0); */
    }
    p {
        color:red;
        font-weight: bold;
        font-size:2em;
    }

    p:hover {
        color:black;
    }
    .btn-danger,.btn-primary,.btn-warning{
        background-color:white;
        color:black;
    }
    input[type="text"],
    [type="password"] {
        border: 0;
        border-bottom: 1px solid red;
        outline: 0;
    }
</style>
<!-- <div class="container-fluid">
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
                <li class="nav-item ">
                    <a href="products.php" class="nav-link z"><span class="badge badge-success "><i class="fab fa-product-hunt"></i></span>
                        สินค้า</a>
                </li>
                <li class="nav-item ">
                    <a href="payment.php" class="nav-link z"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>
                        สั่งซื้อ</a>
                </li>
                <li class="nav-item active">
                    <a href="#" class="nav-link active z"><span class="badge badge-warning"><i class="fas fa-registered"></i></span>
                        สมัครสมาชิก</a>
                </li>
                <li class="nav-item">
                    <a href="transfer.php" class="nav-link z"><span class="badge badge-danger"><i class="fas fa-registered"></i></span>
                        ยืนยันการสั่งซื้อ</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link z"><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i></span>
                        เข้าสู่ระบบ</a>
                </li>
            </ul>
        </div>
    </nav>
</div> -->

<body>
    <div class="container-fluid">
        <!-- <div class="row">
        <div class="col d-flex justify-content-center">
            <p>
                <h3 style="font-weight:bold">สมัครสมาชิก</h3>
            </p>
        </div>
    </div> -->
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <div id="border-login">
                    <form action="s_register.php" method="post">
                        <div class="col d-flex justify-content-center">
                            <p>
                                สมัครสมาชิก
                            </p>
                        </div>
                        <div class="form-group row">
                            <label for="inputusername" class="col-sm-1 col-form-label"><i class="far fa-user"></i></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control " name="inputusername" placeholder="ชื่อผู้ใช้งาน" required>
                            </div>
                            <label for="inputpassword" class="col-sm-1 col-form-label"><i class="fas fa-key"></i></label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="inputpassword" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                        <label for="inputpassword" class="col-sm-2 col-form-label"><i class="fas fa-key"></i></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="inputpassword" placeholder="รหัสผ่าน" required>
                        </div>
                    </div> -->
                        <div class="form-group row">
                            <label for="inputfullname" class="col-sm-1 col-form-label"><i class="fas fa-id-badge"></i></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="inputfullname" placeholder="ชื่อ-สกุล" required>
                            </div>
                            <label for="inputemail" class="col-sm-1 col-form-label"><i class="fas fa-envelope-square"></i></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="inputemail" placeholder="อีเมล" required>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                        <label for="inputemail" class="col-sm-2 col-form-label"><i class="fas fa-envelope-square"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputemail" placeholder="อีเมล" required>
                        </div>
                    </div> -->
                        <div class="form-group row">
                            <label for="inputphonenumber" class="col-sm-1 col-form-label"><i class="fas fa-phone-square"></i></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="inputphonenumber" placeholder="หมายเลขโทรศัพท์" required>
                            </div>
                            <label for="inputworkingsite" class="col-sm-1 col-form-label"><i class="fas fa-location-arrow"></i></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="inputworkingsite" placeholder="ชื่อสถานที่ตั้ง" required>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                        <label for="inputworkingsite" class="col-sm-2 col-form-label"><i class="fas fa-location-arrow"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputworkingsite" placeholder="ชื่อสถานที่ตั้ง" required>
                        </div>
                    </div> -->
                        <div class="form-group row">
                            <label for="inputemail" class="col-sm-1 col-form-label"><i class="fas fa-address-card"></i></label>
                            <div class="col-sm-11">
                                <textarea name="address" class="form-control" placeholder="ที่อยู่"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b" class="col-sm-1 col-form-label"></label>
                            <div class="col-sm-11">
                                <button type="submit" name="MM_insert" class="btn btn-primary">สมัครสมาชิก</button>
                                <button type="reset" name="reset" class="btn btn-warning">รีเซ็ต</button>
                                <button type="bottom" class="btn btn-danger" onclick="window.history.back()">ยกเลิก</button>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <b>***คุณจะต้องลงทะเบียนก่อนทำการสั่งซื้อสินค้า***</b>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php } ?>