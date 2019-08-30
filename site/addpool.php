<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$output = array('success' => false,'messages' => array());
list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);
$pool = $_POST['name'];
$ranges = $_POST['ranges'];
$nextpool = $_POST['nextpool'];
if ($API->connect($ip . ":" . $port, $user, $pass)) {
    if ($pool != "") {
        $ARRAY = $API->comm("/ip/pool/add", array(
            "name"     => $pool,
            "ranges" => $ranges,
            "next-pool"  => $nextpool,
        ));
    }
    $output['success'] = true;
    $output['messages'] = "ระบบได้ทำการเพิ่ม Pool เรียบร้อยแล้ว";
}
echo json_encode($output);
?>