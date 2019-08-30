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
      $ARRAY = $API->comm("/user/active/print");
      $count = count($ARRAY);
  }

  $output .= '
  <div class="table-responsive">
   <div align="right">
    '.$count.' Record Online
   </div>
   <table class="table table-sm table-bordered table-striped display responsive nowrap">
   <thead class="aa">
    <tr>
        <th>No.</th>
        <th>When</th>
        <th>Name</th>
        <th>Address</th>
        <th>Via</th>
        <th>Group</th>
    </tr>
    </thead>
  ';
  $i = 0;
  foreach($ARRAY as $row)
  {
   $i = $i + 1;
   $output .= '
   <tr> 
        <td>'.$i.'</td>
        <td>'.$row["when"].'</td>
        <td>'.$row["name"].'</td>
        <td>'.$row["address"].'</td>
        <td>'.$row["via"].'</td>
        <td>'.$row["group"].'</td>
   </tr>
   ';
  }
  $output .= '</table></div>';
  echo $output;
 }
}
?>