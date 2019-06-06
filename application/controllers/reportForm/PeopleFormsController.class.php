<?php //这是测试的控制器，可以删除。
class PeopleFormsController extends Controller
{
	public function index()
    {
        //获取人员表信息
 		$mysqlModel = new Model("peopleforms");
 		$PeopleForms = $mysqlModel ->selectAll();
        $this->assign('PeopleForms', $PeopleForms);
    }
}