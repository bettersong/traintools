<?php //这是测试的控制器，可以删除。
class personToolsCheckInController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        // $data['JiHuaDate'] = date('Y-m-d');
        // $mysqlModel_order = new taskPlanModel("tworkorder");
        // $TworkOrderALL = $mysqlModel_order ->selectByCondition($data);
        // $this->assign('TworkOrderALL',$TworkOrderALL);

        /*【表】
        工单-工具列表-tworkorder_toollists： 工具包ID
        工具包表-tm_tool_bag：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist：工具类别名称 
        //$this->assign('AllOrder', $AllOrder);

        */

        $twOrderId = $_GET['twOrderId'];
        $mysqlModel = new personToolsCheckInModel("");
        
         //获取工单信息
         $orderInfoArr = $mysqlModel -> query("select * from tworkorder where twOrderId=$twOrderId ");
         $this->assign('orderInfoArr',$orderInfoArr[0]);
        //小工具清点：从工具包中获取
        $smallToolsArr = $mysqlModel->getSmallToolsData();
        //print_r($smallToolsArr);
        $this->assign('smallToolsArr', $smallToolsArr);
         

        //大工具清点：定位器表中获取
         $bigToolsArr = $mysqlModel->getBigToolsData("");
         //print_r($bigToolsArr);
        // $bigToolIdsArr[$twtlToolId]['details'][$key2]['distance']= $distance;
        // $bigToolIdsArr[$twtlToolId]['thInfo']['name'] = $value['toListName'];
         $this->assign('bigToolsArr', $bigToolsArr);

         //人员清点-核心人员：定位器表中获取
         $personsArr = $mysqlModel->getPersonsData("");
         $this->assign('personsArr', $personsArr);

         //人员清点-施工人员：定位器表中获取
         $buildersArr = $mysqlModel->getBuildersData("");
         $this->assign('buildersArr', $buildersArr);
        
    }
}