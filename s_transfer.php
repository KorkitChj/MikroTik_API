<?php
session_start();
?>
<?php
if (isset($_POST["MM_insert"]) && ($_SESSION["cus_name"])) {
    require('connect_db.php');
    require_once('class/class.upload.php-master/src/class.upload.php');
    $bank_info = $_POST["bank_info"];
    $time = $_POST["time"];
    $money = $_POST["money"];
    $cus_name = $_SESSION["cus_name"];
    $rcus_id = $conn->query("SELECT cus_id FROM siteadmin WHERE username = '$cus_name'");
    if ($rcus_id === 1) {
        $upload_image = new upload($_FILES['image_name']);
        if ($upload_image->uploaded) {
            $upload_image->image_resize = true; // อนุญาติให้ย่อภาพได้
            $upload_image->image_x = 400; // กำหนดความกว้างภาพเท่ากับ 400 pixel
            $upload_image->image_ratio_y = true; // ให้คำณวนความสูงอัตโนมัติ
            $upload_image->process("slips"); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ *** โฟลเดอร์ต้องมี permission 0777
            if ($upload_image->processed) {
                $image_name = $upload_image->file_dst_name; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
                $upload_image->clean();
                $image_name = sprintf("%s", $image_name);
                $result = $conn->query("INSERT INTO payment
        ('',slip,payment_at,transfer_date,amount)
        VALUES('$image_name','$bank_info','$time','$money')");
                //ยังไม่เสร็จ
                if ($result != 1) { }
            }
        }
    }
}

?>
    