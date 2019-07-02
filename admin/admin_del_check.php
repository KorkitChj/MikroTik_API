<?php
//delete.php
require('../include/connect_db.php');
require('function.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST["cus_id"])) {
    foreach ($_POST["cus_id"] as $cus_id) {
        $image = get_image_name($cus_id);
        $query = "DELETE FROM siteadmin WHERE cus_id = :cus_id";
        $result = $conn->prepare($query);
        $result->bindparam(':cus_id', $cus_id);
        if ($image != '') {
            $path = "../slips/".$image;
            if (file_exists($path)) {
                unlink("../slips/" . $image);
                $result->execute();
            } else {
                $result->execute();
            }
        } else {
            $result->execute();
        }
    }
    if (!empty($result)) {
        $output['success'] = true;
        $output['messages'] = 'ลบข้อมูลที่เลือกแล้ว';
    } else {
        $output['success'] = false;
        $output['messages'] = 'ไม่สามารถลบข้อมูลที่เลือกได้';
    }
}
echo json_encode($output);
