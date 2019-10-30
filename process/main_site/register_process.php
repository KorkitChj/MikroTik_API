<?php
session_start();
?>
<?php
require('../../includes/db_connect.php');
error_reporting(0);
$output = array('success' => false, 'messages' => array(),'link' => array());

if (isset($_POST["username_register"])) {
	$username = $_POST["username_register"];
	$sql1 = "SELECT *FROM siteadmin WHERE username = :username";
	$query1 = $conn->prepare($sql1);
	$query1->bindparam(':username', $username);
	$query1->execute();
	$num_rows = $query1->fetchColumn(); 

	if ($num_rows == 0) {
		$password = MD5($_POST["password_register"]);
		$fullname = $_POST["fullname"];
		$email  = $_POST["email"];
		$phonenumber  = $_POST["number"];
		$site = $_POST["site"];
		$address = $_POST["address"];
		$today = date('Y-m-d H:i:sa');
		$_SESSION["user"] = $_POST["username_register"];
		$_SESSION["fullname"] = $_POST["fullname"];
		$_SESSION["phone"] = $_POST["number"];

		$sql = "INSERT INTO siteadmin 
                            values('',:username,:password,:address,:phonenumber
							,:email,:site,:fullname,'',:regis_date)";
		$query = $conn->prepare($sql);

        $query->bindparam(':username', $username);
        $query->bindparam(':password', $password);
		$query->bindparam(':address', $address);
		$query->bindparam(':phonenumber', $phonenumber);
        $query->bindparam(':email', $email);
		$query->bindparam(':site', $site);
		$query->bindparam(':fullname', $fullname);
		$query->bindparam(':regis_date', $today);
        
		if ($query->execute()) {
			if($_SESSION['order'] == "false"){
				$_SESSION['register'] = "true";
				$output['link'] = "cart.php";
				$output['success'] = true;
				$output['messages'] = "ข้อมูลของคุณบันทึกเรียบร้อยแล้ว"; 
			}elseif($_SESSION['order'] == "true"){
				$_SESSION['register'] = "true";
				$output['link'] = "cart.php";
				$output['success'] = true;
				$output['messages'] = "ข้อมูลของคุณบันทึกเรียบร้อยแล้ว"; 
			}else{
				$_SESSION['register'] = "true";
				$output['link'] = "cart.php";
				$output['success'] = true;
				$output['messages'] = "ข้อมูลของคุณบันทึกเรียบร้อยแล้ว"; 
			}
		}
	} else {
		$output['success'] = false;
        $output['messages'] = "กรุณาเปลี่ยน Username"; 
	}
}
echo json_encode($output);
?>