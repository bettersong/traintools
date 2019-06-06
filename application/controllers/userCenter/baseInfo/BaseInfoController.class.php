<?php //这是测试的控制器，可以删除。
class BaseInfoController extends Controller
{
    public function updateInfo()
    {
		
		
		
	/*	$data['pManageName'] = "李四";//$userName;
$data['pManagePassword'] = "123456";//$password;
//$data['applyPass'] = 1;
$mysqlModel = new Model('Pmanage');
//$res返回的是一个二维数组
$res1 = $mysqlModel->selectByCondition($data,' limit 1');
$pManageId =  $res1[0]['pManageId'];

print_r($res1);  
		//$getUnitModel =  new Model('department','unit','province');
	//$result = $getUnitModel->unionSelectAll_3('depUnitId','unitId','unitProvinceId','provinceId',' departmentId = '.$departmentId);
	//unionSelectAll_3($field_table1,$field_table2,$field2_table2='',$field_table3='',$customCondition='')
	$getUnitModel =  new Model('Pmanage','zmanage','bmanage');
	 
	$res = $getUnitModel->unionSelectAll_3('pManagePosition','zManageId','zManageBranch','bManageId',' pManageId = '.$pManageId);
	echo "3333333: ";
	$_SESSION['userInfo'] = $res[0];
	
	print_r($_SESSION['userInfo']);
	exit;*/
		//print_r(111111111111);
		$mysqlModel1 = new Model("bmanage");
		$bmanageArr = $mysqlModel1 ->selectAll();
		
		
		$mysqlModel2 = new Model("Pmanage");
		$pmanageArr = $mysqlModel2 ->selectAll();
		foreach($bmanageArr as $key2 => $val2){
			
			 $bmanageArr[$key2]['personCount'] = 0;

		}
		foreach($pmanageArr as $key1 => $val1){
			
			foreach($bmanageArr as $key2 => $val2){
			
			    if($val1['pManageBranch']==$val2['bManageId'])$bmanageArr[$key2]['personCount']++;

		    }
		}
		$pmanageChartArr = array();
		foreach($bmanageArr as $key => $val){
			 
			 $pmanageChartArr[$key]['name'] = $val['bManageBranch'];
			 $pmanageChartArr[$key]['value'] = $val['personCount'];

		}
		$pmanageChartArr = json_encode($pmanageChartArr);
		$this->assign('pmanageChartArr', $pmanageChartArr);

		$mysqlModel = new Model("inform");
 		$news_mount = count($mysqlModel ->selectAll());
 		//print_r($news_mount);
        $this->assign('news_mount', $news_mount);

        $data['JiHuaDate'] = date('Y-m-d');
        $mysqlModel1 = new Model("tworkorder");
        $TworkOrder = $mysqlModel1 ->selectByCondition($data);
        $Tworkorder_mount = count($TworkOrder);
        $this->assign('Tworkorder_mount', $Tworkorder_mount);
		
		$mysqlMode_countdev = new Model("tworkorder_dev");
		$tworkorderDev_mount = $mysqlMode_countdev ->selectRowCount();
		$this->assign('tworkorderDev_mount', $tworkorderDev_mount);
		$tworkorderDev_in_mount = $mysqlMode_countdev ->selectRowCount(""," where twdevStatus_out=1 or twdevStatus_in=1");
		$this->assign('tworkorderDev_in_mount', $tworkorderDev_in_mount);
		 
		$tworkorderToolbag_mount = $mysqlMode_countdev ->selectRowCount("","where twdevNeedInToolbag=1");
		$this->assign('tworkorderToolbag_mount', $tworkorderToolbag_mount);
		
		$tworkorderToolbag_in_mount = $mysqlMode_countdev ->selectRowCount("","where twdevNeedInToolbag=1 and twdevInToolbag=1");
		$this->assign('tworkorderToolbag_in_mount', $tworkorderToolbag_in_mount);
		
    }
}