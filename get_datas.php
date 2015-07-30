<?php
header('Content-type: text/html; charset=utf-8');
include("config.inc.php");
include("dbconnect.php");
include("function.inc.php");
error_reporting(0);

$type=$_GET["type"];
$dev=$_GET["dev"];
$dev_arr=array();
if($type!=''){

    if($type=="data"){
        $device_data = get_allDevice_data();

        foreach($device_data as $k=>$v){
                   if($dev==$v['device_name']){
                     $dev_arr=$device_data[$k];
                       break;
                 }
        }
//        echo '<pre>';
        $json=json_encode($dev_arr);
//        print_r($device_data);
        echo ($json);

    }

}


