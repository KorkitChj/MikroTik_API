<?php
include "../include/IMGallery/imgallery-jquery.php";
require('../include/connect_db.php');
$id = "../slips/{$_GET['id']}";
gallery_thumb_width('200em');
gallery_thumb_margin('40em');
gallery_thumb_border('double','4px','gray');
gallery_thumb_hover_border('double','4px','red');
gallery_echo_img($id);
?>