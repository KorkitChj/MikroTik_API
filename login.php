<?php
include('template/template_login&register.html');
error_reporting(0);
?>
<title>Login|Register</title>
<div class="container" style="width:100%; max-width:600px">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-info border-danger">
                <div class="card-header">
                    <p align="center">Sign in to MikroTik API</p>
                </div>
                <div class="card-body">
                    <form id="login" method="" action="">
                        <div class="form-group row">
                            <label for="username" class="control-label col-sm">Username:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-sm">Password:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
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
                                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-sign-in-alt"></i>&nbsp;SignIn</button>
                            </div>
                        </div>
                        <a href="index.php">Back to Home</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>