<?php //这是测试的控制器，可以删除。
class CecontrolController extends Controller
{
    public function index()
    {
        $mysqlModel = new Model("cecontrol");
        $Cecontrol = $mysqlModel ->selectAll();   
        $this->assign('Cecontrol', $Cecontrol);
    }
    public function baseInfo()
    {
        $mysqlModel = new CecontrolModel("cecontrol");


        $Cecontrol = $mysqlModel ->safeDoor_information();  //安全门信息查询
        $this->assign('Cecontrol', $Cecontrol);
        //print_r($Cecontrol);


        $Cecontrollock = $mysqlModel ->safeLock_information();  //安全锁信息查询
        $CecontrollockJson = json_encode($Cecontrollock);
        $this->assign('CecontrollockJson', $CecontrollockJson);


        $person = $mysqlModel -> person_information();      //人员信息查询
        $personJson = json_encode($person);
        $this->assign('personJson',$personJson);
        
    }

    public function history()
    {
        $mysqlModel = new Model("cecontrol");
        $sql = "left join pmanage on ceControlMaster = pManageId";
        $Cecontrol = $mysqlModel ->selectAll($sql);
        $this->assign('Cecontrol', $Cecontrol);
    }
}