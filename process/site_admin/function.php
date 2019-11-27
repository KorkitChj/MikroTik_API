<?php
function upload_image()
{
	if(isset($_FILES["site_image"]))
	{
		$extension = explode('.', $_FILES['site_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../img/sitelogo/' . $new_name;
		move_uploaded_file($_FILES['site_image']['tmp_name'], $destination);
		return $new_name;
	}elseif(isset($_FILES["editsite_image"])){
		$extension = explode('.', $_FILES['editsite_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../img/sitelogo/' . $new_name;
		move_uploaded_file($_FILES['editsite_image']['tmp_name'], $destination);
		return $new_name;
	}
}
function fetchimage($cus_id)
{
    include('../includes/db_connect.php');

    $query = $conn->prepare("SELECT image FROM siteadmin  WHERE cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image"] != '') {
        $image = '<img src="../img/site_admin/' . $row["image"] . '"  style="border-radius:50%"/>';
    } else {
        $image = '<img src="../img/site_admin/iconuser.jpg" alt="user" style="border-radius:50%">';
    }
    return $image;
}
function upload_imageadmin()
{
	if(isset($_FILES["image"]))
	{
		$extension = explode('.', $_FILES['image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../img/site_admin/' . $new_name;
		move_uploaded_file($_FILES['image']['tmp_name'], $destination);
		return $new_name;
	}
}
function alertexpired($cus_id){
	include('../includes/db_connect.php');

    $query = $conn->prepare("SELECT a.expired_date FROM payment AS a INNER JOIN orderpd AS b on b.order_id = a.order_id WHERE b.cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
    $query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$todate = date('Y-m-d H:i:s');
	$date1=date_create($row['expired_date']);
	$date2=date_create($todate);
	$diff=date_diff($date1,$date2);
	$days2 = $diff->format("%a");
	//$days2 = 10;
	if($days2 == 10){
		sendmailexpired($cus_id);
	}elseif($days2 == 5){
		sendmailexpired($cus_id);
	}elseif($days2 == 1){	
		sendmailexpired($cus_id);
	}elseif($days2 == 0){
		delsiteadmin($cus_id);
	}
	return $days = $days2 ."วัน";
}
function get_image_name($cus_id)
{
	include('../includes/db_connect.php');
	$statement = $conn->prepare("SELECT slip_name,image,image_site FROM payment AS a 
	INNER JOIN orderpd AS b 
	ON a.order_id = b.order_id 
	INNER JOIN siteadmin AS c 
	ON b.cus_id = c.cus_id
	INNER JOIN location AS d
	on c.cus_id = d.cus_id 
	WHERE c.cus_id = :cus_id");
	$statement->bindparam(':cus_id', $cus_id);
	$statement->execute();
	$result = $statement->fetchAll();
	$i = 0;
	foreach ($result as $row) {
		if($i == 0){
			$a = $row["slip_name"];
			$b = $row["image"];
			if(!empty($a && $b)){
				unlink("../slips/".$a);
				unlink("../img/site_admin/".$b);
			}
		}
			$c = $row["image_site"];
			unlink("../img/sitelogo/".$c);
		$i++;
	}
	return false;
}
function delsiteadmin($cus_id){
	include('../includes/db_connect.php');
	get_image_name($cus_id);
    $sql = "DELETE FROM siteadmin WHERE cus_id = :cus_id";
    $query = $conn->prepare($sql);
    $query->bindparam(':cus_id', $cus_id);
	$query->execute();
	unset($cus_id);
	header('../process/site_admin/expired_page.php');
}


function upload_imagepacket()
{
	if(isset($_FILES["fileslip"]))
	{
		$extension = explode('.', $_FILES['fileslip']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../slips/' . $new_name;
		move_uploaded_file($_FILES['fileslip']['tmp_name'], $destination);
		return $new_name;
	}
}
function fetchemail($cus_id){
	include('../includes/db_connect.php');
	$statement = $conn->prepare("SELECT e_mail,full_name,site_name FROM siteadmin WHERE cus_id = :cus_id");
	$statement->bindparam(':cus_id', $cus_id);
	$statement->execute();
	$email = $statement->fetch(PDO::FETCH_ASSOC);
	return array($email['e_mail'],$email['full_name'],$email['site_name']);
}
function sendmailexpired($cus_id){
	include('../process/main_site/function.php');
	list($email,$name,$sitename) = fetchemail($cus_id);
	$path = "siteadmin";
	$mail = mailConfig($email, $name,$path);
    $mail->Subject = 'แจ้งเตือน Packet หมดอายุการใช้งาน';
	$mail->Body    = 'Thai Mikrotik API ยินดีให้บริการ<br><br>
					เรียนคุณ<strong>  ' . $name . '</strong><br>
					ไซต์งาน<strong>  ' . $sitename . '</strong>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $respone = mailQuery($mail);
}
?>