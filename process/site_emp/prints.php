<?php
session_start();
?>
<style>
	#coupong{
		background:#f1f1f1;
	}
	.th{
		background:#66ccff;
	}
</style>
<?php
	error_reporting(0);
    $emp_id = $_SESSION['emp_id'];

    include("function.php");
	include('../../includes/datethai_function.php');
    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);
    
	$value = $_GET['users_name'];
	$myArray = explode(',', $value);
    $users_name = implode(", ",$myArray);
    echo'<body onload="window.print();">';
    
		
		echo'<table id="coupong" border="1"  cellspacing="0" cellpadding="0"><tr>';
        $intRows = 0;
        if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
			$ARRAY2 = $API->comm("/ip/hotspot/user/profile/print");
			$num2 = count($ARRAY2);
			$ARRAY = $API->comm("/ip/hotspot/user/print", array("from" =>$users_name,));
			$count_user = count($ARRAY);
		foreach($ARRAY as $row)
		{
			$daytouse = "unlimit";
            for ($j = 0; $j < $num2; $j++) {
                if ($row["profile"] == $ARRAY2[$j]['name']) {
                    $string = explode("_", $ARRAY2[$j]['name']);
                    $string2 = explode("/", $string[1]);
                    $daytouse = $string2[0];
                    $stdate = dateThai($string[3]);
                    $stdate = explode(",",$stdate);
                    $stdate = $stdate[0];
                    $enddate = strtotime("+{$daytouse} days", strtotime($string[3]));
                    $enddate = date('Y-m-d', $enddate);
                    $enddate = dateThai($enddate);
                    $enddate = explode(",",$enddate);
                    $enddate = $enddate[0];
                    break;
                }
            }
           
			$intRows++;
            echo '<td class="th" width=100px>';
            echo '<img src="../../img/sitelogo/'.fetchlogo($emp_id)[1].'" width="100px" height="90px">';
			echo '</td>';
			echo '<td width=200px>'; 
			
            echo '<center>Login Internet Wifi</center></div><hr>';
            echo '<lift>&nbsp;&nbsp;Username :' . $row["name"] .'</center><hr>';
            echo '<lift>&nbsp;&nbsp;Password :' . $row["password"] . '</center><hr>';
            echo '<lift>&nbsp;&nbsp;เริ่มใช้งาน :' . $stdate . '</center><hr>';
            echo '<lift>&nbsp;&nbsp;หมดอายุ :' . $enddate . '</center>';

			echo'</td>';

			if(($intRows)%2==0)
			{
				echo'</tr>';
			}
			
			if(($intRows)%10==0){
				if($count_user > 10){
					echo'</tr></table><table border="1"  cellspacing="1" cellpadding="1" style="page-break-before: always">';
				}else{
					
				}
				
			}
		}
		echo'</tr></table>';
    }
?>		
