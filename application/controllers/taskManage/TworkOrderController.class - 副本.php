<?php //这是测试的控制器，可以删除。
class TworkOrderController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
		global $ism;
		$data['JiHuaDate']= isset($_GET['JiHuaDate'])? $_GET['JiHuaDate']:date('Y-m-d');
        $this->assign('date', $data['JiHuaDate']);	//通过时间判断是历史工单还是今日工单

        $mysqlModel1 = new TworkOrderModel("tworkorder");
        $mysqlModel2 = new Model("toolsform");
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        if($_SESSION['userInfo']['isSuperAdmin']==1){
        	$TworkOrderALL = $mysqlModel1 ->selectByCondition($data);

        }
        else{
        	$TworkOrderALL = $mysqlModel1 ->selectByCondition($data, " and adminBumenId in ($myAdminBumensubArrString) ");
        }
        $TworkOrder = array();
        $ordernum = $_GET['ordernum']==""?0:$_GET['ordernum'];
        $TworkOrder[0] = $TworkOrderALL[$ordernum];

        //查询工具清单
        $mysqlModel_toolInfoAll = new TworkOrderModel("tworkorder_toollists");
        $TworkOrder_toolInfoALL = $mysqlModel_toolInfoAll ->selectAll("where twtlBumenId in ($myAdminBumensubArrString)");
        
        //print_r($TworkOrder_toolInfoALL);
        $this->assign('TworkOrder_toolInfoALL', $TworkOrder_toolInfoALL);//工单的工具清单信息




         //读取工单信息
        foreach ($TworkOrder as $key => $value) {
        	$toolLists = $value['ZhuYaoGJJ'];
        	$toolLists = str_replace(' ', '',$toolLists);
			$toolLists = str_replace('）',')',$toolLists);
			$toolLists = str_replace('（','(',$toolLists);
			$toolListArr[$key] = explode(',', $toolLists);
			$TworkOrder[$key]['toolAmount']=count($toolListArr[$key]);
        }
		if($ism)$TworkOrder[$key]['ZhuTiZYFZR'] = preg_replace('/([0-9]{11,})|([0-9]{3,4}-[0-9]{7,10})|([0-9]{3,4}-[0-9]{2,5}-[0-9]{2,5})/', '<a  style="color:#f30;" href="tel:$1">$1</a>', $TworkOrder[$key]['ZhuTiZYFZR']);
        else $TworkOrder[$key]['ZhuTiZYFZR'] = $TworkOrder[$key]['ZhuTiZYFZR'];
        
        $TworkOrderJson = json_encode($TworkOrder,JSON_UNESCAPED_UNICODE);

		$administrators = array();
		$administrators['ZhuTiZYFZR']['userJobName'] = '主体作业负责人';//主体作业负责人
		$administrators['ZhuTiZYFZR']['userinfo'] = $TworkOrder[0]['ZhuTiZYFZR'];//主体作业负责人
		$administrators['ZhiJianY']['userJobName'] = '质检员';//质检员
		$administrators['ZhiJianY']['userinfo'] = $TworkOrder[0]['ZhiJianY'];//质检员
		$administrators['ZhuZhanFHYuan']['userJobName'] = '驻站防护员';//驻站防护员
		$administrators['ZhuZhanFHYuan']['userinfo'] = $TworkOrder[0]['ZhuZhanFHYuan'];//驻站防护员
		$administrators['GongDiFHY']['userJobName'] = '工地防护员';//工地防护员
		$administrators['GongDiFHY']['userinfo'] = $TworkOrder[0]['GongDiFHY'];//工地防护员
		$administrators['ZhuSuoFHY']['userJobName'] = '驻所防护员';//工地防护员
		$administrators['ZhuSuoFHY']['userinfo'] = $TworkOrder[0]['ZhuSuoFHY'];//驻所防护员
		$TworkOrder_administratorsInfoALL = array();//保存获取人员信息结果
		$mysqlModel_administrators = new TworkOrderModel("pmanage","zmanage","bmanage");
		$i=0;
		foreach($administrators as $index => $userinfoArr){
			
			$userinfo = $userinfoArr['userinfo'];
			$userinfo = str_replace('）',')',$userinfo);
			$userinfo = str_replace('，',',',$userinfo);
			$valArr = explode('(', $userinfo);
			if(count($valArr)>1)$valArr[1]='('.$valArr[1];//补充左括号
			if(count($valArr)<=1)$valArr = explode(',', $userinfo);//如果左括号识别失败，则用尝试用逗号
			$username = $valArr[0];
			$userOrtherInfo = $valArr[1];
			$TworkOrder_administratorsInfo = $mysqlModel_administrators ->unionSelectAll_3('pManagePosition','zManageId','zManageBranch','bManageId', "pmanage.pManageName='".$username."'"," AND adminBumenId in ($myAdminBumensubArrString)");
			//向结果中添加信息
			$TworkOrder_administratorsInfo[0]['userOrtherInfo'] = $userOrtherInfo;
			$TworkOrder_administratorsInfo[0]['userJobName'] = $userinfoArr['userJobName'];
			if($TworkOrder_administratorsInfo[0]['pManageName']=='')$TworkOrder_administratorsInfo[0]['pManageName'] = $username;
			
			//汇总信息
			 $TworkOrder_administratorsInfoALL[$i] = $TworkOrder_administratorsInfo[0];
             $i++;
		}
		
		//遍历今日工单，关联查询，分析工单
	    $mysqlModel3 = new TworkOrderModel("detail,toolslist,rfidclass,warehousemessage");
		
		$mysqlModel1 = new Model("tworkorder_dev");
		
		$data11['twdevNeedInToolbag']= 1;
        $toolbagArr = $mysqlModel1 ->selectByCondition($data11);//selectByCondition($data,$customCondition='')
        $this->assign('toolbagArr', $toolbagArr);

        $mysqlModel4 = new Model("pmanage");
        $mysqlModel5 = new Model("shigongperson");
        $Shigongperson = $mysqlModel5 ->selectAll();
        $name['shigongName'] = $Shigongperson['shigongName'];//施工人员
        $conditions_p = "where  adminBumenId in ($myAdminBumensubArrString)";
        $pmanage = $mysqlModel4 ->selectAll($conditions_p);
		$pmanage1 = $mysqlModel4 ->selectByCondition($name);
        $pmanage1Json = json_encode($pmanage1,JSON_UNESCAPED_UNICODE);
		
        $this->assign('TworkOrderALL', $TworkOrderALL);//今日全部工单信息
        $this->assign('TworkOrder', $TworkOrder);//今日指定的工单信息
        $this->assign('shigongperson', $shigongperson);
        $this->assign('pmanage', $pmanage);//人员信息

        $this->assign('TworkOrderJson', $TworkOrderJson);
		$this->assign('TworkOrder_administratorsInfoALL', $TworkOrder_administratorsInfoALL);//工单的非施工人员信息
        $this->assign('Shigongperson',$Shigongperson);
        $this->assign('pmanage1',$pmanage1);
        $this->assign('pmanage1Json',$pmanage1Json);

        $mysqlModel = new Model("tworkorder_adminstrators");
        $adminstrators = $mysqlModel ->selectAll();
        $this->assign('adminstrators', $adminstrators);

        $mysqlModel = new Model("tworkorder_toollists");
        $toollists = $mysqlModel ->selectAll();
        $this->assign('toollists', $toollists);

        $mysqlModel = new TworkOrderModel("tworkorder_workers","pmanage");
        $workers = $mysqlModel ->unionSelectAll_workers($data['JiHuaDate']);
        $this->assign('workers', $workers);
    }
}