<?php
session_start();
?>
<?php

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];
include('function.php');

$output = array('success' => false, 'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'one') {
            $emp_id = $_POST['emp_id'];
            $username = $_POST['name'];
            $ARRAY = $API->comm("/user/print");
            $num = count($ARRAY);
            if ($num == '0') {
                $output['success'] = false;
                $output['messages'] = "Default profile can not be removed.";
            } else {
                $ARRAY = $API->comm("/user/remove", array(
                    ".id" => $emp_id,
                ));
                $sql = "DELETE FROM employee WHERE username = :username";
                $query = $conn->prepare($sql);
                $query->bindparam(':username', $username);
                $query->execute();
                $output['success'] = true;
                $output['messages'] = "ทำการลบพนักงานเรียบร้อยแล้ว";
            }
        } elseif ($_POST['type'] == 'many') {
            $username5 = array();
            $username6 = array();
            $aa = array();
            $aa = $_POST['emp_id'];
            foreach ($aa as $bb) {
                $username2 = explode(",", $bb);
                $username5[] = $username2[0];
                $username6[] = $username2[1];
            }

            $id = implode(",", $username6);
            $ARRAY = $API->comm("/user/remove", array(".id" => $id));

            foreach ($username5 as $rm) {
                $sql = "DELETE FROM employee WHERE username = :username";
                $query = $conn->prepare($sql);
                $query->execute(
                    array(
                        'username' => $rm
                    )
                );
            }
            $output['success'] = true;
            $output['messages'] = "ทำการลบพนักงานที่เลือกเรียบร้อยแล้ว";
        }
    }
} else {
    $output['success'] = false;
    $output['messages'] = "Disconnect";
}
echo json_encode($output);
?>