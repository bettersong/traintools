<?php //这是测试的控制器，可以删除。
class jmanageController extends Controller
{
    public function index()
    {
        $mysqlModel = new bManageModel("bmanage2");
        $Bmanage = $mysqlModel ->selectAll_bmanage();
       
		 //获取下拉的角色
		 $mysqlModel_roleInfo = new Model("rolebaseinfo");
		 $roleInfoArr = $mysqlModel_roleInfo ->selectAll();
		 //print_r($roleInfoArr);
		 $roleInfoJson = json_encode($roleInfoArr);//转换成json并赋值给js后可以直接以数组形式方式。
		 $this->assign('roleInfoArr', $roleInfoArr);
		 $this->assign('roleInfoJson', $roleInfoJson);

                 
        $this->assign('Bmanage', $Bmanage);
         
    }
}