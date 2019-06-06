<?php //这是测试的控制器，可以删除。
class TodaySignController extends Controller
{
	public function index()
    {
        if (isset($_POST['date'])) 
            $date=$_POST['date'];
        else
            $date = date("Y-m-d");
 		$mysqlModel = new TodaySignModel("tworkorder_adminstrators");
 		$TodaySign = $mysqlModel ->select_today($date);
        $attendance_amount = $mysqlModel->count_attendance();
        $TodaySign_amount = count($TodaySign);
        $NoSign_amount = $TodaySign_amount-$attendance_amount['COUNT(twamAttendance)'];

        $this->assign('TodaySign_amount', $TodaySign_amount); //应签人数
        $this->assign('TodaySign', $TodaySign);//考勤表
        $this->assign('attendance_amount', $attendance_amount['COUNT(twamAttendance)']); //实签人数
        $this->assign('NoSign_amount', $NoSign_amount); //未签人数
    }
}