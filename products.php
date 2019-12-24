<?php
include("includes/template_frontend/page_link_config.php");
if (isset($_GET['page']) == "") {
    $page = "1";
} else {
    $page = $_GET['page'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
</head>

<body id="products">
<div class="modalx" style="display: none;"></div>
<input type="hidden" id="pageid" name="pageid" value="<?=$page?>">
    <?php include("includes/template_frontend/navigation.php"); ?>

    <div class="container">
        <div id="gridContainer">
            
        </div>
    </div>  
    <?php include("includes/template_frontend/footer.php");?>
    <?php include("includes/template_frontend/bottom_tag_contents.php"); ?>
    <script src="js/main_site/products_search.js"></script>
    <script src="js/main_site/backtotop.js"></script>
</body>

</html>