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
</head>

<body id="indexbg">

    <?php include("includes/template_frontend/carousel_slide.php"); ?>
    <?php include("includes/template_frontend/navigation.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col bgoverlay">
                <h1 id="h1hd">ยินดีต้อนรับสู่เว็บไซต์ของเรา</h1>
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
                <p id="bgwi">หากท่านสนใจในบริการของเราท่านสามารถกดสั้งซื้อได้จากปุ่มด้านบน <br>
                    หรือหากท่านมีปัญหาการใช้งานหรือข้อสงสัยสามารถติดต่อผู้ดูแลระบบได้ที่ Facebook</p>
            </div>
            <div class="col">
                <div class="card bg-light text-dark border-danger shadow-lg p-3 mb-5">
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
    </div>
    <?php include("includes/template_frontend/footer.php"); ?>
    <script src="js/main_site/backtotop.js"></script>
</body>

</html>