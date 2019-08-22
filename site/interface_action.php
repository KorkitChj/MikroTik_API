<?php
session_start();
?>
<?php
//action.php
error_reporting(0);
include('function.php');

$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);


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
  <div class="table-responsive">
   <div align="right">
    '.$count.' Interface
   </div>
   <table class="table table-sm table-bordered table-striped display responsive nowrap">
   <thead class="aa">
    <tr>
        <th>No.</th>
        <th>Status</th>
        <th>Name</th>
        <th>Type</th>
        <th>Actual MTU</th>
        <th>L2 MTU</th>
        <th>MAC-Address</th>
        <th>Last Link Up Time</th>
        <th>Link Downs</th>
        <th>Options</th>
    </tr>
    </thead>
  ';
  $i = 0;
  foreach($ARRAY as $row)
  {
      if($row["running"] == "true"){
         $running = '<button title="running" type="button" class="btn btn-success">R</button>';
      }
      else if($row["disabled"] == "true"){
        $running = '<button title="disable" type="button" class="btn btn-warning">D</button>';
     }
      //$tx = $row["tx-packet"] / 1048576;
      //$rx = $row["rx-packet"] / 1048576;
      //$tx = round($tx,1);
      //$rx = round($rx,1);
   $i = $i + 1;
   $output .= '
   <tr> 
        <td>'.$i.'</td>
        <td>'.$running.'</td>
        <td>'.$row["name"].'</td>
        <td>'.$row["type"].'</td>
        <td>'.$row["actual-mtu"].'</td>
        <td>'.$row["l2mtu"].'</td>
        <td>'.$row["mac-address"].'</td>
        <td>'.$row["last-link-up-time"].'</td>
        <td>'.$row["link-downs"].'</td>
        <td><div class="btn-group btn-group-toggle" data-toggle="buttons">
        <button class="btn btn-success" type="button" onclick="enableInterface(\''.$row['.id'].'\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
        <button class="btn btn-danger" type="button"  onclick="disableInterface(\''.$row['.id'].'\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
        </div></td>
   </tr>
   ';
  }
  $output .= '</table></div>';
  echo $output;
 }
}
?>