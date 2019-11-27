<?php
session_start();
include("../../includes/template_frontend/page_link_config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../../includes/template_frontend/head_tag_contents.php"); ?>
    <link rel="stylesheet" href="css/styles_login.css">
    <style>
        .col-md-9,
        .col-lg-5 {
            padding: 0px 30px;
        }

        .aa {
            padding: 20px 0px;
        }
    </style>
</head>

<body>
<div class="modalx" style="display: none;"></div>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-9 col-lg-4 mx-auto">
                <p><img src="img/api-logo1.png" width="150px" alt="logo"></p>
                <div class="box shadow-lg">
                    <div class="aa"><b>ใส่ Email Address ของท่านเราจะส่งลิงก์สำหรับรีเซ็ตรหัสผ่าน</b></div>
                    <form id="password_reset" method="post">
                        <div class="form-label-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ใช้ตัวพิมพ์เล็กและรูปแบบที่ถูกต้อง" required autofocus>
                            <label for="username">Email</label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success-cus btn-block btn-login text-uppercase font-weight-bold mb-2"><i class="fas fa-paper-plane"></i>&nbsp;Send</button>
                        <center><a href="login">Login</a></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/main_site/password_reset.js"></script>
</html>