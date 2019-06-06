<?php //这是测试的控制器，可以删除。
class roleInfoController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
   
        //获取下拉的角色
        $mysqlModel_roleInfo = new Model("rolebaseinfo");
        $roleInfoArr = $mysqlModel_roleInfo ->selectAll();
        //print_r($roleInfo);
        $roleInfoJson = json_encode($roleInfoArr);//转换成json并赋值给js后可以直接以数组形式方式。
        $this->assign('roleInfoArr', $roleInfoArr);
        $this->assign('roleInfoJson', $roleInfoJson);

    }
}