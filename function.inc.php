<?php


function multipleExplode($delimiters = array(), $string = '')
{

    $mainDelim = $delimiters[count($delimiters) - 1];

    array_pop($delimiters);

    foreach ($delimiters as $delimiter) {

        $string = str_replace($delimiter, $mainDelim, $string);

    }

    $result = explode($mainDelim, $string);
    return $result;

}

function get_config_info()
{
    $config_info = array();
    $dev_info = array();
    $i = 0;

    $sql = "select * from category";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $config_info[$i]['cat_name'] = $row['栏目名称'];

        $sql1 = "select * from device where 栏目号=" . $row['序号'];
        $res1 = mysql_query($sql1);
        $j = 0;
        while ($dev = mysql_fetch_assoc($res1)) {

            if ($row['序号'] == $dev['栏目号']) {
                $arr = explode('_', $dev['表名']);

                $dev_info[$j]['device_name'] = $arr[1];
                $dev_info[$j]['icon'] = $dev['图标'];
                $dev_info[$j]['period'] = $dev['周期'];
                $delimiters = array(',', '，');
                $device_type = multipleExplode($delimiters, $dev['字段名']);

                $device_unit = multipleExplode($delimiters, $dev['单位']);
                $device_decimal = multipleExplode($delimiters, $dev['小数点']);
                $dev_info[$j]['values'] = $device_type;
                $dev_info[$j]['unit'] = $device_unit;
                $dev_info[$j]['decimal'] = $device_decimal;

                $j++;

            }

        }
        $dev_info = array_slice($dev_info, 0, $j);
        $config_info[$i]['device'] = $dev_info;

        $i++;

    }
    return $config_info;

}

function get_allDevice_data()
{
    $j = 0;
    $datas = array();
    $sql = "select * from device ";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $temp_arr=explode("_",$row["表名"]);
        $datas[$j]['device_name'] =$temp_arr[1];
        $delimiters = array(',', '，');
        $field_arr = multipleExplode($delimiters, $row['字段名']);
        $field_arr = array_unique($field_arr);
        $field_arr[] = "时间";
        $field_arr[] = "坐标X";
        $field_arr[] = "坐标Y";

        foreach ($field_arr as $r) {
            $sql1 = "select  `$r`" . " from " . $row["表名"] . " order by 时间 desc limit 5";
//            echo($sql1);
            $res1 = mysql_query($sql1);
            while ($dev = mysql_fetch_array($res1)) {
                $datas[$j][$r][] = $dev[$r];

            }
        }
        $j++;

    }
    mysql_free_result($res);
    return $datas;

}

?>
