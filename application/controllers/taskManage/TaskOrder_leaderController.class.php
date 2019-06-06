<?php //这是测试的控制器，可以删除。
class TaskOrder_leaderController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $mysqlModel1 = new TaskOrder_leaderModel("tworkorder");
        $AllOrder = $mysqlModel1 -> selectHostory($_SESSION['userInfo']['adminBumenId']); //根据主管部门查询该管辖范围内历史工单
        
        
        foreach($AllOrder as $index => $value){
             $AllOrder[$index]['bumenName'] = $_SESSION['bumenArr'][$value['adminBumenId']]['bManageName'];

        }
        $this->assign('AllOrder', $AllOrder);
    }
}