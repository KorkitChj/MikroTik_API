<?php
session_start();
?>
<?php
//error_reporting(0);
include('function.php');
require('../include/connect_db.php');
//require('../config/pusher/src/Pusher.php');
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/system/resource/print");
    $ram =    $ARRAY['0']['free-memory'] / 1048576;
    $ram = round($ram, 1);
    $totalram =    $ARRAY['0']['total-memory'] / 1048576;
    $totalram  = round($totalram, 1);
    $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
    $hdd = round($hdd, 1) . "MB";
    $totalhdd =    $ARRAY['0']['total-hdd-space'] / 1048576;
    $cpu = $ARRAY['0']['cpu-load'] . "%";
    $boardname =    $ARRAY['0']['board-name'];
    $version =    $ARRAY['0']['version'];
    $uptime =    $ARRAY['0']['uptime'];
    //$json = [];
    //$json[] = $ram;
    //$json[] = $totalram;

    $value = array(
        array(
            'name' => 'Free Memory',
            'y' => $ram
        ),
        array(
            'name' => 'Total Memory',
            'y' => $totalram
        )
    );
    echo json_encode($value, JSON_NUMERIC_CHECK);
}
/*   <span>Online</span>
            </span>
            <h6 class="m-b-20">IP Address/Domain name</h6>
            <h2 class="text-right"><i class="fas fa-link f-left"></i><span><?php echo $ip . "<hr>" ?></span></h2>
  

            <h6 class="m-b-20">Username</h6>
            <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $user ?></span></h2>
            <h3><?php echo "Site " . $site . "<hr>" ?></h3>
  

            <h6 class="m-b-20">Port</h6>
            <h2 class="text-right"><i class="fas fa-server f-left"></i><span><?php echo $port . "<hr>" ?></span></h2>
       
            <h6 class="m-b-20">Board Name</h6>
            <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo $boardname . "<hr>" ?></span></h2>
        
            <h6 class="m-b-20">Version</h6>
            <h2 class="text-right"><i class="fab fa-cloudversify f-left"></i><span><?php echo $version . "<hr>" ?></span></h2>
        
            <h6 class="m-b-20">UpTime</h6>
            <h2 class="text-right"><i class="fas fa-clock f-left"></i><span><?php echo $uptime . "<hr>" ?></span></h2>
  
            <h6 class="m-b-20">Resource</h6>
            <h6>Cpu-Load<h6>
            <h2 class="text-right"><i class="fas fa-microchip f-left"></i><span><?php echo $cpu ?></span></h2>
            <h6>Free-Memory</h6>
            <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo $ram ?></span></h2>
            <h6>Free-HDD-Space</h6>
            <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo $hdd . "<hr>" ?></span></h2>
            <h6 class="m-b-20">Total</h6>
            <h6>Total-HDD</h6>
            <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo $totalhdd . "MB" ?></span></h2>
            <h6>Total-Memory</h6>
            <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo $totalram . "MB<hr>" ?></span></h2>

            <h6 class="m-b-20">IP Address/Domain name</h6>
            <h2 class="text-right"><i class="fas fa-link f-left"></i><span><?php echo $ip . "<hr>" ?></span></h2>
        
            <h6 class="m-b-20">Username</h6>
            <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?php echo $user ?></span></h2>
            <h3><?php echo "Site " . $site . "<hr>" ?></h3>
      
            <h6 class="m-b-20">Port</h6>
            <h2 class="text-right"><i class="fas fa-server f-left"></i><span><?php echo $port . "<hr>" ?></span></h2>
  
            <h6 class="m-b-20">Board Name</h6>
            <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span><?php echo "- <hr>" ?></span></h2>
     
            <h6 class="m-b-20">Version</h6>
            <h2 class="text-right"><i class="fab fa-cloudversify f-left"></i><span><?php echo "- <hr>" ?></span></h2>


            <h6 class="m-b-20">UpTime</h6>
            <h2 class="text-right"><i class="fas fa-clock f-left"></i><span><?php echo "- <hr>" ?></span></h2>
 

            <h6 class="m-b-20">Resource</h6>
            <h6>Cpu-Load<h6>
            <h2 class="text-right"><i class="fas fa-microchip f-left"></i><span><?php echo "-" ?></span></h2>
            <h6>Free-Memory</h6>
            <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo "-" ?></span></h2>
            <h6>Free-HDD-Space</h6>
            <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo "- <hr>" ?></span></h2>


            <h6>Total-HDD</h6>
            <h2 class="text-right"><i class="fas fa-hdd f-left"></i><span><?php echo "- MB" ?></span></h2>
            <h6>Total-Memory</h6>
            <h2 class="text-right"><i class="fas fa-memory f-left"></i><span><?php echo "- MB<hr>" ?></span></h2>
*/

?>