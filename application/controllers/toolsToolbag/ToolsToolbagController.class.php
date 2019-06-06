<?php //这是测试的控制器，可以删除。
class ToolsToolbagController extends Controller
{
   // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
       $mysqlModel = new Model();
        
 		//$sql = "select *,tm_tool_bag.tb_id as tbid from tm_tool_bag left join tm_toolbag_communication on rfid_reader_code=tm_toolbag_communication.tb_id group by rfid_reader_code order by tm_tool_bag.tb_id";
        $sql = "select *,tm_tool_bag.tb_id as tbid from tm_tool_bag left join tm_toolbag_communication on id=(SELECT max(id) FROM tm_toolbag_communication WHERE rfid_reader_code = tm_toolbag_communication.tb_id)";
        $toolbagDetailArr = $mysqlModel ->query($sql);
         
        //echo $sql.'<br>';
        //print_r($toolbagDetailArr);

	    $this->assign('toolbagDetailArr', $toolbagDetailArr);
        //$this->assign('inToolsArr', $inToolsArr); 
    }
    public function toolbagDetail()
    {
        $mysqlModel = new Model();
         
        $toolBagId = $_GET['toolBagId'];
        
         //获取工具包最后的更新时间
        $sql_getLastUpdateTime = "select gpsurUpdateTime from gpsUpdateRecode where toobagId=$toolBagId order by gpsurId desc limit 1 ";
        $res_LastUpdateTime = $mysqlModel->query($sql_getLastUpdateTime);
        $toolbagLastUpdateTime = $res_LastUpdateTime[0]['gpsurUpdateTime'];

        //获取工具包最新详情（最新一次更新工具包后的数据）;
 $toolbagDetailArr = $mysqlModel ->query("select * from detail   left join   toolslist on deToolListId=toListId left join tm_toolbag_realtime on toListRFIDCode = tm_toolbag_realtime.rfid_code left join tm_tool_bag on 
 tm_toolbag_realtime.rfid_reader_code=tm_tool_bag.rfid_reader_code where read_time>'$toolbagLastUpdateTime' and tm_tool_bag.tb_id=$toolBagId group by deToolListId ");
          
        
          //print_r($toolbagDetailArr);
 
         $this->assign('toolbagDetailArr', $toolbagDetailArr);
         //$this->assign('inToolsArr', $inToolsArr); 
     }
    
	 
}