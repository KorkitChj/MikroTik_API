<?php
session_start();
?>
<?php
if ($_FILES["image"]["name"]) {
    include('../include/connect_db.php');
    include('function.php');
    $output = array('success' => false);
    $cus_id = $_SESSION['cus_id'];
    $query = $conn->prepare("SELECT image FROM siteadmin WHERE cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
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
        $sql4 = "UPDATE siteadmin SET image = :image WHERE cus_id = :cus_id";
        $query4 = $conn->prepare($sql4);
        $query4->bindparam(':image', $image);
        $query4->bindparam(':cus_id', $cus_id);
        $query4->execute();
        $output['success'] = true;
    } else {
        $image = '';
        if ($_FILES["image"]["name"] != '') {
            $image = upload_imageadmin();
        }
        $sql4 = "UPDATE siteadmin SET image = :image WHERE cus_id = :cus_id";
        $query4 = $conn->prepare($sql4);
        $query4->bindparam(':image', $image);
        $query4->bindparam(':cus_id', $cus_id);
        $query4->execute();
        $output['success'] = true;
    }
}
echo json_encode($output);
?>
