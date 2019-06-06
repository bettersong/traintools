<?php //这是测试的控制器，可以删除。
class HsignController extends Controller
{
	public function index()
    {
        $date = date("Y-m-d");
 		$mysqlModel = new HsignModel("tworkorder_adminstrators");
        $attendance_amount = $mysqlModel->count_attendance();
        $NoSign_amount = $mysqlModel->count_Notsign();
        foreach ($NoSign_amount as $K => $V) {
        	foreach ($attendance_amount as $key => $value) {
        		if ($V['twamDate']==$value['twamDate']) {
        			$attendance_amount[$key]['ShouldSign'] = $V['COUNT(twamAttendance)'];
        		}
        	}
        }
        $this->assign('attendance_amount', $attendance_amount); //考勤表人数
    }
}