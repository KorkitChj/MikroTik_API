<?php
session_start();
?>
<?php
if ($_FILES["image"]["name"]) {
    include('../include/connect_db.php');
    include('function.php');
    $output = array('success' => false);
    $admin_id = $_SESSION['admin_id'];
    $query = $conn->prepare("SELECT image FROM admin WHERE admin_id = :admin_id");
    $query->bindparam(':admin_id', $admin_id);
    $query->execute();
    while($result2 = $query->fetch(PDO::FETCH_ASSOC)){
        $value2 = $result2['image'];
    }
    
    if (!empty($value2)) {
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $value) {
            unlink('image/' . $value['image'] . '');
            break;
        }
        $image = '';
        if ($_FILES["image"]["name"] != '') {
            $image = upload_imageadmin();
        }
        $sql4 = "UPDATE admin SET image = :image WHERE admin_id = :admin_id";
        $query4 = $conn->prepare($sql4);
        $query4->bindparam(':image', $image);
        $query4->bindparam(':admin_id', $admin_id);
        $query4->execute();
        $output['success'] = true;
    } else {
        $image = '';
        if ($_FILES["image"]["name"] != '') {
            $image = upload_imageadmin();
        }
        $sql4 = "UPDATE admin SET image = :image WHERE admin_id = :admin_id";
        $query4 = $conn->prepare($sql4);
        $query4->bindparam(':image', $image);
        $query4->bindparam(':admin_id', $admin_id);
        $query4->execute();
        $output['success'] = true;
    }
}
echo json_encode($output);
?>
