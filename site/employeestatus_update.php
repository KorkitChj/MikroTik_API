<?php
session_start();
?>
<?php
if ($_POST) {
    include('../include/connect_db.php');
    $output = array('success' => false, 'messages' => array());

    if (isset($_POST["editemp_id"])) {
        $emp_id = $_POST["editemp_id"];
    }
    
    $name = $_POST["editname"];
    $password = MD5($_POST["editpassword"]);
    

    $sql = "UPDATE employee SET pass_w= :password
        ,full_name= :name WHERE emp_id = :emp_id";
    $query = $conn->prepare($sql);
    $query->bindparam(':password',$password);
    $query->bindparam(':name',$name);
    $query->bindparam(':emp_id',$emp_id);
    if ($query->execute()) {
        $output['success'] = true;
        $output['messages'] = "แก้ไขข้อมูลแล้ว";
    } else {
        $output['success'] = false;
        $output['messages'] = "ผิดพลาด";
    }
}
echo json_encode($output);
?>