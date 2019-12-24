<nav class="container-fluid navbar navbar-expand-sm by-0 navbar-expand-lg  py-md-0 navbar-light bg-light">
    <a class="navbar-brand" href="home"><img src="img/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <!--navbar-->
        <ul id="myDIV" class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($CURRENT_PAGE == "Index") { ?>shadow active_cus<?php } ?>">
                <a href="home" class="nav-link "><i class="fas fa-home"></i>
                    หน้าหลัก</a>
            </li>
            <li class="nav-item <?php if ($CURRENT_PAGE == "Products") { ?>shadow active_cus<?php } ?>">
                <a href="item" class="nav-link"><i class="fas fa-arrow-down"></i>
                    สินค้า</a>
            </li>
            <li class="nav-item <?php if ($CURRENT_PAGE == "Cart") { ?>shadow active_cus<?php } ?>">
                <a href="cart" class="nav-link"><i class="fas fa-shopping-cart"></i>
                    ตระกร้าสินค้า</a>
            </li>
            <li class="nav-item <?php if ($CURRENT_PAGE == "Transfer") { ?>shadow active_cus<?php } ?>">
                <a href="transfer" class="nav-link"><i class="fas fa-clipboard-check"></i>
                    แจ้งโอนเงิน</a>
            </li>
            <li class="nav-item <?php if ($CURRENT_PAGE == "Register") { ?>shadow active_cus<?php } ?>">
                <a href="register" class="nav-link"><i class="fas fa-laugh-wink"></i>
                    สมัครสมาชิก</a>
            </li>
        </ul>
        <ul class="navbar-nav topnav ml-auto">
            <?php if ($CURRENT_PAGE == "Products") { ?>
                <li class="nav-item">
                    <div class="search-container">
                        <form id="form_search" action="" method="post">
                            <input type="text" placeholder="ค้นหารายการสินค้า..." name="search" id="search" pattern="[^'\x22]+" title="Invalid input">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a href="login" class="nav-link"><i class="fas fa-sign-in-alt"></i>
                    เข้าสู่ระบบ</a>
            </li>
        </ul>
    </div>
</nav>
