<div class="container-fluid">
    <nav class="navbar navbar-expand-sm by-0 navbar-expand-lg py-md-0 fixed-top navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img style="width:50px;height:50px" src="img/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <!--navbar-->
            <ul id="myDIV" class="navbar-nav">
                <li class="nav-item <?php if ($CURRENT_PAGE == "Index") {?>active_cus<?php }?>">
                    <a href="index.php" class="nav-link"><span class="badge badge-primary"><i class="fas fa-home"></i></span>
                        หน้าหลัก</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Products") {?>active_cus<?php }?>">
                    <a href="products.php" class="nav-link"><span class="badge badge-success"><i class="fab fa-product-hunt"></i></span>
                        สินค้า</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Payment") {?>active_cus<?php }?>">
                    <a href="payment.php" class="nav-link"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>
                        สั่งซื้อ</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Transfer") {?>active_cus<?php }?>">
                    <a href="transfer.php" class="nav-link"><span class="badge badge-danger"><i class="fas fa-clipboard-check"></i></span>
                        แจ้งโอนเงิน</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Register") {?>active_cus<?php }?>">
                    <a href="register.php" class="nav-link"><span class="badge badge-info"><i class="fas fa-laugh-wink"></i></span>
                        สมัครสมาชิก</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <form id="login" method="post" class="form-inline">
                    <div class="form-group row">
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-info">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control username_color" id="username" name="username" placeholder="Username" required>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-info">
                                    <i class="fas fa-key"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control password_color" placeholder="Password" id="password" name="password" required>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn  btn-outline-success my-2 my-sm-0"><i class="fas fa-sign-in-alt"></i>&nbsp;SignIn</button>
                    </div>
                </form>
            </ul>
        </div>
    </nav>
</div>
<script src="js/login.js"></script>
<script>
    $(document).ready(function() {
        $('.navbar-light .dmenu').hover(function() {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function() {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });
        // Add active class to the current button (highlight it)
        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("nav-item");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active_cus");
                current[0].className = current[0].className.replace(" active_cus", "");
                this.className += " active_Cus";
            });
        }
    });
</script>