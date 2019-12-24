<?php
session_start();
include("../../includes/template_frontend/page_link_config.php");
if ($_GET['user'] == '') {
    Header('Location:home');
}
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
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-9 col-lg-4 mx-auto">
                <p><img src="img/api-logo1.png" width="150px" alt="logo"></p>
                <div class="box shadow-lg">
                    <div class="aa"><b>ใส่ Password ให้ตรงกัน</b></div>
                    <form id="password_verified" method="post">
                        <div class="form-label-group">
                            <input type="password" class="form-control password_color" placeholder="Password" id="password1" name="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="ต้องมีตัวเลขอย่างน้อยหนึ่งตัวและตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัวอย่างน้อย 8 ตัวอักษรขึ้นไป" required autofocus>
                            <label for="password1">Password</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" class="form-control password_color" placeholder="Password" id="password2" name="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="ต้องมีตัวเลขอย่างน้อยหนึ่งตัวและตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัวอย่างน้อย 8 ตัวอักษรขึ้นไป" required>
                            <label for="password2">Password</label>
                        </div>
                        <input type="hidden" id="user" name="user[]" value="<?=$_GET['user']?>">
                        <input type="hidden" id="user2" name="user[]" value="<?=$_GET['date']?>">
                        <input type="hidden" id="user3" name="user[]" value="<?=$_GET['lv']?>">
                        <button type="submit" class="btn btn-lg btn-success-cus btn-block btn-login text-uppercase font-weight-bold mb-2"><i class="fa fa-arrow-circle-right fa-lg"></i>&nbsp;Submit</button>
                        <center><a href="home">Close</a></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("../../includes/template_frontend/bottom_tag_contents.php"); ?>
<script src="js/main_site/password_verified.js"></script>

</html>