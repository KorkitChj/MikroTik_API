<?php
require('template/template_index.html');
?>
<title>index</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i|Roboto');
body{
	padding: 0;
    margin: 0;
    background-image: url('img/marble-1.jpg');
    background-repeat: no-repeat;
    background-size: cover;
	
}

.ax{
        /* margin-bottom:1em; */
        border-bottom:red 0.5em solid;
    }
h3{
	text-align: center;
    padding:0.5em;
    font-weight:bold;
}
p{
    padding-left:2em;
}
footer{
	padding-top: 60px;
	background: url(img/1.jpg) center center;
	background-size: cover;
    height: 250px;
    border-bottom:red 0.5em solid;
}
h1{
	text-align: center;
	padding: 20px;
    font-weight:bold;
}
h1:hover{
    color:red;
}
h2{
	color:white;
	text-transform: capitalize;
	font-size: 24px;
	text-align: center;
	font-family: 'Open Sans';
	font-weight: 400;
	letter-spacing: 1px;
}
#a:hover{
    color:black;
    padding: 0.1em;
    background-color:#66ff33;
    border-bottom: 5px white solid;
    text-decoration: none;
}
#b:hover{
    color:black;
    padding: 0.1em;
    background-color:#ffff00;
    border-bottom: 5px white solid;
    text-decoration: none;
}
#c:hover{
    color:black;
    padding: 0.1em;
    background-color:#ff6600;
    border-bottom: 5px white solid;
    text-decoration: none;
}
#d:hover{
    color:black;
    padding: 0.1em;
    background-color:#ff66cc;
    border-bottom: 5px white solid;
    text-decoration: none;
}
#e:hover{
    color:black;
    padding: 0.1em;
    background-color:#00ccff;
    border-bottom: 5px white solid;
    text-decoration: none;
}
#g{
    color:white;
}
p{
	color:black;
	text-align: center;	
}
hr{
	    border-top: 1px solid rgba(210, 90, 90, 0.1);
	width: 100%;
}
.fa{	
	padding-top: 10px;
	color: #fff;
	font-size: 20px;
	display: inline-block;
	text-align: center;
	display: inline-block;
	margin: 0 auto;
}
.social .fa{
	padding-top: 20px;
	font-size: 30px;
	transition: .9s;
}
.social .fa:hover{
	transition: 1s;
	transform: scale(1.1);
	color: #ddd;
}

@media(max-width: 768px){
	footer{
		height: auto !important;
	}
	h2{
		font-size: 30px;
	}
}
</style>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img style="width:50px;height:50px" src="img/api-logo1.png" class="api-logo1" alt="api-logo1"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <!--navbar-->
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a href="index.php" class="nav-link active z"><span class="badge badge-primary"><i class="fas fa-home"></i></span>
                        หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a href="products.php" class="nav-link z"><span class="badge badge-success"><i class="fab fa-product-hunt"></i></span>
                        สินค้า</a>
                </li>
                <li class="nav-item">
                    <a href="payment.php" class="nav-link z"><span class="badge badge-danger"><i class="fas fa-shopping-cart"></i></span>
                        สั่งซื้อ</a>
                </li>
                <li class="nav-item">
                    <a href="transfer.php" class="nav-link z"><span class="badge badge-danger"><i class="fas fa-clipboard-check"></i></span>
                    แจ้งโอนเงิน</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link z"><span class="badge badge-info"><i class="fas fa-sign-in-alt"></i></span>
                        เข้าสู่ระบบ/สมัครสมาชิก</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="container-fluid ">
    <div class="row">
        <div class="col">
            <h1>ยินดีต้อนรับสู่เว็บไซต์ของเรา</h1>
            <dl>
                <dt>
                    <h3>เว็บไซต์เราทำอะไร</h3>
                </dt>
                <dd>
                    <p>เว็บไซต์ของเราให้บริการเว็บเอพีไอ การให้บริการของเราจะเชื่อมโยงกับเราเตอร์ไมโครติคของท่านผ่าน
                        เอพีไอของไมโครติค</p>
                </dd>
                <dt>
                    <h3>ทำไมต้องใช้เว็บไซต์เรา</h3>
                </dt>
                <dd>
                    <p>เว็บไซต์ของเราให้ท่านได้บริหารจัดการอินเตอร์เน็ตของท่านได้อย่างมีประสิทธิภาพ</p>
                </dd>
                <dt>
                    <h3>จุดเด่น</h3>
                </dt>
                <dd>
                    <p>ท่านสามารถออกคูปองการใช้งานอินเตอร์เน็ตให้ลูกค้าได้<br>โดยท่านสามารถกำหนด อัตราการดาวห์โหลดการอัพโหลดได้อย่างมีประสิทธิภาพ</p>
                </dd>
            </dl>
            <p style="color:red;font-weight:bold">หากท่านสนใจในบริการของเราท่านสามารถกดสั้งซื้อได้จากปุ่มด้านบน <br>
                หรือหากท่านมีปัญหาการใช้งานหรือข้อสงสัยสามารถติดต่อผู้ดูแลระบบได้ที่ Facebook</p>
        </div>
    </div>
</div>
</body>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <h2><a href="products.php" id="a">สินค้า</a></h2>
            </div>
            <div class="col-md-2">
                <h2><a href="payment.php" id="b">สั่งซื้อ</a></h2>
            </div>
            <div class="col-md-2">
                <h2><a href="transfer.php" id="d">ยืนยัน</a></h2>
            </div>
            <div class="col-md-2">
                <h2><a href="login.php" id="e">เข้าสู่ระบบ/สมัครสมาชิก</a></h2>
            </div>
            <div class="col-md-2">
                <h2>ติดต่อ</h2>
                <p class="social"><a href="#" onclick='window.open("https://web.facebook.com/kokig.choojum.9");return false;'><i class="fa fa-facebook-square"></i></a>
            </div>
            <hr>
            <div class="col-md-12">
                <p id="g">Mikrotik API 2019. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
