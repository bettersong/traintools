<?php //这是测试的控制器，可以删除。
class GPSLibsController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $mysqlModel = new GPSLibsModel("GPSLibs");
        $GPSLibs = $mysqlModel -> GPSSelectAll($_SESSION['userInfo']['adminBumenId']);
        $this->assign('GPSLibs', $GPSLibs);
        //print_r($GPSLibs);


        //获取下拉的分类
        $mysqlModel_GPSClass = new Model("GPSClass");
        $GPSClass = $mysqlModel_GPSClass ->selectAll();
        $GPSClassJson = json_encode($GPSClass);//转换成json并赋值给js后可以直接以数组形式方式。
        $this->assign('GPSClassJson', $GPSClassJson);

    }
}