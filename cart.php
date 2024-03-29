<?php
session_start();
include("includes/template_frontend/page_link_config.php");
include("includes/datethai_function.php");
include("includes/db_connect.php");
//error_reporting(0);
if (isset($_GET['id']) != '') {
    $_SESSION['id'] = (int)$_GET['id'];
    $id = (int)$_GET['id'];
    $query = $conn->prepare("SELECT title,price,image FROM product WHERE product_id = :id");
    $query->bindParam(":id",$id);
    $query->execute();
    $value = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['title'] = $value['title'];
    $_SESSION['price'] = $value['price'];
    $_SESSION['img'] = $value['image'];
}
if (isset($_GET['sts']) == "dest") {
    unset($_SESSION['id']);
    unset($_SESSION['title']);
    unset($_SESSION['price']);
    unset($_SESSION['img']);
    //unset($_SESSION['register']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
    <link rel="stylesheet" href="css/shopping-cart.css">
</head>

<body>
    <?php include("includes/template_frontend/navigation.php"); ?>
    <div class="margin-top">
        <main class="page">
            <section class="shopping-cart dark">
                <div class="container">
                    <div class="block-heading">
                        <h2>รายการสินค้าของคุณ</h2>
                    </div>
                    <div class="content">
                        <div class="row">
                            <?php
                            if (isset($_SESSION['register']) == '' && isset($_SESSION['id']) == '') { ?>
                                <div class="col-md-12 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">คุณไม่มีรายการสินค้า</div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="summary">
                                        <h4><b>สรุปการสั่งซื้อ</b></h4>
                                        <div class="summary-item"><span class="text">ราคา</span><span class="price">0 บาท</span></div>
                                        <div class="summary-item"><span class="text">ส่วนลด</span><span class="price">0 บาท</span></div>
                                        <div class="summary-item"><span class="text">ยอดสุทธิ</span><span class="price">0 บาท</span></div>
                                        <button type="button" class="btn btn-dark-cus btn-lg btn-block" onclick='window.location.href="login"'>เข้าสู่ระบบ</button>
                                        <button type="button" class="btn btn-secondary-cus btn-lg btn-block" onclick='window.location.href="register/false"'>สมัครสมาชิก</button>
                                        <button type="button" class="btn btn-success-cus btn-lg btn-block" onclick='window.location.href="item"'>สั่งซื้อทันที</button>
                                    </div>
                                </div>
                            <?php } elseif (isset($_SESSION['register']) != '' && isset($_SESSION['id']) == '') { ?>
                                <div class="col-md-12 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">คุณไม่มีรายการสินค้า</div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="summary">
                                        <h4><b>สรุปการสั่งซื้อ</b></h4>
                                        <div class="summary-item"><span class="text">ราคา</span><span class="price">0 บาท</span></div>
                                        <div class="summary-item"><span class="text">ส่วนลด</span><span class="price">0 บาท</span></div>
                                        <div class="summary-item"><span class="text">ยอดสุทธิ</span><span class="price">0 บาท</span></div>
                                        <button type="button" class="btn btn-dark-cus btn-lg btn-block" onclick='window.location.href="login"'>เข้าสู่ระบบ</button>
                                        <button type="button" class="btn btn-secondary-cus btn-lg btn-block" onclick='window.location.href="#"' disabled>สมัครสมาชิก</button>
                                        <button type="button" class="btn btn-success-cus btn-lg btn-block" onclick='window.location.href="item"'>สั่งซื้อทันที</button>
                                    </div>
                                </div>
                            <?php } elseif (isset($_SESSION['register']) != '' && isset($_SESSION['id']) != '') { ?>
                                <div class="col-md-12 col-lg-8">
                                    <div class="items">
                                        <div class="product">
                                            <div class="row">
                                                <div class="col-md-3" style="margin-top:30px;margin-left:30px;margin-right:30px;">
                                                    <img class="img-fluid mx-auto d-block image" src="img/products/<?php echo $_SESSION['img']  ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="col-md-6 product-name">
                                                                <div class="product-name">
                                                                    <?php echo $_SESSION['title'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 price">
                                                                <span><?php echo $_SESSION['price'] ?></span>
                                                            </div>
                                                            <div class="col-md-2 price">
                                                                <button type="button" class="btn btn-danger" onclick='window.location.href="cart/product/remove"'>ลบ</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="summary">
                                        <h4><b>สรุปการสั่งซื้อ</b></h4>
                                        <div class="summary-item"><span class="text">ราคา</span><span class="price"><?php echo $_SESSION['price'] ?>&nbsp;บาท</span></div>
                                        <div class="summary-item"><span class="text">ส่วนลด</span><span class="price">0 บาท</span></div>
                                        <div class="summary-item"><span class="text">ยอดสุทธิ</span><span class="price"><?php echo $_SESSION['price'] ?>&nbsp;บาท</span></div>
                                        <button type="button" class="btn btn-dark-cus btn-lg btn-block" onclick='window.location.href="login"'>เข้าสู่ระบบ</button>
                                        <button type="button" class="btn btn-secondary-cus btn-lg btn-block" onclick='window.location.href="#"' disabled>สมัครสมาชิก</button>
                                        <button type="button" class="btn btn-success-cus btn-lg btn-block" onclick='window.location.href="checkout"'>ดำเนินการต่อ</button>
                                    </div>
                                </div>
                            <?php } elseif (isset($_SESSION['register']) == '' && isset($_SESSION['id']) != '') { ?>
                                <div class="col-md-12 col-lg-8">
                                    <div class="items">
                                        <div class="product">
                                            <div class="row">
                                                <div class="col-md-3" style="margin-top:30px;margin-left:30px;margin-right:30px;">
                                                    <img class="img-fluid mx-auto d-block image" src="img/products/<?php echo $_SESSION['img']  ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="col-md-6 product-name">
                                                                <div class="product-name">
                                                                    <?php echo $_SESSION['title'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 price">
                                                                <span><?php echo $_SESSION['price'] ?></span>
                                                            </div>
                                                            <div class="col-md-2 price">
                                                                <button type="button" class="btn btn-danger" onclick='window.location.href="cart/product/remove"'>ลบ</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="summary">
                                        <h4><b>สรุปการสั่งซื้อ</b></h4>
                                        <div class="summary-item"><span class="text">ราคา</span><span class="price"><?php echo $_SESSION['price'] ?>&nbsp;บาท</span></div>
                                        <div class="summary-item"><span class="text">ส่วนลด</span><span class="price">0 บาท</span></div>
                                        <div class="summary-item"><span class="text">ยอดสุทธิ</span><span class="price"><?php echo $_SESSION['price'] ?>&nbsp;บาท</span></div>
                                        <button type="button" class="btn btn-dark-cus btn-lg btn-block" onclick='window.location.href="login"'>เข้าสู่ระบบ</button>
                                        <button type="button" class="btn btn-secondary-cus btn-lg btn-block" onclick='window.location.href="register/true"'>สมัครสมาชิก</button>
                                        <button type="button" class="btn btn-success-cus btn-lg btn-block" onclick='window.location.href="#"' disabled>สั่งซื้อทันที</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php include("includes/template_frontend/footer.php"); ?>
    <?php include("includes/template_frontend/bottom_tag_contents.php"); ?>
    <script src="js/main_site/backtotop.js"></script>
</body>

</html>