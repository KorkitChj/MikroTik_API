<?php
session_start();
?>
<?php
require('../../includes/db_connect.php');
include('function.php');
error_reporting(0);
define("SECRET_KEY", "6Ld0MsgUAAAAAPQLJyvkksdvWWusMHGIya1Njvp7");
$output = array('success' => false, 'messages' => array(), 'link' => array());

if (isset($_POST["username_register"])) {
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		if (!empty($_POST['g-recaptcha-response'])) {
			$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);

			$response_data = json_decode($response);
			if (!$response_data->success) {
				$captcha_error = 'Captcha verification failed';
			} else {
				$username = $_POST["username_register"];
				$email  = $_POST["email"];
				$sql1 = "SELECT * FROM siteadmin WHERE username = :username";
				$query1 = $conn->prepare($sql1);
				$query1->bindparam(':username', $username);
				$query1->execute();
				$num_rows = $query1->fetchColumn();

				$sql2 = "SELECT * FROM siteadmin WHERE e_mail = :email";
				$query2 = $conn->prepare($sql2);
				$query2->bindparam(':email', $email);
				$query2->execute();
				$num_rows2 = $query2->fetchColumn();

				if ($num_rows == 0) {
					if ($num_rows2 == 0) {
						//$password = MD5($_POST["password_register"]);
						$phonenumber  = $_POST["number"];
						$site = $_POST["site"];
						$address = $_POST["address"];
						$today = date('Y-m-d H:i:s');
						$_SESSION["user"] = $_POST["username_register"];
						$_SESSION["fullname"] = $_POST["fullname"];
						$_SESSION["phone"] = $_POST["number"];
						$_SESSION["email"] = $email;
						$fullname = $_POST["fullname"];
						$password = randomPassword();
						$mail = sendMailRegister($email, $fullname, $password);
						if ($mail != "Success") {
							$output['success'] = false;
							$output['messages'] = "อีเมลไม่ถูกต้องหรือส่งไม่ได้ กรุณาแก้ไขให้ถูกต้องหรือเปลี่ยนอีเมลใหม่";
						} else {
							$sql = "INSERT INTO siteadmin 
				values('',:username,:password,:address,:phonenumber
				,:email,:site,:fullname,'',:regis_date)";
							$query = $conn->prepare($sql);

							$query->bindparam(':username', $username);
							$query->bindparam(':password', password_hash($password, PASSWORD_DEFAULT));
							$query->bindparam(':address', $address);
							$query->bindparam(':phonenumber', $phonenumber);
							$query->bindparam(':email', $email);
							$query->bindparam(':site', $site);
							$query->bindparam(':fullname', $fullname);
							$query->bindparam(':regis_date', $today);

							if ($query->execute()) {
								$_SESSION['register'] = "true";
								$output['link'] = "cart.php";
								$output['success'] = true;
								$output['messages'] = "ลงทะเบียนเรียบร้อยแล้ว
					กรุณาตรวจสอบอีเมลของท่าน";
							}
						}
					} else {
						$output['success'] = false;
						$output['messages'] = "กรุณาเปลี่ยน E-Mail";
					}
				} else {
					$output['success'] = false;
					$output['messages'] = "กรุณาเปลี่ยน Username";
				}
			}
		} else {
			$output['success'] = false;
			$output['messages'] = "Captcha is required";
		}
	} else {
		$output['success'] = false;
		$output['messages'] = "e-mail ไม่ถูกต้อง";
	}
}
echo json_encode($output);
?>