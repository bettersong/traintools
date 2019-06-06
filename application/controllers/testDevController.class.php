<?php //这是测试的控制器，可以删除。
class testDevController extends Controller
{
    public function index()
    {
		
		if($_GET['action']=='testToolbag'){
			
			$mysqlModel = new testDevModel();//"tworkorder_toollists,toolslist"
			
			$res = $mysqlModel->testToolbag();
			
			
			
			 
			
			
			
			
			
			
		}
		
	 
    }
}