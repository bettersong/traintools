<?php //这是测试的控制器，可以删除。
class CemanageController extends Controller
{
    public function index()
    {
        $mysqlModel = new Model("cemanage");
        $Cemanage = $mysqlModel ->selectAll();
        $this->assign('Cemanage', $Cemanage);
        

    }
}