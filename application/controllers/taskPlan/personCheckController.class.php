<?php //这是测试的控制器，可以删除。
class personCheckController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
    	$twOrderId = $_GET['twOrderId'];
        //获取核心人员
        $mysqlModel_order = new personCheckModel("pmanage");
        $personArr = $mysqlModel_order ->select_person($twOrderId);
        $this->assign('personArr',$personArr);

        //获取施工人员
        $mysqlModel_builders = new personCheckModel("pmanage_builders");
        $buildersArr = $mysqlModel_builders ->select_builders($twOrderId);
        
        $this->assign('buildersArr',$buildersArr);

        //提供下拉的全部施工人员
        $buildersAllArr = $mysqlModel_builders ->select_allBuilders($twOrderId);
        $buildersAllJson = json_encode($buildersAllArr);
        $this->assign('buildersAllJson',$buildersAllJson);
        //print_r($buildersAllArr);

        //提供下拉的全部核心人员
        $adminArr = $mysqlModel_order ->select_admin();
        $adminArrJson = json_encode($adminArr);
        $this->assign('adminArrJson',$adminArrJson);
        
        $GPSLocate = $mysqlModel_order ->select_GPSLocate();
        $GPSLocateJson = json_encode($GPSLocate);
        $this->assign('GPSLocateJson',$GPSLocateJson);

         //获取工单信息
         $orderInfoArr = $mysqlModel_order -> query("select * from tworkorder where twOrderId=$twOrderId ");
         $this->assign('orderInfoArr',$orderInfoArr[0]);
    }
}