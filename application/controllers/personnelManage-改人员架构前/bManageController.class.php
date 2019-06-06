<?php //这是测试的控制器，可以删除。
class bmanageController extends Controller
{
    public function index()
    {
        $mysqlModel = new Model("bmanage");
        $Bmanage = $mysqlModel ->selectAll();

                 
        $this->assign('Bmanage', $Bmanage);
         
    }
}