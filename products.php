<?php
session_start();
$_SESSION['order'] = "order";
include("includes/template_frontend/a_config.php");
include('includes/connect_db.php');
$query = $conn->prepare("SELECT * FROM product ORDER BY price ASC");
$query->execute();
$result = $query->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head-tag-contents.php"); ?>
</head>

<body id="products">
    <?php include("includes/template_frontend/navigation.php"); ?>

    <div class="container">
        <div id="gridContainer">
            <div class="row grid-row d-flex justify-content-center margin-top">
                <?php
                foreach ($result as $a => $b) {
                    echo '<div class="col-sm-4">
                            <div class="card shadow-lg p-3 mb-5">
                                <img class="card-img-top" src="img/' . $b['image'] . '" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">' . $b['title'] . '</h5>
                                    <hr>
                                    <p style="font-weight:bold">ฟังก์ชัน</p>
                                    <p class="card-text">';
                    $result2 = explode("/", $b['function']);
                    foreach ($result2 as $c) {
                        echo '- ' . $c . '<br>';
                    }
                    echo '</p><hr>';
                    echo '<a href="payment.php?id=' . $b['product_id'] . '" onclick="return confirm(\'คุณต้องการสั่งซื้อ\');" 
                                    class="btn btn-outline-dark btn-sm">สั่งซื้อ</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include("includes/template_frontend/footer.php"); ?>

</body>

</html>