<?php //这是测试的控制器，可以删除。
class safetyController extends Controller
{
    public function index()
    {
    	$mysqlModel = new safetyModel("safety_disclosure");
 		$safe_report = $mysqlModel ->selectByCondition(""," order by safetyPublishTime desc" );//SelectAll();
        $this->assign('safe_report', $safe_report);
         // echo(11);
        //print_r($safe_report);

    }
    public function index_detail()
    {
        $safetyId = $_GET['safetyId'];
        $mysqlModel = new safetyModel("safety_disclosure","pmanage");
        $safe_detail = $mysqlModel ->unionSelectAll_detail('safetyPublisher','pManageId',$safetyId);
        $this->assign('safe_detail', $safe_detail);
        //print_r($safetyId);
        //print_r(111);
    }
    

}