<?php //这是测试的控制器，可以删除。
class mySignModel extends Model
{
    public function attendance($user_id)
    {
    	$sql = "select *,COUNT(twamAttendance) from `tworkorder_adminstrators` WHERE twamPersonId = $user_id GROUP BY twamAttendance ORDER BY twamDate DESC";

    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}