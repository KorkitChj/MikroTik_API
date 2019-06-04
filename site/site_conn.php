<?php
session_start();
?>
	<?php
	if (!empty($_GET['id'])) {
		$_SESSION['id'] = $_GET['id'];
		$id =  $_GET['id'];
		if ($_GET['conn'] == "connect") {
			echo "<meta http-equiv='refresh' content='0;url=addemployee.php?location_id=" . $id . "' />";
		} else {
			echo "<script language='javascript'>alert('Disconnect')</script>";
			echo "<script language='javascript'>window.location='../siteadmin/connectstatus.php'</script>";
			exit();
		}
	}
	?>