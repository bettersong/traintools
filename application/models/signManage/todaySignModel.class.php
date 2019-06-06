<?php
 
class todaySignModel extends Model
{
    public function select_today($date)
    {
    	$sql = "select * from `tworkorder_adminstrators` left join `pmanage` on `tworkorder_adminstrators`.twamPersonId=`pmanage`.pManageId LEFT JOIN `zmanage` on `pmanage`.pManagePosition = zManageId LEFT JOIN `bmanage` on pManageBranch = bManageId WHERE `tworkorder_adminstrators`.twamDate = '$date'";
    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function count_attendance()
    {
    	$sql =  "select *,COUNT(twamAttendance) from `tworkorder_adminstrators` left join `pmanage` on `tworkorder_adminstrators`.twamPersonId=`pmanage`.pManageId WHERE `tworkorder_adminstrators`.twamDate = '2018-11-27' AND `tworkorder_adminstrators`.twamAttendance='1'";
    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetch();
    }
}