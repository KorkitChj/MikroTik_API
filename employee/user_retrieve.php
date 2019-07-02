<?php
require('../site/conn.php');
?>
<?php
$output = array('data' => array());
                     
    //error_reporting(0);
    $id = $_SESSION['emp_id'];
    $sql = "SELECT a.username,a.pass_router,b.api_port,b.ip_address FROM employee AS a INNER JOIN 
            location AS b ON a.location_id = b.location_id WHERE a.emp_id = :id";
    $query = $conn->prepare($sql);
    $query->bindparam(':id', $id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $ip_address = $result['ip_address'];
    $port = $result['api_port'];
    $username = $result['username'];
    $pass_router = $result['pass_router'];

    if ($API->connect($ip_address . ":" . $port, $username, $pass_router)) {
        $ARRAY = $API->comm("/ip/hotspot/user/print");
        $count = count($ARRAY);
        $n = 0;
        for ($i = 0; $i < $count; $i++) {
            $n++;
            $checkbox = '<input type="checkbox" class="cus_checkbox" name="rname[]" value=".$ARRAY[$i]["name"].">';
            $actionButton = '<td><button type="button" data-toggle="modal" data-target="#edit" data-uid = "1" class="update btn btn-warning btn-sm">
                    <span class="glyphicon glyphicon-cog"></span></button>
                    <button type="button"  data-toggle="modal"  data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-trash"></span></button>
                    <button type= "button"  data-toggle = "modal "  data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-download"></span></button></td>';

            $output['data'][] = array(
                $checkbox,
		$n,
		$ARRAY[$i]['server'],
		$ARRAY[$i]['name'],
		$ARRAY[$i]['address'],
                $ARRAY[$i]['profile'],
                $ARRAY[$i]['limit-uptime'],
                $ARRAY[$i]['uptime'],
                $actionButton
        );
            }
// database connection close
$conn->null;
echo json_encode($output);
        }
?>
