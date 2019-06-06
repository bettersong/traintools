<?php //这是测试的控制器，可以删除。
class taskSummaryController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        
        $twOrderId = $_GET['twOrderId'];
        
        $mysqlModel = new taskSummaryModel("");
        
        //工单信息
        $OrderInfo = $mysqlModel->selectOrder($twOrderId);
        //$OrderInfo = json_encode($OrderInfo);
        $this->assign("OrderInfo",$OrderInfo);
        $this->assign("orderInfoArr",$OrderInfo[0]);

        //核心人员
        $admin = $mysqlModel->selectAdmins($twOrderId);
        //$admin = json_encode($admin);
        $this->assign("admin",$admin);

        //施工负责人
        $worker = $mysqlModel->selectWorkers($twOrderId);
        //$worker = json_encode($worker);
        $this->assign("worker",$worker);

        //小工具
        $smallTools = $mysqlModel->selectSmallTools($twOrderId);
        //$smallTools = json_encode($smallTools);
        $this->assign("smallTools",$smallTools);
        
        //大工具
        $bigTools = $mysqlModel->selectBigTools($twOrderId);
        //$bigTools = json_encode($bigTools);
        $this->assign("bigTools",$bigTools);

        //现场照片
        $photos = $mysqlModel->selectPhotos($twOrderId);
        //$photos = json_encode($photos);
        $this->assign("photos",$photos);
    }
    public function summary_history()
    {
        
        $twOrderId = $_GET['twOrderId'];
        
        $mysqlModel = new Model("tworkorder_summary");

        $data['twsmIdWorkOrderId'] =$twOrderId;
        $summaryArr = $mysqlModel ->selectByCondition($data);
        $this->assign('summaryArr',$summaryArr[0]);
       
        $mysqlModel1 = new Model("picture_now");
        $sql_condition = " where pictureTwOrderId = $twOrderId";
        $pictureArr = $mysqlModel1->selectAll($sql_condition);
        $this->assign('pictureArr',$pictureArr);
    }
}