<?php //这是测试的控制器，可以删除。
class TworkOrderController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
    	//通过时间判断是历史工单还是今日工单
		$data['JiHuaDate']= isset($_GET['JiHuaDate'])? $_GET['JiHuaDate']:date('Y-m-d');
        $this->assign('date', $data['JiHuaDate']);

        //获取今日全部工单
        $mysqlModel_order = new TworkOrderModel("tworkorder");
        $TworkOrderALL = $mysqlModel_order ->selectByCondition($data);
        $this->assign('TworkOrderALL',$TworkOrderALL); 
 
        //获取指定工单
        $ordernum = $_GET['ordernum']==""?0:$_GET['ordernum'];
        $TworkOrder = $TworkOrderALL[$ordernum];
        $this->assign('TworkOrder',$TworkOrder);
        $TworkOrderJson = json_encode($TworkOrder);
        $this->assign('TworkOrderJson',$TworkOrderJson);

        $TworkOrderID = $TworkOrder['twOrderId'];	//获取工单号提供给下面查询时使用
        //获取工单工具列表
        $mysqlModel_toollists = new TworkOrderModel("tworkorder_toollists");
        $TworkOrder_toolInfoALL = $mysqlModel_toollists ->selectAll_toolList($TworkOrderID);
        //获取仓库工具库存和人员信息
        foreach ($TworkOrder_toolInfoALL as $key => $value) {
        	$toolId = $value['twtlToolId'];
        	$tmp = $mysqlModel_toollists ->toolList_warehouse($toolId);
        	$TworkOrder_toolInfoALL[$key]['waMessageName'] = '';
        	foreach (array_reverse($tmp) as $tmp_key => $tmp_value) { //逆向遍历数组
        		if (strpos($TworkOrder_toolInfoALL[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
        			$TworkOrder_toolInfoALL[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
        			$TworkOrder_toolInfoALL[$key]['waMessageName'] = ltrim($TworkOrder_toolInfoALL[$key]['waMessageName'], ","); //去除最前端逗号
        		}
        	}
        } 
        
        $this->assign('TworkOrder_toolInfoALL',$TworkOrder_toolInfoALL);

        //查询所有人员以供安排
        $mysqlModel_pmanage = new TworkOrderModel("pmanage");
        $pmanage = $mysqlModel_pmanage ->selectAll_pmanage();
        $this->assign('pmanage',$pmanage);

        //获取工单核心人员列表
        $mysqlModel_administrators = new TworkOrderModel("tworkorder_adminstrators");
        $TworkOrder_administratorsInfoALL = $mysqlModel_administrators ->selectAll_administrators($TworkOrderID);
        $this->assign('TworkOrder_administratorsInfoALL',$TworkOrder_administratorsInfoALL);

        
        //获取施工人员列表
        $mysqlModel_works = new TworkOrderModel("tworkorder_workers");
        $workers = $mysqlModel_works ->selectAll_workers($TworkOrderID);
        $this->assign('workers',$workers);
    }
	
	 public function taskOrder_leader()
    {
		$data['twOrderId']= $_GET['twOrderId'];

        //获取今日全部工单
        $mysqlModel_order = new TworkOrderModel("tworkorder");
        $TworkOrderALL = $mysqlModel_order ->selectByCondition($data);
        $this->assign('TworkOrderALL',$TworkOrderALL); 

        //获取指定工单
        $ordernum = $_GET['ordernum']==""?0:$_GET['ordernum'];
        $TworkOrder = $TworkOrderALL[$ordernum];
        $this->assign('TworkOrder',$TworkOrder);
        $TworkOrderJson = json_encode($TworkOrder);
        $this->assign('TworkOrderJson',$TworkOrderJson);

        $TworkOrderID = $TworkOrder['twOrderId'];	//获取工单号提供给下面查询时使用

        //获取工单工具列表
        $mysqlModel_toollists = new TworkOrderModel("tworkorder_toollists");
        $TworkOrder_toolInfoALL = $mysqlModel_toollists ->selectAll_toolList($TworkOrderID);
        //获取仓库工具库存和人员信息
        foreach ($TworkOrder_toolInfoALL as $key => $value) {
        	$toolId = $value['twtlToolId'];
        	$tmp = $mysqlModel_toollists ->toolList_warehouse($toolId);
        	$TworkOrder_toolInfoALL[$key]['waMessageName'] = '';
        	foreach ($tmp as $tmp_key => $tmp_value) { //逆向遍历数组
        		if (strpos($TworkOrder_toolInfoALL[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
        			$TworkOrder_toolInfoALL[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
        			$TworkOrder_toolInfoALL[$key]['waMessageName'] = ltrim($TworkOrder_toolInfoALL[$key]['waMessageName'], ","); //去除最前端逗号
        		}
        	}
        }
        $this->assign('TworkOrder_toolInfoALL',$TworkOrder_toolInfoALL);

        //查询所有人员以供安排
        $mysqlModel_pmanage = new TworkOrderModel("pmanage");
        $pmanage = $mysqlModel_pmanage ->selectAll_pmanage();
        $this->assign('pmanage',$pmanage);

        //获取工单核心人员列表
        $mysqlModel_administrators = new TworkOrderModel("tworkorder_adminstrators");
        $TworkOrder_administratorsInfoALL = $mysqlModel_administrators ->selectAll_administrators($TworkOrderID);
        $this->assign('TworkOrder_administratorsInfoALL',$TworkOrder_administratorsInfoALL);

        //获取施工人员列表
        $mysqlModel_works = new TworkOrderModel("tworkorder_workers");
        $workers = $mysqlModel_works ->selectAll_workers($TworkOrderID);
        $this->assign('workers',$workers);
		
	 }
	 
        public function setOrder()
    {
           //通过时间判断是历史工单还是今日工单
        $data['JiHuaDate']= isset($_GET['JiHuaDate'])? $_GET['JiHuaDate']:date('Y-m-d');
        $this->assign('date', $data['JiHuaDate']);

        //获取今日全部工单
        $mysqlModel_order = new TworkOrderModel("tworkorder");
        $TworkOrderALL = $mysqlModel_order ->selectByCondition($data);
        $this->assign('TworkOrderALL',$TworkOrderALL); 

        //获取指定工单
        $ordernum = $_GET['ordernum']==""?0:$_GET['ordernum'];
        $TworkOrder = $TworkOrderALL[$ordernum];
        $this->assign('TworkOrder',$TworkOrder);
        //print_r($TworkOrder);
        $TworkOrderJson = json_encode($TworkOrder);
        $this->assign('TworkOrderJson',$TworkOrderJson);

        $TworkOrderID = $TworkOrder['twOrderId'];   //获取工单号提供给下面查询时使用

        //获取工单工具列表
        $mysqlModel_toollists = new TworkOrderModel("tworkorder_toollists");
        $TworkOrder_toolInfoALL = $mysqlModel_toollists ->selectAll_toolList($TworkOrderID);
        


        //获取仓库工具库存和人员信息
        foreach ($TworkOrder_toolInfoALL as $key => $value) {
            $toolId = $value['twtlToolId'];
            $tmp = $mysqlModel_toollists ->toolList_warehouse($toolId);
            //echo $value['twtlName'] ; print_r($tmp);
            $TworkOrder_toolInfoALL[$key]['waMessageName'] = '';
            foreach (array_reverse($tmp) as $tmp_key => $tmp_value) { //逆向遍历数组
                if (strpos($TworkOrder_toolInfoALL[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
                    $TworkOrder_toolInfoALL[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
                    $TworkOrder_toolInfoALL[$key]['waMessageName'] = ltrim($TworkOrder_toolInfoALL[$key]['waMessageName'], ","); //去除最前端逗号
                }
            }
        }

        $this->assign('TworkOrder_toolInfoALL',$TworkOrder_toolInfoALL);

        //查询所有施工人员以供安排
        $mysqlModel_pmanage = new TworkOrderModel("pmanage_builders");
        $pmanage_builders = $mysqlModel_pmanage ->selectAll_pmanage_builders();
        $this->assign('pmanage_builders',$pmanage_builders);

        //获取工单核心人员列表
        $mysqlModel_administrators = new TworkOrderModel("tworkorder_adminstrators");
        $TworkOrder_administratorsInfoALL = $mysqlModel_administrators ->selectAll_administrators($TworkOrderID);
        $this->assign('TworkOrder_administratorsInfoALL',$TworkOrder_administratorsInfoALL);

        $personAll = $mysqlModel_administrators->selectAll_pmanage();
        $pmanageAllJson = json_encode($personAll);
        $this->assign('pmanageAllJson',$pmanageAllJson);

        //获取施工人员列表
        $mysqlModel_works = new TworkOrderModel("tworkorder_workers");
        $workers = $mysqlModel_works ->selectAll_workers($TworkOrderID);
        $this->assign('workers',$workers);

        //获取所有工具类别
        $toolList = $mysqlModel_toollists->selectAll_tool();
        $toolListJson = json_encode($toolList);
        $this->assign('toolListJson',$toolListJson);

        //获取全部安全门列表信息
        //$mysqlModel_order = new TworkOrderModel("tworkorder");
        $safeDoorListArr = $mysqlModel_order->query("select * from cecontrol");
         $this->assign('safeDoorListArr',$safeDoorListArr);
        
     }
	public function taskOrder_lockingPlan()
    {
		 //通过时间判断是历史工单还是今日工单
		$data['JiHuaDate']= isset($_GET['JiHuaDate'])? $_GET['JiHuaDate']:date('Y-m-d');
        $this->assign('date', $data['JiHuaDate']);
       //print_r($data['JiHuaDate']);
        //获取今日全部工单
        $mysqlModel_order = new TworkOrderModel("tworkorder");
        $TworkOrderALL = $mysqlModel_order ->selectByCondition($data);
		//print_r($TworkOrderALL);
        $this->assign('TworkOrderALL',$TworkOrderALL); 
	}
}