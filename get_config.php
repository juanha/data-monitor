<?php
header('Content-type: text/html; charset=utf-8');
include("config.inc.php");
include("dbconnect.php");
include("function.inc.php");
error_reporting(0);

$type = $_GET["type"];


if ($type != '') {

    if ($type == "config") {
            $config_info=get_config_info();
//            echo "<pre>";
//            print_r($config_info);
//            echo "<br>";
        $config_info=get_config_info();
        $json = json_encode($config_info);
        echo($json);

    }

}


?>
