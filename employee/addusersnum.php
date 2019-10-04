<?php
session_start();
?>
<?php
if ($_POST) {
    include('function.php');
    include('ran.php');

    $emp_id = $_SESSION['emp_id'];
    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);
    $prefix = $_POST['prefix'];
    $num = $_POST['total'];
    $profiles = $_POST['profiles'];
    $limituptimes = $_POST['limituptimes'];
    //$comments = $_POST['comments'];

    $service = service($emp_id);
    function adduser($API, $ip, $port, $user, $pass_r,$profiles, $limituptimes,$service, $num)
    {
        $output = array('success' => false, 'messages' => array());
        if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
            $ARRAY = $API->comm("/ip/hotspot/user/print");
            $count = count($ARRAY);
            if ($service == 1) {
                if ($count > 400) {
                    $output['success'] = false;
                    $output['messages'] = "จำนวนผู้ใช้งานเต็มแล้วกรุณาติดต่อ Admin";
                    return $output;
                } else {
                    $i = 1;
                    do {
                        $ARRAY = $API->comm("/ip/hotspot/user/print");
                        $username = $_POST['prefix'] . genUser();
                        for ($j = 1; $j < $count; $j++) {
                            $a = $ARRAY[$j]['name'];
                            if ($a == $username) {
                                $output['success'] = false;
                                $output['messages'] = "กรุณาเปลี่ยน Username";
                                return $output;
                            }
                        }
                        $password = genPass();
                        $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                            "name" => $username,
                            "password" => $password,
                            "profile" => $profiles,
                            "limit-uptime" => $limituptimes
                        ));
                        $i++;
                    } while ($i <= $num);

                    $output['success'] = true;
                    $output['messages'] = "บันทึกข้อมูลแล้ว";
                    return $output;
                }
            } else {
                $i = 1;
                do {
                    $ARRAY = $API->comm("/ip/hotspot/user/print");
                    $username = $_POST['prefix'] . genUser();
                    for ($j = 1; $j < $count; $j++) {
                        $a = $ARRAY[$j]['name'];
                        if ($a == $username) {
                            $output['success'] = false;
                            $output['messages'] = "กรุณาเปลี่ยน Username";
                            return $output;
                        }
                    }
                    $password = genPass();
                    $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                        "name" => $username,
                        "password" => $password,
                        "profile" => $profiles,
                        "limit-uptime" => $limituptimes
                    ));
                    $i++;
                } while ($i <= $num);
                $output['success'] = true;
                $output['messages'] = "บันทึกข้อมูลแล้ว";
                return $output;
            }
        } else {
            $output['success'] = false;
            $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
            return $output;
        }
    }
    $output = adduser($API, $ip, $port, $user, $pass_r,$profiles, $limituptimes,$service, $num);
}
echo json_encode($output);
?>
