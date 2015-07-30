<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>数据监测平台</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <link href="bootstrap-responsive.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="device-wdith,initial-scale=1.0">

</head>
<body>
<?php

header('Content-type: text/html; charset=utf-8');
include("config.inc.php");
include("dbconnect.php");
include("function.inc.php");
error_reporting(0);

$add_table = $_POST["addtname"];
$table_field = $_POST["addtfield"];
$dele_table = $_POST["deletname"];

if ($dele_table != '') {
    dele_table($dele_table);
}

if ($add_table != '' && $table_field != '') {
    add_table($add_table, $table_field);
}

$device_data = get_allDevice_data();

//echo "<pre>";
//print_r($device_data);
//echo "<br>";


function add_table($add_table, $table_field)
{

    $sql = "insert into  device (表名,字段名) values('$add_table','$table_field')";
    if (!mysql_query($sql)) {
        die("添加表失败" . mysql_error());
    }

}

function dele_table($dele_table)
{

    $sql = "delete from  device where 表名=" . $dele_table;
    if (!mysql_query($sql)) {
        die("删除失败" . mysql_error());
    }

}



?>
<!--//    $json = json_encode($datas);-->
<!--//    echo $json;-->
<!--//    echo "<br>";-->
<div class="container">
    <h2 class="page-header">数据监测平台</h2>

    <form class="form-horizontal" action="index.php?" method="post">
        <fieldset>

            <div class="control-group">
                <label class="control-label" for="addtname">新添设备</label>
                <br> <br>

                <div class="controls">
                    <input type="text" id="addtname" name="addtname">

                    <p class="help-inline">请输入设备表名</p>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="text" id="addtfield" name="addtfield" placeholder="请输入1到多个字段，以逗号分隔">

                    <span class="help-inline">请输入设备字段</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="deletname">删除设备</label>
                <br> <br>

                <div class="controls">
                    <input type="text" id="deletname" name="deletname">

                    <p class="help-inline">请输入要删除的设备表名</p>
                </div>
            </div>

            <div class="form-actions ">
                <button type="submit" class="btn btn-primary" onclick="return check_form();">更新</button>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="bootstrap.js"></script>

<script>
    function check_form() {
        addtname = document.getElementById("addtname").value;
        addtfield = document.getElementById("addtfield").value;
        deletname = document.getElementById("deletname").value;
        emsg = "";
        if (deletname == "") {
            if (addtname == "") emsg += "设备表名不能为空. \n";
            if (addtfield == "") emsg += "设备表字段名不能为空. \n";
        }
        if (emsg != "") {
            emsg = "------------------------------------------\n\n" + emsg;
            emsg = emsg + "\n------------------------------------------";
            alert(emsg);
            return false;
        } else {
            return true;
        }
    }
</script>
</body>
</html>








