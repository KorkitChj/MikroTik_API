<?php
require('template/template_customer.html');
?>
<title>Login|Register</title>
<style>
    #border-login {
        /* background:#e3e3e3; */
        /* background-color: transparent; */
        background: url('img/3.jpg');
        background-color: rgba(255, 0, 0, 0.4);
        background-repeat: no-repeat;
        background-size: cover;
        padding: 1.5em;
        border-radius: 5px;
        box-shadow: 0px 0px 8px 4px rgb(0, 0, 0);
    }

    p {
        color:red;
        font-weight: bold;
    }

    p:hover {
        color:black;
    }

    body {
        background-image: url('img/marble.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        /* background: rgb(255,255,255);
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(227,227,227,1) 100%, rgba(186,186,186,1) 100%, rgba(181,181,181,1) 100%, rgba(175,238,255,1) 100%); */
    }
    a {
        /* color: white; */
        font-weight: bold;
    }

    a:hover {
        color: red;
        text-decoration: none;
    }
    .btn-danger{
        background-color:white;
        color:black;
    }
    #d{
        text-decoration:none;
    }
    .far,.fas{
        color:black;
    }
    html{
        border-top:red 0.25em solid; 
        height:100%;
    }

</style>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col">
                <div class="rounded d-flex align-items-center flex-column justify-content-center h-100 bg-transparent text-white" id="header" style="margin-top:1em">
                    <div id="border-login">
                        <form method="post" action="rlogin.php">
                            <div class="form-group row">
                                <label for="" class="col-2 col-form-label"><i class="far fa-user"></i></label>
                                <div class="col-10">
                                    <input class="form-control form-control-lg" name="username" placeholder="Username" type="text" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-2 col-form-label"><i class="fas fa-key"></i></label>
                                <div class="col-10">
                                    <input class="form-control form-control-lg" name="password" placeholder="Password" type="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-2 col-form-label"></label>
                                <div class="col-5">
                                    <a href="register.php" id="d" onclick="return confirm('คุณต้องการลงทะเบียน?');"><button type="button" class="btn btn-danger btn-lg btn-block">Register</button></a>
                                </div>
                                <div class="col-5">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
                                </div>
                            </div>
                        </form>
                        <p>Login With Username & Password</p>
                        <a href="index.php">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>