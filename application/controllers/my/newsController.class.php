<?php //这是测试的控制器，可以删除。
class newsController extends Controller
{
    public function index()
    {
        //$informType = 1;
        $mysqlModel = new NewsModel("inform");
        $News = $mysqlModel ->selectAll(); 
        $this->assign('News', $News);
        //print_r(111);
    }
    public function index_detail()
    {
        $informId = $_GET['informId'];
        $mysqlModel = new NewsModel("inform","pmanage");
        $News_detail = $mysqlModel ->unionSelectAll_detail('informPublisher','pManageId',$informId);
        $this->assign('News_detail', $News_detail[0]);
        //echo($informId);
        //print_r($News_detail[0]);
        //print_r(111);
    }
}