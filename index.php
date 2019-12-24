<?php
session_start();
include("includes/template_frontend/page_link_config.php");
include('includes/db_connect.php');
$sql3 = "SELECT url FROM video WHERE id = 1";
$query3 = $conn->prepare($sql3);
$query3->execute();
$row = $query3->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
    <style>
        img#bn {
            margin-bottom: 5rem;
        }
    </style>
</head>

<body id="indexbg">

    <?php include("includes/template_frontend/navigation.php"); ?>
    <?php include("includes/template_frontend/carousel_slide.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col bgoverlay">
                <div class="bgwi shadow">
                    <h1 id="h1hd">ยินดีต้อนรับสู่เว็บไซต์ของเรา</h1>
                    <dl>
                        <dt>
                       <h3><i class="fas fa-question text-primary"></i>&nbsp;เว็บไซต์เราทำอะไร</h3>
                        </dt>
                        <dd>
                            <p>เว็บไซต์ของเราให้บริการเว็บเอพีไอ <br>การให้บริการของเราจะเชื่อมโยงกับเราเตอร์ไมโครติคของท่าน<br>ผ่าน
                                เอพีไอของไมโครติค</p>
                        </dd>
                        <dt>
                            <h3><i class="fas fa-flash text-warning"></i>&nbsp;ทำไมต้องใช้เว็บไซต์เรา</h3>
                        </dt>
                        <dd>
                            <p>เว็บไซต์ของเราให้ท่านได้บริหารจัดการอินเตอร์เน็ตของท่านได้อย่างมีประสิทธิภาพ<br>
                        โดยสามารถจัดการกับผู้ใช้งานได้หลากหลาย</p>
                        </dd>
                        <dt>
                            <h3><i class="fas fa-user-circle text-success"></i>&nbsp;จุดเด่น</h3>
                        </dt>
                        <dd>
                            <p>ท่านสามารถออกคูปองการใช้งานอินเตอร์เน็ตให้ลูกค้าได้<br>
                            สามารถตั้งวันหมดอายุโดยอัตโนมัติและอัตราการดาวห์โหลดการอัพโหลด<br>ได้อย่างมีประสิทธิภาพ</p>
                        </dd>
                    </dl>
                    <p style="color:red;border:1px solid black;border-radius:10px;padding:20px">หากท่านสนใจในบริการของเราท่านสามารถกดสั้งซื้อได้จากปุ่มด้านบน <br>
                        หรือหากท่านมีปัญหาการใช้งานหรือข้อสงสัยสามารถติดต่อผู้ดูแลระบบได้ที่&nbsp;<a  href="#" onclick='window.open("https://web.facebook.com/kokig.choojum.9");return false;'><i class="fab fa-facebook-messenger"></i></a></p>
                </div>
            </div>
            <div class="col">
                <div class="card bg-light text-dark shadow mt-5">
                    <div class="card-header">
                        <h2 align="center"><b>แนะนำบริการ</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?= $row['url'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="bgwi"><b style="font-size: 32px;">การทำงานของระบบ</b><br><img id="bn" class="img-fluid shadow img-thumbnail" src="img/banner.png" width="700px"></p>
    </div>
    <?php include("includes/template_frontend/footer.php"); ?>
    <?php include("includes/template_frontend/bottom_tag_contents.php"); ?>
    <script src="js/main_site/backtotop.js"></script>
</body>
</html>