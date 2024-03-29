<?php
session_start();
if (isset($_GET['order']) == 'false') {
    $_SESSION['order'] = "false";
} elseif (isset($_GET['order']) == 'true') {
    $_SESSION['order'] = "true";
}
include("includes/template_frontend/page_link_config.php");
define("SITE_KEY", "6Ld0MsgUAAAAAKLP-PtUC-vpBXz_sXkOWJRP-Kha");
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
    <style>
        label {
            margin-top: 10px;
        }

        .card-body {
            padding: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="modalx" style="display: none;"></div>
    <?php include("includes/template_frontend/navigation.php"); ?>
    <div class="container margin-top" style="width:100%; max-width:800px">
        <div class="row ">
            <div class="col">
                <div class="card  bg-light  shadow-lg p-3 mb-5 mt-5">
                    <div class="card-header">
                        <h2 align="center"><b>ลงทะเบียน</b></h2>
                    </div>
                    <div class="card-body">
                        <form id="register" action="" method="">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <!-- <label for="username" class="control-label col-sm">Username:&nbsp;</label> -->
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text ipt">
                                                <i class="far fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control ipf" id="username_register" name="username_register" placeholder="Username" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <label for="site" class="control-label col-sm">ชื่อสถานที่ตั้ง:&nbsp;</label> -->
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text ipt">
                                                <i class="fas fa-location-arrow"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control ipf" id="site" name="site" placeholder="ชื่อสถานที่ตั้ง" required>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="password" class="control-label col-sm">Password:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Password" id="password_register" name="password_register" 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="ต้องมีตัวเลขอย่างน้อยหนึ่งตัวและตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัวอย่างน้อย 8 ตัวอักษรขึ้นไป" required>
                                    </div>
                                </div> -->
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <!-- <label for="fullname" class="control-label col-sm">ชื่อ-สกุล:&nbsp;</label> -->
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text ipt">
                                                <i class="fas fa-id-badge"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control ipf" id="fullname" name="fullname" placeholder="ชื่อ-สกุล" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <label for="email" class="control-label col-sm">E-mail Address:&nbsp;</label> -->
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text ipt">
                                                <i class="fas fa-envelope-square"></i>
                                            </div>
                                        </div>
                                        <input type="email" class="form-control ipf" id="email" name="email" placeholder="อีเมล" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ใช้ตัวพิมพ์เล็กและรูปแบบที่ถูกต้อง" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <!-- <label for="number" class="control-label col-sm">หมายเลขโทรศัพท์:&nbsp;</label> -->
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text ipt">
                                                <i class="fas fa-phone-square"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control ipf" id="number" name="number" placeholder="หมายเลขโทรศัพท์" pattern=".{9,}[0-9]" title="ต้องเป็นตัวเลขเท่านั้น" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <label for="address" class="control-label col-sm">ที่อยู่:&nbsp;</label> -->
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text ipt">
                                                <i class="fas fa-at"></i>
                                            </div>
                                        </div>
                                        <textarea id="address" name="address" class="form-control ipf" placeholder="ที่อยู่" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="col-sm-12">
                                        <div class="g-recaptcha" id="g-recaptcha" data-sitekey="<?php echo SITE_KEY ?>"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="col-sm-12">
                                        <hr />
                                        <?php
                                                                                if (isset($_SESSION['register']) != '') { ?>
                                            <button type="submit" id="registerBtn" name="registerBtn" class="btn btn-dark-cus" disabled>สมัครสมาชิก</button>
                                        <?php } else { ?>
                                            <button type="submit" id="registerBtn" name="registerBtn" class="btn btn-dark-cus">สมัครสมาชิก</button>
                                        <?php } ?>
                                        <button type="reset" name="reset" class="btn btn-success-cus">รีเซ็ต</button>
                                        <button type="bottom" class="btn btn-danger-cus" onclick="window.history.back()">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/template_frontend/footer.php"); ?>
    <?php include("includes/template_frontend/bottom_tag_contents.php"); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/main_site/register.js"></script>
    <script src="js/main_site/backtotop.js"></script>
</body>

</html>