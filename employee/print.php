<?php
session_start();
?>
<style>
	#coupong{
		background:#f1f1f1;
	}
	.th{
		background:#66ccff;
	}
</style>
<?php
error_reporting(0);
$emp_id = $_SESSION['emp_id'];

include("function.php");

list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

echo'<body onload="window.print();">';

if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
	$ARRAY = $API->comm("/ip/hotspot/user/print", array("from" => $_GET['id'],));

	echo '<table id="coupong" border="1"  cellspacing="0" cellpadding="0"><tr>';
	echo '<td class="th" width=100px>';
	echo '<img src="sitelogo/'.fetchlogo($emp_id)[1].'" width="100px" height="100px">';
	echo '</td>';
	echo '<td width=200px>';
	echo '<center>Login Internet Wifi</center></div><hr>';
	echo '<lift>&nbsp;&nbsp;Username :' . $ARRAY[0]["name"] .'</center><hr>';
	echo '<lift>&nbsp;&nbsp;Password :' . $ARRAY[0]["password"] . '</center><hr>';
	echo '<lift>&nbsp;&nbsp;Profile :' . $ARRAY[0]["profile"] . '</center><hr>';
	echo '<lift>&nbsp;&nbsp;Limit :' . $ARRAY[0]["limit-uptime"] . '</center>';
	echo '</td>';
	echo '</tr></table>';
}
?>	


