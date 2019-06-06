<?php  
 


 //测试数据
$lng = '115.863197';
$lat = '28.749359';

 

$realGPS = transform($lat, $lng);//纠偏后经纬度-数组形式

$realLat = $realGPS[0];//纠偏后的纬度
$realLng = $realGPS[1];//纠偏后的经度


echo '纠偏前：'.$lng.'  '.$lat.'<br>';
echo '纠偏后：'.$realLng.'  '.$realLat.'<br><br>';

 
 

/**
 * 功能：经纬度纠偏
 * 应用示例：
   $lng = '115.866318';//参数：经度
   $lat = '28.750057';//参数：纬度
   $realGPS = transform($lat, $lng);//纠偏后经纬度-数组形式
   $realLat = $realGPS[0];//纠偏后的纬度
   $realLng = $realGPS[1];//纠偏后的经度
*/  
//主函数：返回纠偏后的经纬度，传入参数$wgLat：纬度，$wgLon：经度
function transform($wgLat, $wgLon) { 
    $pi = 3.14159265358979324;
    $a = 6378245.0;
    $ee = 0.00669342162296594323;
    
    $latlng = array();
    $latlon= array();
    if (outOfChina($wgLat, $wgLon)) { 
        $latlng[0] = $wgLat;
        $latlng[1] = $wgLon;
        $latlon=$latlng;
        return $latlon;
    } 
    $dLat = transformLat($wgLon - 105.0, $wgLat - 35.0);
    $dLon = transformLon($wgLon - 105.0, $wgLat - 35.0);
    $radLat = $wgLat / 180.0 * $pi;
    $magic = sin($radLat);
    $magic = 1 - $ee * $magic * $magic;
    $sqrtMagic = sqrt($magic);

    $dLat = ($dLat * 180.0) / (($a * (1 - $ee)) / ($magic * $sqrtMagic) * $pi);
    $dLon = ($dLon * 180.0) / ($a / $sqrtMagic * cos($radLat) * $pi);
    $latlng[0] = $wgLat + $dLat;
    $latlng[1] = $wgLon + $dLon;
    $latlon=$latlng;
    return $latlon;
 }
 //是否在国内    
 function outOfChina($lat, $lon) { 
     
    if ($lon < 72.004 || $lon > 137.8347) return true;
    if ($lat < 0.8293 || $lat > 55.8271) return true;
    return false;
 }
//辅助-转换纬度
 function transformLat($x, $y) { 
     
    $pi = 3.14159265358979324;
    $a = 6378245.0;
    $ee = 0.00669342162296594323;

    $ret = -100.0 + 2.0 * $x + 3.0 * $y + 0.2 * $y * $y + 0.1 * $x * $y + 0.2 * sqrt(abs($x));
    $ret += (20.0 * sin(6.0 * $x * $pi) + 20.0 * sin(2.0 * $x * $pi)) * 2.0 / 3.0;
    $ret += (20.0 * sin($y * $pi) + 40.0 * sin($y / 3.0 * $pi)) * 2.0 / 3.0;
    $ret += (160.0 * sin($y / 12.0 * $pi) + 320 * sin($y * $pi / 30.0)) * 2.0 / 3.0;
    return $ret;
 }
         
//辅助-转换经度
 function transformLon($x, $y) { 
    $pi = 3.14159265358979324;
    $a = 6378245.0;
    $ee = 0.00669342162296594323;

    $ret = 300.0 + $x + 2.0 * $y + 0.1 * $x * $x + 0.1 * $x * $y + 0.1 * sqrt(abs($x));
   

    $ret += (20.0 * sin(6.0 * $x * $pi) + 20.0 * sin(2.0 * $x * $pi)) * 2.0 / 3.0;
    $ret += (20.0 * sin($x * $pi) + 40.0 * sin($x / 3.0 * $pi)) * 2.0 / 3.0;
    $ret += (150.0 * sin($x / 12.0 * $pi) + 300.0 * sin($x / 30.0 * $pi)) * 2.0 / 3.0;
    return $ret;
 }
 //end 经纬度纠偏