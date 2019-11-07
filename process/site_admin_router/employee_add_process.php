<?php
session_start();
?>
  <?php
  error_reporting(0);
    if ($_POST) {
        
        $location_id = $_SESSION['location_id'];
        $cus_id = $_SESSION['cus_id'];
        include('function.php');
        
        list($ip,$port,$user,$pass,$site,$conn,$API) = fetchuser($cus_id,$location_id);

        $output = array('success' => false, 'messages' => array());

        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = MD5($_POST["password"]);
        $site = $_POST["site"];
        $group = $_POST["group"];
        $comment = $_POST["comment"];
        

        $sql = "SELECT * FROM employee WHERE username = :username AND location_id = :location_id";
        $query = $conn->prepare($sql);
        $query->bindparam(':username', $username);
        $query->bindparam(':location_id', $location_id);
        $query->execute();
        if ($query->rowCount() != 0) {
            $output['success'] = false;
            $output['messages'] = "ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน Username";
        } else {
            $min = 11111;
            $max = 99999;
            $pass_router = rand($min, $max);
                       
            if ($API->connect($ip . ":" . $port, $user, $pass)) {
                $ARRAY = $API->comm("/user/print");
                $count = count($ARRAY);
                for ($i = 0; $i < $count; $i++) {
                    $a = $ARRAY[$i]['name'];
                    if ($a == $username) {    
                        $output['success'] = false;
                        $output['messages'] = "กรุณาเปลี่ยน Username";
                        echo json_encode($output);
                        exit(0);
                 
                    }
                }
                $ARRAY = $API->comm("/user/add", array(
                    "name" => $username,
                    "password" => $pass_router,
                    "comment" => $comment,
                    "group" => $group,
                ));
                $sql = "INSERT INTO  employee VALUES
                                        ('',:username,:password,:pass_router,:name,:location_id)";
                $query = $conn->prepare($sql);
                $query->bindparam(':username', $username);
                $query->bindparam(':password', $password);
                $query->bindparam(':pass_router', $pass_router);
                $query->bindparam(':name', $name);
                $query->bindparam(':location_id', $location_id);
                $query->execute();
                $output['success'] = true;
                $output['messages'] = "เพิ่มข้อมูลแล้ว";
            } else {
                $output['success'] = false;
                $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
            }
        }
    }
    echo json_encode($output);
    ?>
