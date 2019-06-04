<?php
session_start();
?>
<?php		
    require('../template/template.html');
    require('../include/connect_db.php');
	require('../config/routeros_api.class.php');
	require('../include/connect_db_router.php');
	$API = new routeros_api();				
	$API->debug = false;	
	set_time_limit(160);			
?>