<?php //这是测试的控制器，可以删除。
class mySignController extends Controller
{
    public function index()
    {   
    	$userId = $_SESSION['userInfo']['pManageId'];
    	$mysqlModel = new mySignModel("tworkorder_adminstrators");
        $my_attendance = $mysqlModel -> attendance($_SESSION['userInfo']['pManageId']);
        $this->assign('my_attendance', $my_attendance[0]);
        //print_r($userId);
    }
}