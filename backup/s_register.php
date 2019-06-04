<?php
session_start();
?>
<?php
require('include/connect_db.php');
if (isset($_POST["MM_insert"])) {
	$inputusername = $_POST["inputusername"];
	$sql1 = "SELECT *FROM siteadmin WHERE username = '$inputusername'";
	$result = $conn->query($sql1);
	$num_rows = $result->num_rows;
	if ($num_rows == 0) {
		$inputusername = $_POST["inputusername"];
		$inputpassword = MD5($_POST["inputpassword"]);
		$fullname = $_POST["inputfullname"];
		$inputemail  = $_POST["inputemail"];
		$inputphonenumber  = $_POST["inputphonenumber"];
		$site = $_POST["inputworkingsite"];
		$address = $_POST["address"];
		$_SESSION["cus_name"] = $_POST["inputusername"];

		$sql = "INSERT INTO siteadmin 
                            values('','$inputusername','$inputpassword','$address','$inputphonenumber'
                            ,'$inputemail','$site','$fullname')";
		if ($conn->query($sql)) {
			echo "<script>";
			echo "alert(\"ข้อมูลของคุณบันทึกเรียบร้อยแล้ว\");";
			echo "window.history.back()";
			echo "</script>";
			exit;
		}
	} else {
		echo "<script>";
		echo "alert(\"เพิ่มข้อมูลไม่ได้\");";
		echo "window.history.back()";
		echo "</script>";
	}
}
?>