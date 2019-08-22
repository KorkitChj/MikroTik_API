<?php
session_start();
?>
<?php
require('include/connect_db.php');

$output = array('success' => false, 'messages' => array());

if (isset($_POST["username"])) {
	$username = $_POST["username"];
	$sql1 = "SELECT *FROM siteadmin WHERE username = :username";
	$query1 = $conn->prepare($sql1);
	$query1->bindparam(':username', $username);
	$query1->execute();
	$num_rows = $query1->fetchColumn(); 

	if ($num_rows == 0) {
		$password = MD5($_POST["password"]);
		$fullname = $_POST["fullname"];
		$email  = $_POST["email"];
		$phonenumber  = $_POST["number"];
		$site = $_POST["site"];
		$address = $_POST["address"];
		$_SESSION["register"] = $_POST["username"];

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
			$output['success'] = true;
        	$output['messages'] = "ข้อมูลของคุณบันทึกเรียบร้อยแล้ว"; 
		}
	} else {
		$output['success'] = false;
        $output['messages'] = "กรุณาเปลี่ยน Username"; 
	}
}
echo json_encode($output);
?>