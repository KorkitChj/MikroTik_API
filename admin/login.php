<?php
session_start();
include("../includes/template_frontend/page_link_config.php");
define("SITE_KEY","6Ldi6scUAAAAAAfzp3mmle6dSPn1lW3yOJGZ2Ac9");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/template_frontend/head_tag_contents.php"); ?>
    <link rel="stylesheet" href="css/styles_login.css">
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-9 col-lg-4 mx-auto">
                <p><img src="img/api-logo1.png" width="150px" alt="logo"></p>
                <div class="box shadow-lg">
                    <form id="login" method="post">
                        <div class="form-label-group">
                            <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control username_color" id="username" name="username" placeholder="E-mail" required autofocus>
                            <label for="username">E-mail</label>
                        </div>
                        <div align="right"><a href="password_reset?u=admin_resetpw">ลืมรหัสผ่าน?</a></div>
                        <div class="form-label-group">
                            <input type="password" class="form-control password_color" placeholder="Password" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <input type="hidden" id="hlogin" name="hlogin" value="admin_login">
                        <button type="submit" class="btn btn-lg btn-dark-cus btn-block btn-login text-uppercase font-weight-bold mb-2" autofocus><i class="fas fa-sign-in-alt text-danger"></i>&nbsp;Login</button>
                        <input type="hidden" id="token" name="token">
                        <center><a href="home">กลับหน้าหลัก</a></center>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("../includes/template_frontend/bottom_tag_contents.php"); ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY ?>"></script>
<script src="js/main_site/login.js"></script>
<script>
  grecaptcha.ready(function() {
      grecaptcha.execute('<?php echo SITE_KEY ?>', {action: 'login'}).then(function(token) {
         // console.log(token);
         document.getElementById("token").value = token;
      });
  });
  </script>
</html>