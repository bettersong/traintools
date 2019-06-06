<?php //这是测试的控制器，可以删除。
class loginController extends Controller
{
    public function index()
    {
       $mysqlModel = new Model("zmanage");
       $Zmanage = $mysqlModel ->unionSelectAll('zManageBranch');
        
       $mysqlModel_bManage = new Model("bmanage");
       $bManage = $mysqlModel_bManage ->selectAll();
       $bManageJson = json_encode($bManage);//转换成json并赋值给js后可以直接以数组形式方式。
        
       $this->assign('Zmanage', $Zmanage);
       $this->assign('bManageJson', $bManageJson);
         
    }
}