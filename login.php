<?php
require('template/template_customer.html');
?>
<title>Login|Register</title>
<style>
    #border-login {
        background: #ccffff;
        background-size: cover;
        padding: 1.5em;
        border-radius: 5px;
        border-left: #0099ff 5px solid;
        margin-top: -1.5em;
        margin-bottom: 1.5em;
    }

    p {
        color: red;
        font-weight: bold;
        font-size: 2em;
    }

    p:hover {
        color: black;
    }

    body {
        background-color:#fff;
        background-repeat: no-repeat;
        background-size: cover;
    }

    a {
        font-weight: bold;
    }

    a:hover {
        color: red;
        text-decoration: none;
    }

    .btn-danger,
    .btn-success {
        background-color: white;
        color: black;
    }

    #d {
        text-decoration: none;
    }

    .far,
    .fas {
        color: black;
    }

    html {
        border-top: red 0.25em solid;
        height: 100%;
    }

    input[type="text"],
    [type="password"] {
        border: 0;
        border-bottom: 1px solid red;
        outline: 0;
    }
    .errspan {
        float: right;
        margin-right: 6px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
        color: red;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col">
                <div class="rounded d-flex align-items-center flex-column justify-content-center h-100 bg-transparent text-white" id="header" style="margin-top:1em">
                    <div id="border-login">
                        <p align="center">Sign in to MikroTik API</p>
                        <form method="post" action="rlogin.php">
                            <div class="form-group row has-success has-feedback">
                                <label for="" class="col col-form-label"></label>
                                <div class="col-12">
                                    <input class="form-control form-control-lg" name="username" placeholder="Username" type="text"  required>
                                    <span class="far fa-user errspan"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col col-form-label"></label>
                                <div class="col-12">
                                    <input class="form-control form-control-lg" name="password" placeholder="Password" type="password" required>
                                    <span class="fas fa-key errspan"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col col-form-label"></label>
                                <div class="col-12">
                                    <a href="register.php" id="d" onclick="return confirm('คุณต้องการลงทะเบียน?');"><button type="button" class="btn btn-danger btn-lg btn-block">Register</button></a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col col-form-label"></label>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Sign In</button>
                                </div>
                            </div>
                        </form>
                        <a href="index.php">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>