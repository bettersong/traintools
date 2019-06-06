<?php //这是测试的控制器，可以删除。
class myController extends Controller
{
	public function index()
    {
 		$mysqlModel = new Model("historysign");
 		$Hsign = $mysqlModel ->selectAll();
        $this->assign('Hsign', $Hsign);
    }
}