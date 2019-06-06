<?php //这是测试的控制器，可以删除。
class taskPlanDetailController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
    	$twOrderId = $_GET['twOrderId'];
       //selectByCondition($data,$customCondition='')
       $mysqlModel = new Model("tworkorder");
       $data = array();
       $data['twOrderId'] = $twOrderId;
       $orderInfoArr = $mysqlModel->selectByCondition($data,' limit 1');

       $this->assign('twOrderId',$twOrderId);
       $this->assign('orderInfoArr',$orderInfoArr[0]);
    }
}