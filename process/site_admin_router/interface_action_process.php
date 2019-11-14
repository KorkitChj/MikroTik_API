<?php
session_start();
?>
<?php
//action.php
error_reporting(0);
include('function.php');

$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);


if(isset($_POST["action"]))
{
 if($_POST["action"] == "fetch_data")
 {
  $output = '';

  if ($API->connect($ip . ":" . $port, $user, $pass)) {
      $ARRAY = $API->comm("/interface/print");
      $count = count($ARRAY);
  }

  $output .= '
  <div class="box">
  <div class="table-responsive">
   <div align="right">
    '.$count.' Interface
   </div>
   <table class="table table-sm table-striped display responsive nowrap">
   <thead class="aa">
    <tr>
        <th>No.</th>
        <th>Status</th>
        <th>Name</th>
        <th>MAC-Address</th>
        <th>TX-Packet</th>
        <th>RX-Packet</th>
        <th>Options</th>
    </tr>
    </thead>
  ';
  $i = 0;
  foreach($ARRAY as $row)
  {
      if($row["running"] == "true"){
         $running = '<button title="running" type="button" class="btn btn-success btn-sm">R</button>';
      }
      else if($row["disabled"] == "true"){
        $running = '<button title="disable" type="button" class="btn btn-light btn-sm">D</button>';
     }else{
        $running = '<button title="running" type="button" class="btn btn-success btn-sm">R</button>';
     }
    //   $tx = $row["tx"] / 1048576;
    //   $rx = $row["rx"] / 1048576;
    //   $tx = round($tx,1);
    //   $rx = round($rx,1);
    $tx = round($row['tx-byte']/125,0);
    $rx = round($row['rx-byte']/125,0);
   $i = $i + 1;
   $output .= '
   <tr> 
        <td>'.$i.'</td>
        <td>'.$running.'</td>
        <td>'.$row["name"].'</td>
        <td>'.$row["mac-address"].'</td>
        <td>'.$tx.' Kbps</td>
        <td>'.$rx.' Kbps</td>
        <td><div class="btn-group btn-group-toggle" data-toggle="buttons">
        <button class="btn btn-success btn-sm" type="button" onclick="enableInterface(\''.$row['.id'].'\')">เปิด</button>
        <button class="btn btn-danger btn-sm" type="button"  onclick="disableInterface(\''.$row['.id'].'\')">ปิด</button>
        </div></td>
   </tr>
   ';
  }
  $output .= '</table></div></div>';
  echo $output;
 }
}
?>