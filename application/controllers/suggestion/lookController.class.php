<?php //这是测试的控制器，可以删除。
class lookController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $mysqlModel = new lookModel("message");
        $Allmessage = $mysqlModel -> selectMessageAll(); //查询历史工单
        $this->assign('Allmessage', $Allmessage);
    }
}