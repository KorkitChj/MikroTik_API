
<?php

include('config/routeros_api.class.php');
//require('include/connect_db.php');

$API = new routeros_api();
//$API->debug = false;
//set_time_limit(160);

$ip = "172.20.10.5";
$port = "9000";
$user = "korkit";
$pass = "12345";

$aa = "192.168.50.1/24";
// $bb = "192.168.70.1/24";
$bb = "ether2";
//$aa1 = "reception";
if ($API->connect($ip.":".$port,$user,$pass)) {

     //$ARRAY = $API->comm("/ip/address/set [/ip/address/print
                   //                              ?name=192.168.50.1/24] address=192.168.50.5/24");
    
    // $ARRAY = $API->comm("/ip/address/disable
    //                                 =.id=1");

    //$ARRAY = $API->comm("/user/print",array("?disabled" => "true"));

    // $id = "*7,*A";
    // $ARRAY = $API->comm("/user/remove", array(
    //     ".id" => $id
    // ));

    //$ARRAY = $API->comm("/ip/address/print",array("?dynamic" => "true"));

    //$ARRAY = $API->comm("[/ip/address/print",array("?address" => $aa)]);s


    // $ARRAY = $API->comm("/ip/address/set", array(
    //     ".id" => 2,
    //     "address" => "192.168.70.2/24"
    //     ));

    // $ARRAY = $API->comm("/ip/address/remove", array(
    //       ".id" => 2)
    //     );
    
    $ARRAY = $API->comm("/interface/print");
    //$ARRAY = $API->comm("/ip/hotspot/print",array('?disabled' => "true"));

    //$ARRAY1 = $API->comm("/ip/address/print",array("where" => $aa));
    /*$ARRAY = $API->comm("/ip/address/print
                                        =address=192.168.50.1/24");*/
    // $ARRAY = $API->comm("/ip/address/set [/ip/address/print
    //                                             ?name=192.168.50.1/24] address=192.168.50.5/24");
    //ip address set [/ip address  find address="192.168.50.1/24"] address=192.168.50.5/24
    //$ARRAY = $API->comm("/ip/address/print");
    print_r($ARRAY)."<br>";
    //print_r($ARRAY1);
    //echo "aa";
}

?>