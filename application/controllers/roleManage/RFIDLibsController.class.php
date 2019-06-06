<?php //这是测试的控制器，可以删除。
class RFIDLibsController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $mysqlModel = new RFIDLibsModel("rfidtag","rfidclass");
        $RFIDLibs = $mysqlModel ->RFIDSelectAll($_SESSION['userInfo']['adminBumenId']);
        $this->assign('RFIDLibs', $RFIDLibs);


        //获取下拉的分类
        $mysqlModel_RFIDClass = new Model("RFIDClass");
        $RFIDClass = $mysqlModel_RFIDClass ->selectAll();
        $RFIDClassJson = json_encode($RFIDClass);//转换成json并赋值给js后可以直接以数组形式方式。
        $this->assign('RFIDClassJson', $RFIDClassJson);

    }
}