<?php //这是测试的控制器，可以删除。
class myNewsController extends Controller
{
    public function index()
    {
    	$informType = 1;
    	$mysqlModel = new myNewsModel("inform");
 		$myNews = $mysqlModel ->select_id($informType,'informType');
        $this->assign('myNews', $myNews);
    }
    public function index_detail()
    {
    	$safetyId = $_GET['informId'];
    	$mysqlModel = new myNewsModel("inform","pmanage");
 		$myNews_detail = $mysqlModel ->unionSelectAll_detail('informPublisher','pManageId',$informId);
        $this->assign('myNews_detail', $myNews_detail[0]);
        
    }
}