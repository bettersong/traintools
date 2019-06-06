<?php //这是测试的控制器，可以删除。
class DevicClassController extends Controller
{
	public function index()
    {
		
 		$mysqlModel = new DevicClassModel("devicclass");
 		$devicClassLists = $mysqlModel ->selectAll();

        $this->assign('title', '全部条目33');
        $this->assign('devicClassLists', $devicClassLists);
         
    }
}