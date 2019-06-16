<?php
session_start();
?>
<?php
require('include/connect_db.php');
if (isset($_POST["MM_insert"])) {
	$username = $_POST["inputusername"];
	$sql1 = "SELECT *FROM siteadmin WHERE username = :username";
	$query1 = $conn->prepare($sql1);
	$query1->bindparam(':username', $username);
	$query1->execute();
	$num_rows = $query1->fetchColumn(); 

	if ($num_rows == 0) {
		$password = MD5($_POST["inputpassword"]);
		$fullname = $_POST["inputfullname"];
		$email  = $_POST["inputemail"];
		$phonenumber  = $_POST["inputphonenumber"];
		$site = $_POST["inputworkingsite"];
		$address = $_POST["address"];
		$_SESSION["cus_name"] = $_POST["inputusername"];

		$sql = "INSERT INTO siteadmin 
                            values('',:username,:password,:address,:phonenumber
							,:email,:site,:fullname)";
		$query = $conn->prepare($sql);

        $query->bindparam(':username', $username);
        $query->bindparam(':password', $password);
		$query->bindparam(':address', $address);
		$query->bindparam(':phonenumber', $phonenumber);
        $query->bindparam(':email', $email);
		$query->bindparam(':site', $site);
		$query->bindparam(':fullname', $fullname);
        
		if ($query->execute()) {
			echo "<script>";
			echo "alert(\"ข้อมูลของคุณบันทึกเรียบร้อยแล้ว\");";
			echo "window.location='payment.php'";
			echo "</script>";
			exit;
		}
	} else {
		echo "<script>";
		echo "alert(\"เพิ่มข้อมูลไม่ได้\");";
		echo "window.history.back()";
		echo "</script>";
	}
	$conn->null;
}
?>