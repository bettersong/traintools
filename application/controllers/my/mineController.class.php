<?php //这是测试的控制器，可以删除。
class mineController extends Controller
{
    public function index()
    {
    	$userId = $_SESSION['userInfo']['pManageId'];
    	$mysqlModel = new myinformationModel("Pmanage","zmanage","bmanage"); 
        $myinformation = $mysqlModel ->unionSelectAll_information($userId);
        $this->assign('myinformation', $myinformation[0]);
       // print_r($userId);
    }
}