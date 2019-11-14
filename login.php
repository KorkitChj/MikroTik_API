<?php
session_start();
include("includes/template_frontend/page_link_config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: 0.75rem;
        }

        .login,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('img/login_image.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            border-radius: 2rem;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            cursor: text;
            /* Match the input under the label */
            border: 1px solid transparent;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
        }

        /* Fallback for Edge
-------------------------------------------------- */

        @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }

            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

        /* Fallback for IE
-------------------------------------------------- */

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }

            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="login-heading mb-4">Welcome User!</h3>
                                <form id="login" method="post">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control username_color" id="username" name="username" placeholder="Username" required autofocus>
                                        <label for="username">Username</label>
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" class="form-control password_color" placeholder="Password" id="password" name="password" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
                                    <?php
                                    if(isset($_SESSION['register']) != ''){?>
                                    <button type="button" class="btn btn-lg btn-info btn-block btn-login text-uppercase font-weight-bold mb-2" disabled><i class="fas fa fa-registered"></i>&nbsp;Register</button>
                                    <?php }else{?>
                                        <button type="button" class="btn btn-lg btn-info btn-block btn-login text-uppercase font-weight-bold mb-2" onclick='window.location.href="register.php"'><i class="fas fa fa-registered"></i>&nbsp;Register</button>
                                    <?php }?>    
                                    <center><a href="home">กลับหน้าหลัก</a></center>
                                </form>
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