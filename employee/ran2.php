<?php
function genUser(){
	$allowed_chars = 'abcdefghijklmnopqrstuvwxz';
	$allowed_count = strlen($allowed_chars);
	$password = null;
	$password_length = $_POST['usernamest'];
		
		while($password === null || already_exists($password)) {
			$password = '';
			for($i = 0; $i < $password_length; ++$i) {
			$password .= $allowed_chars{mt_rand(0, $allowed_count - 1)};
			}
			return $password;
		}
}

function genPass(){
	$allowed_chars = '0123456789';
	$allowed_count = strlen($allowed_chars);
	$password = null;
	$password_length = $_POST['passwordst'];
		
		while($password === null || already_exists($password)) {
			$password = '';
			for($i = 0; $i < $password_length; ++$i) {
			$password .= $allowed_chars{mt_rand(0, $allowed_count - 1)};
			}
			return $password;
		}
}
?>