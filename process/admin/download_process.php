<?php
if(isset($_GET['idp']) == "product"){
    $id = "../../img/products/{$_GET['id']}";
}else{
    $id = "../../slips/{$_GET['id']}";
}
header("Content-Type:application/download");
header("Content-Disposition:attachment;filename=$id");
header("Content-Transfer-Encoding:binary");
readfile("$id");

?>
