<?php //这是测试的控制器，可以删除。
class ReportFormsController extends Controller
{
	public function index()
    {
 		$mysqlModel = new Model("reportforms");
 		$ReportForms = $mysqlModel ->selectAll(); 
        $this->assign('ReportForms', $ReportForms);
    }
}