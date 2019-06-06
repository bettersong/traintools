<?php //这是测试的控制器，可以删除。
class bmanageController extends Controller
{
    public function index()
    {
        $mysqlModel = new bManageModel("bmanage2");
        $Bmanage = $mysqlModel ->selectAll_bmanage();
        
		//print_r( $Bmanage);
                 
        $this->assign('Bmanage', $Bmanage);
         
    }
}