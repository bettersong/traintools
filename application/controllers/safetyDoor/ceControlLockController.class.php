<?php //这是测试的控制器，可以删除。
class ceControlLockController extends Controller
{
    public function index()
    {
        $mysqlModel = new ceControlLockModel("cecontrollock");
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "WHERE adminBumenId IN  ($myAdminBumensubArrString)";
        $CecontrolLock = $mysqlModel ->selectAll($sql);
        $this->assign('CecontrolLock', $CecontrolLock);
    }
}