<?php
session_start();
?>
<?php
error_reporting(0);
if ($_POST) {
    include('../include/connect_db.php');
    include('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);


    $output = array('success' => false, 'messages' => array());

    if (isset($_POST['editemp_name'])) {
        if ($API->connect($ip . ":" . $port, $user, $pass)) {
            $ARRAY = $API->comm("/user/set", array(
                ".id" => $_POST["editemp_name"],
                "group" => $_POST['editgroup'],
                "comment" => $_POST["editcomment"]
            ));
        }
        $name = $_POST["editname"];
        $password = MD5($_POST["editpassword"]);
        $username = $_POST["editusername"];

        $sql = "UPDATE employee SET pass_w= :password
        ,full_name= :name WHERE username = :username";
        $query = $conn->prepare($sql);
        $query->bindparam(':password', $password);
        $query->bindparam(':name', $name);
        $query->bindparam(':username', $username);
        if ($query->execute()) {
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
        } else {
            $output['success'] = false;
            $output['messages'] = "ผิดพลาด";
        }
    }
}
echo json_encode($output);
?>