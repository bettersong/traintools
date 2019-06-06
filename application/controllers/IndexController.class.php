<?php //这是测试的控制器，可以删除。
class IndexController extends Controller
{
    public function index()
    {
		global $ism;
		if($ism){
			return false;
		}
		$mysqlModel1 = new IndexModel("bmanage");
		$bmanageArr = $mysqlModel1 ->selectAll();
		
		$mysqlModel2 = new IndexModel("Pmanage");
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

		$mysqlModel = new IndexModel("inform");
 		$news_mount = count($mysqlModel ->selectAll());
        $this->assign('news_mount', $news_mount);

        $data['JiHuaDate'] = date('Y-m-d');
        $mysqlModel1 = new IndexModel("tworkorder");
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
		
		$mysqlModel = new Model("gpslibs");
 		$gpslibs = $mysqlModel ->selectAll();
 		//print_r($news_mount);
        $this->assign('gpslibs', $gpslibs);
    }
}