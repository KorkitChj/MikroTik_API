<?php
session_start();
include("includes/template_frontend/page_link_config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
    <link rel="stylesheet" href="css/styles_login.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-6 mx-auto">
                                <p><img src="img/api-logo1.png" width="150px" alt="logo"></p>
                                <!-- <h3 class="login-heading mb-4">Welcome User!</h3> -->
                                <div class="box shadow-lg">
                                    <form id="login" method="post">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control username_color" id="username" name="username" placeholder="Username" required autofocus>
                                            <label for="username">Username</label>
                                        </div>
                                        <div align="right"><a href="password_reset">ลืมรหัสผ่าน?</a></div>
                                        <div class="form-label-group">
                                            <input type="password" class="form-control password_color" placeholder="Password" id="password" name="password" required>
                                            <label for="password">Password</label>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-dark-cus btn-block btn-login text-uppercase font-weight-bold mb-2" autofocus><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
                                        <?php
                                        if (isset($_SESSION['register']) != '') { ?>
                                            <button type="button" class="btn btn-lg btn-secondary-cus btn-block btn-login text-uppercase font-weight-bold mb-2" disabled><i class="fas fa fa-registered"></i>&nbsp;Register</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-lg btn-secondary-cus btn-block btn-login text-uppercase font-weight-bold mb-2" onclick='window.location.href="register.php"'><i class="fas fa fa-registered"></i>&nbsp;Register</button>
                                        <?php } ?>
                                        <center><a href="home">กลับหน้าหลัก</a></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/main_site/login.js"></script>

</html>