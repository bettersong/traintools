<?php 



echo ' 1111111111111 ';



 $x = '115.866318';	

 $y = '28.750057';
 
 $x2 = transformLon($x, $y);
 $y2 = transformLat($x, $y);
 
 echo '<br><br>  精度：'.$x. '  维度：'.$y .'<br>';
 echo '<br><br>  精度：'.$x2. '  维度：'.$y2 .'<br>';
/**
 * gps纠偏算法，适用于google,高德体系的地图
 * @author Administrator
 */
 
 $gps = new GpsOffset();
 $gpsxp = $gps->geoLatLng($y,$x);
 print_r($gpsxp);
    /**
     * gps经纬度修正
     *
     * 功能说明:利用0.01精度校正库offset.dat文件修正中国地图经纬度偏移。
     *         该校正适用于 Google map China, Microsoft map china ,MapABC 等，这些地图构成方法是一样的。
     * 使用方法:
            $gps = new GpsOffset();
            echo $gps->geoLatLng($lat,$lng);
     * 注意: 请在服务器开启offset.dat读取权限
     * @author yanue (yanue@outlook.com)
     * @version 1.0
     * @copyright yanue.net
     * @time 2013-06-30
     */

    class GpsOffset {
        const datMax = 9813675;# 该文件最大数据为9813675条
        private $fp = null;
        /*
         * 构造函数，打开 offset.dat 文件并初始化类中的信息
         * @param string $filename
         * @return null
         */
        function __construct($filename = "offset.dat") {
            if (($this->fp = @fopen($filename, 'rb')) !== false) {
                //注册析构函数，使其在程序执行结束时执行
                register_shutdown_function(array(&$this, '__construct'));
            }
        }

        /*
         * 读取dat文件并查找偏移像素值
         * 说明:
         * dat文件结构:该文件为0.01精度校正数据,并以lng和lat递增形式组合.
         * 其中以8个字节为一组:
         * lng : 2字节经度,如12151表示121.51
         * lat : 2字节纬度,如3130表示31.30
         * x_off : 2字节地图x轴偏移像素值
         * y_off : 2字节地图y轴偏移像素值
         * 因此采用二分法并以lng+lat的值作为条件
         * 注意:请在服务器开启offset.dat读取权限
         *
         */
        private function fromEarthToMars($lat,$lng){
            $tmpLng=intval($lng * 100);
            $tmpLat=intval($lat * 100);
            $left = 0; //开始记录
            $right = self::datMax; //结束记录
            $searchLngLat = $tmpLng.$tmpLat;
            // 采用用二分法来查找查数据
            while($left <= $right){
                $recordCount =(floor(($left+$right)/2))*8; // 取半
                fseek ( $this->fp, $recordCount , SEEK_SET ); // 设置游标
                $c = fread($this->fp,8); // 读8字节
                $lng = unpack('s',substr($c,0,2));
                $lat = unpack('s',substr($c,2,2));
                $x = unpack('s',substr($c,4,2));
                $y = unpack('s',substr($c,6,2));
                $curLngLat=$lng[1].$lat[1];
                if ($curLngLat==$searchLngLat){
                    fclose($this->fp);
                    return array('x'=>$x[1],'y'=>$y[1]);
                    break;
                }else if($curLngLat<$searchLngLat){
                    $left=($recordCount/8) + 1;
                }else if($curLngLat>$searchLngLat){
                    $right=($recordCount/8) - 1;
                }
            }
            fclose($this->fp);
            return false;
        }

        // 转换经纬度到
        public function geoLatLng($lat,$lng){
            $offset =$this->fromEarthToMars($lat,$lng);
            $lngPixel=$this->lngToPixel($lng,18)+$offset['x'];
            $latPixel=$this->latToPixel($lat,18)+$offset['y'];
            $mixLat = $this->pixelToLat($latPixel,18);
            $mixLng = $this->pixelToLng($lngPixel,18);
            return array('lat'=>$mixLat,'lng'=>$mixLng);
        }
        //经度到像素X值
        private function lngToPixel($lng,$zoom) {
            return ($lng+180)*(256<<$zoom)/360;
        }

        //纬度到像素Y值
        private function latToPixel($lat, $zoom) {
            $siny = sin($lat * pi() / 180);
            $y=log((1+$siny)/(1-$siny));
            return (128<<$zoom)*(1-$y/(2*pi()));
        }

        //像素X到经度
        private function pixelToLng($pixelX,$zoom){
            return $pixelX*360/(256<<$zoom)-180;
        }

        //像素Y到纬度
        private function pixelToLat($pixelY, $zoom) {
            $y = 2*pi()*(1-$pixelY /(128 << $zoom));
            $z = pow(M_E, $y);
            $siny = ($z -1)/($z +1);
            return asin($siny) * 180/pi();
        }

        public function __destruct(){
            if($this->fp){
                fclose($this->fp);
            }
            $this->fp = null;
        }
    }
	
	
 
	$pi = 3.14159265358979324;
	$a = 6378245.0;
	$ee = 0.00669342162296594323;
 
	function transform($wgLat, $wgLon, $latlng) {
		if (outOfChina($wgLat, $wgLon)) {
			$latlng[0] = $wgLat;
			$latlng[1] = $wgLon;
			return;
		}
		$dLat = transformLat($wgLon - 105.0, $wgLat - 35.0);
		$dLon = transformLon($wgLon - 105.0, $wgLat - 35.0);
		$radLat = $wgLat / 180.0 * $pi;
		$magic = Math.sin($radLat);
		$magic = 1 - $ee * $magic * $magic;
		$sqrtMagic = Math.sqrt($magic);
		$dLat = ($dLat * 180.0) / (($a * (1 - $ee)) / ($magic * $sqrtMagic) * $pi);
		$dLon = ($dLon * 180.0) / ($a / $sqrtMagic * $Math.cos($radLat) * $pi);
		$latlng[0] = $wgLat + $dLat;
		$latlng[1] = $wgLon + $dLon;
	}
 
	function outOfChina($lat, $lon) {
		if ($lon < 72.004 || $lon > 137.8347)
			return true;
		if ($lat < 0.8293 || $lat > 55.8271)
			return true;
		return false;
	}
 
	function transformLat($x, $y) {
		$ret = -100.0 + 2.0 * $x + 3.0 * $y + 0.2 * $y * $y + 0.1 * $x * $y + 0.2 * Math.sqrt(Math.abs($x));
		$ret += (20.0 * Math.sin(6.0 * $x * $pi) + 20.0 * Math.sin(2.0 * $x * $pi)) * 2.0 / 3.0;
		$ret += (20.0 * Math.sin($y * $pi) + 40.0 * Math.sin($y / 3.0 * $pi)) * 2.0 / 3.0;
		$ret += (160.0 * Math.sin($y / 12.0 * $pi) + 320 * Math.sin($y * pi / 30.0)) * 2.0 / 3.0;
		return $ret;
	}
 
	function transformLon($x, $y) {
		$ret = 300.0 + $x + 2.0 * $y + 0.1 * $x * $x + 0.1 * $x * $y + 0.1 * Math.sqrt(Math.abs($x));
		$ret += (20.0 * Math.sin(6.0 * $x * $pi) + 20.0 * Math.sin(2.0 * $x * $pi)) * 2.0 / 3.0;
		$ret += (20.0 * Math.sin($x * $pi) + 40.0 * Math.sin($x / 3.0 * $pi)) * 2.0 / 3.0;
		$ret += (150.0 * Math.sin($x / 12.0 * $pi) + 300.0 * Math.sin($x / 30.0 * $pi)) * 2.0 / 3.0;
		return $ret;
	}
 



?>

<div style="margin:0 0 500px;"> &nbsp; </div>
