<?php //这是测试的控制器，可以删除。
class RFIDClassController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $mysqlModel = new Model("rfidclass");
        $RFIDClass = $mysqlModel ->selectAll();
        $this->assign('RFIDClass', $RFIDClass);
    }
}