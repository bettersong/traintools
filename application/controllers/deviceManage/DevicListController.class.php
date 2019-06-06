<?php //这是测试的控制器，可以删除。
class DevicListController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        //联合查询：查询设备列表及对应的分类
        $mysqlModel = new DevicClassModel("deviclist","devicclass");
        $deviceCatlogs = $mysqlModel ->unionSelectAll('deListType','deClassId');

		    $mysqlModel_deviceClass = new DevicClassModel("devicclass");
        $deviceClass = $mysqlModel_deviceClass ->selectAll();
		    $deviceClassJson = json_encode($deviceClass);//转换成json并赋值给js后可以直接以数组形式方式。
		
        $this->assign('deviceCatlogs', $deviceCatlogs);
	      $this->assign('deviceClassJson', $deviceClassJson);
    }
}