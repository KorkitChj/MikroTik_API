<?php
$id = "../../slips/{$_GET['id']}";
header("Content-Type:application/download");
header("Content-Disposition:attachment;filename=$id");
header("Content-Transfer-Encoding:binary");
readfile("$id");

?>
