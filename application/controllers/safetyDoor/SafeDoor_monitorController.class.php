<?php //这是测试的控制器，可以删除。
class SafeDoor_monitorController extends Controller
{
    public function index()
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $mysqlModel = new Model("cecontrol");
        $Cecontrol = $mysqlModel ->query("select * from cecontrol left join pmanage on ceControlMaster=pManageId where ceAdminBumenId in ($myAdminBumensubArrString)");
        $this->assign('Cecontrol', $Cecontrol);
    }
}