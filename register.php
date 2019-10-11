<?php
session_start();
if (isset($_GET['user']) == 'user_register')
    $user_register = 'user_register';
include("includes/template_frontend/page_link_config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("includes/template_frontend/navigation.php"); ?>
    <div class="container margin-top">
        <div class="container" style="width:100%; max-width:800px">
            <div class="row ">
                <div class="col">
                    <div class="card text-white bg-light border-danger shadow-lg p-3 mb-5">
                        <div class="card-header">
                            <h1 align="center">Register</h1>
                        </div>
                        <div class="card-body">
                            <form id="register" action="" method="">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="username" class="control-label col-sm">Username:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="username_register" name="username_register" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="password" class="control-label col-sm">Password:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Password" id="password_register" name="password_register" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="fullname" class="control-label col-sm">ชื่อ-สกุล:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-id-badge"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="ชื่อ-สกุล" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="email" class="control-label col-sm">E-mail Address:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope-square"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="number" class="control-label col-sm">หมายเลขโทรศัพท์:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone-square"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="number" name="number" placeholder="หมายเลขโทรศัพท์" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="site" class="control-label col-sm">ชื่อสถานที่ตั้ง:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-arrow"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="site" name="site" placeholder="ชื่อสถานที่ตั้ง" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="address" class="control-label col-sm">ที่อยู่:&nbsp;</label>
                                        <div class="col-sm-12 input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-at"></i>
                                                </div>
                                            </div>
                                            <textarea id="address" name="address" class="form-control" placeholder="ที่อยู่" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="col-sm-12">
                                            <hr />
                                            <button type="submit" id="registerBtn" name="registerBtn" class="btn btn-primary">สมัครสมาชิก</button>
                                            <button type="reset" name="reset" class="btn btn-warning">รีเซ็ต</button>
                                            <button type="bottom" class="btn btn-danger" onclick="window.history.back()">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/main_site/register.js"></script>

    </div>
    <?php include("includes/template_frontend/footer.php"); ?>

</body>

</html>