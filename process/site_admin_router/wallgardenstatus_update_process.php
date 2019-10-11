<?php
session_start();
?>
<?php
if ($_POST) {
    $domainname = $_POST["editdomainname"];
    $action = $_POST['editaction'];
    $comment_a = $_POST['editcomment'];
    $comment_b = $_POST['edit_comment'];


    include('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/set", array(
            "dst-host" => $domainname,
            "action" => $action,
            "comment" => $comment_a,
            "numbers" => $comment_b,
        ));
        $output['success'] = true;
        $output['messages'] = "แก้ไขข้อมูลแล้ว";
     }
     else
     {
        $output['success'] = false;
        $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
     }
}
echo json_encode($output);
?>