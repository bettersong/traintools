<?php //这是测试的控制器，可以删除。
class personToolsCheckOutController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $data['JiHuaDate'] = date('Y-m-d');
        $mysqlModel_order = new taskPlanModel("tworkorder");
        $TworkOrderALL = $mysqlModel_order ->selectByCondition($data);
        $this->assign('TworkOrderALL',$TworkOrderALL);

        //$this->assign('AllOrder', $AllOrder);
    }
}