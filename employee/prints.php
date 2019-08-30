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

    $emp_id = $_SESSION['emp_id'];

    include("function.php");

    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);
    
    
	$value = $_GET['users_name'];
	$myArray = explode(',', $value);
    $users_name = implode(", ",$myArray);
    echo'<body onload="window.print();">';
    
		
		echo'<table id="coupong" border="1"  cellspacing="0" cellpadding="0"><tr>';
        $intRows = 0;
        if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
            $ARRAY = $API->comm("/ip/hotspot/user/print", array("from" =>$users_name,));
		foreach($ARRAY as $row)
		{
           
			$intRows++;
            echo '<td class="th" width=100px>';
            echo '<img src="sitelogo/'.fetchlogo($emp_id)[1].'" width="100px" height="100px">';
			echo '</td>';
			echo '<td width=200px>'; 
			
            echo '<center>Login Internet Wifi</center></div><hr>';
            echo '<lift>&nbsp;&nbsp;Username :' . $row["name"] .'</center><hr>';
            echo '<lift>&nbsp;&nbsp;Password :' . $row["password"] . '</center><hr>';
            echo '<lift>&nbsp;&nbsp;Profile :' . $row["profile"] . '</center><hr>';
            echo '<lift>&nbsp;&nbsp;Limit :' . $row["limit-uptime"] . '</center>';

			echo'</td>';

			if(($intRows)%2==0)
			{
				echo'</tr>';
			}
			
			if(($intRows)%21==0){
				echo'</tr></table><table border="1"  cellspacing="1" cellpadding="1" style="page-break-before: always">';
			}
		}
		echo'</tr></table>';
    }
?>		
