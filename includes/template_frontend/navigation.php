<div class="container-fluid">
    <nav class="navbar navbar-expand-sm by-0 navbar-expand-lg py-md-0 fixed-top navbar-dark bg-light">
        <a class="navbar-brand" href="index.php"><img style="width:90px;height:67px" src="img/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <!--navbar-->
            <ul id="myDIV" class="navbar-nav mr-auto">
                <li class="nav-item <?php if ($CURRENT_PAGE == "Index") { ?>active_cus<?php } ?>">
                    <a href="index.php" class="nav-link"><span class="badge badge-primary"><i class="fas fa-home"></i>
                            หน้าหลัก</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Products") { ?>active_cus<?php } ?>">
                    <a href="products.php" class="nav-link"><span class="badge badge-success"><i class="fab fa-product-hunt"></i>
                            สินค้า</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Cart") { ?>active_cus<?php } ?>">
                    <a href="cart.php" class="nav-link"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i>
                            ตระกร้าสินค้า</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Transfer") { ?>active_cus<?php } ?>">
                    <a href="transfer.php" class="nav-link"><span class="badge badge-light"><i class="fas fa-clipboard-check"></i>
                            แจ้งโอนเงิน</a>
                </li>
                <li class="nav-item <?php if ($CURRENT_PAGE == "Register") { ?>active_cus<?php } ?>">
                    <a href="register.php" class="nav-link"><span class="badge badge-info"><i class="fas fa-laugh-wink"></i>
                            สมัครสมาชิก</a>
                </li>
            </ul>
            <ul class="navbar-nav topnav ml-auto">
                <?php if ($CURRENT_PAGE == "Products") { ?>
                    <li class="nav-item">
                        <div class="search-container">
                            <form id="form_search" action="" method="post">
                                <input type="text" placeholder="ค้นหารายการสินค้า..." name="search" id="search" 
                                pattern="[^'\x22]+" title="Invalid input">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link"><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i>
                            เข้าสู่ระบบ</a>
                </li>
            </ul>
            <!-- <ul class="navbar-nav ml-auto">
                <form id="login" method="post" class="form-inline">
                    <div class="form-group row">
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-light">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control username_color" id="username" name="username" placeholder="Username" required>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-light">
                                    <i class="fas fa-key"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control password_color" placeholder="Password" id="password" name="password" required>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn  btn-outline-dark my-2 my-sm-0"><i class="fas fa-sign-in-alt"></i>&nbsp;SignIn</button>
                    </div>
                </form>
            </ul> -->
        </div>
    </nav>
</div>
<script src="js/main_site/products_search.js"></script>
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