<?php //这是测试的控制器，可以删除。
class WaMessageController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
       $mysqlModel = new WaMessageModel("warehousemessage","pmanage");

        $warehousemessage = $mysqlModel ->WaMessageunionSelectAll();
        //获取下拉的分类
        $pmanage = $mysqlModel ->selectPeople();
        $pmanageJson = json_encode($pmanage);//转换成json并赋值给js后可以直接以数组形式方式。
       $this->assign('warehousemessage', $warehousemessage);
       $this->assign('pmanageJson', $pmanageJson);
    }
}