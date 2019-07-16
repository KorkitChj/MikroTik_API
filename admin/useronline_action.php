<?php
session_start();
?>
<?php
//action.php
include('../include/connect_db.php');
if(isset($_POST["action"]))
{
 if($_POST["action"] == "update_time")
 {
  $query = "
  UPDATE login_details 
  SET last_activity = :last_activity 
  WHERE login_details_id = :login_details_id
  ";
  $statement = $conn->prepare($query);
  $statement->execute(
   array(
    'last_activity'  => date("Y-m-d H:i:sa"),
    'login_details_id' => $_SESSION["login_id"]
   )
  );
 }
 if($_POST["action"] == "fetch_data")
 {
  $output = '';
  $query = "SELECT login_details.cus_id,username, siteadmin.e_mail FROM login_details 
  INNER JOIN siteadmin 
  ON login_details.cus_id = siteadmin.cus_id WHERE last_activity > DATE_SUB(NOW(),INTERVAL 5 SECOND)";
  $statement = $conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $count = $statement->rowCount();
  $output .= '
  <div class="table-responsive">
   <div align="right">
    '.$count.' Users Online
   </div>
   <table class="table table-striped display responsive nowrap">
   <thead class="bg-info">
    <tr>
     <th>No.</th>
     <th>Username</th>
     <th>Email ID</th>
     <th>Image</th>
     <th>ID</th>
    </tr>
    </thead>
  ';
  $i = 0;
  foreach($result as $row)
  {
   $i = $i + 1;
   $output .= '
   <tr> 
    <td>'.$i.'</td>
    <td>'.$row["username"].'</td>
    <td>'.$row["e_mail"].'</td>
    <td><img src="../img/iconuser.jpg" class="img-thumbnail" width="50" /></td>
    <td>'.$row["cus_id"].'</td>
   </tr>
   ';
  }
  $output .= '</table></div>';
  echo $output;
 }
}
?>