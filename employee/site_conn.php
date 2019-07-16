<?php
	if (!empty($_GET['conn'])) {
		if ($_GET['conn'] == "connect") {
			echo "<meta http-equiv='refresh' content='0;url=dashboard.php'/>";
		} else {
			echo "<script language='javascript'>alert('Disconnect')</script>";
			echo "<script language='javascript'>window.location='employee.php'</script>";
			exit();
		}
	}
?>
