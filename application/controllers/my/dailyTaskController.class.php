<?php //这是测试的控制器，可以删除。
class dailyTaskController extends Controller
{
    public function index()
    {
   //  {   $date = date('Y-m-d');
   //      print_r($date);
   //  	$mysqlModel = new dailyTaskModel("tworkorder"); 
 		// $dailyTask = $mysqlModel ->selectByCondition($date);
   //      $this->assign('dailyTask', $dailyTask[0]['ZuoYeNR']);
   //      print_r($dailyTask);
        $data['JiHuaDate']= date('Y-m-d');
        $this->assign('date', $data['JiHuaDate']);
        $mysqlModel1 = new dailyTaskModel("tworkorder");
        $dailyTask = $mysqlModel1 ->selectByCondition($data);
        //$dailyTask = json_encode($dailyTask);
        $this->assign('dailyTask',$dailyTask[0]);
         //print_r($dailyTask);
    }
}