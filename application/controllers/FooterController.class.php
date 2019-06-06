<?php //这是测试的控制器，可以删除。
class FooterController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index() 
    {
        $today = date('Y-m-d');
        $data['JiHuaDate'] =  $today;
        $mysqlModel_order = new taskPlanModel("tworkorder");

        //print_r($_SESSION['userInfo']);
        $userName = $_SESSION['userInfo']['pManageName'];
        $customCondition = " and ZhuTiZYFZR like '$userName' ";

        $roleEnName = $_SESSION['userInfo']['roleEnName'];
        //echo ' roleEnName:'.$roleEnName;
        $TworkOrderALL = array();
        //只有负责人可以看今日工单
        if( $roleEnName =="taskorder_charge" ){//负责人
            $TworkOrderALL = $mysqlModel_order ->query("select * from `tworkorder` where JiHuaDate='$today'  and ZhuTiZYFZR like '%$userName%'  ");//selectByCondition($data,$customCondition);
        }
        //管理员及领导
        else if( $roleEnName =="leader_commom" || $roleEnName =="admin_leve1" || $roleEnName =="admin_leve2" || $roleEnName =="admin_leve3"  ){
            //$TworkOrderALL = $mysqlModel_order ->query("select * from `tworkorder` where JiHuaDate='$today' ");//selectByCondition($data,$customCondition);
        }

        
        $this->assign('TworkOrderALL',$TworkOrderALL);
    }
}