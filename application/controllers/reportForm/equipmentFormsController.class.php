<?php //这是测试的控制器，可以删除。
class equipmentFormsController extends Controller
{
	public function index()
    {
        //获取设备表信息
 		$mysqlModel = new Model("equipmentforms");
 		$equipmentForms = $mysqlModel ->selectAll();
        $this->assign('equipmentForms', $equipmentForms);
         
    }
}