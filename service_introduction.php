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

<body>
    <?php include("includes/template_frontend/navigation.php"); ?>
    <div class="container margin-top" style="width:100%; max-width:900px">
        <div class="row ">
            <div class="col">
                <div class="card  bg-light border-danger shadow-lg p-3 mb-5">
                    <div class="card-header">
                        <h2 align="center"><b>แนะนำบริการ</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?=$row['url']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/template_frontend/footer.php"); ?>
</body>

</html>