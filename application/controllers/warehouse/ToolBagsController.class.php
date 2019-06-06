<?php //这是测试的控制器，可以删除。
class ToolBagsController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
	public function index()
    {	
 		$mysqlModel = new ToolBagsModel("tm_tool_bag");
 		$ToolBags = $mysqlModel ->selectAll_Bags();
        $this->assign('ToolBags', $ToolBags);

        //仓库信息
        $mysqlModel_warehousemessage = new Model("warehousemessage");
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $conditions_w = "where  waMessageAdmin in ($myAdminBumensubArrString)";
        $warehousemessage = $mysqlModel_warehousemessage ->selectAll($conditions_w);
        $warehousemessageJson = json_encode($warehousemessage);
        $this->assign('warehousemessageJson', $warehousemessageJson);

        //定位器
        $mysqlModel_locator = new ToolBagsModel("gpslibs");
        $locatorArr = $mysqlModel_locator ->select_gps($conditions_l);
        $locatorArrJson = json_encode($locatorArr);
        $this->assign('locatorArrJson', $locatorArrJson);
    } 
}