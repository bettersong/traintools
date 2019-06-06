<?php
 
class hSignModel extends Model
{

    public function count_attendance()
    {
    	$sql =  "select *,COUNT(twamAttendance) from `tworkorder_adminstrators` left join `pmanage` on `tworkorder_adminstrators`.twamPersonId=`pmanage`.pManageId WHERE `tworkorder_adminstrators`.twamAttendance='1' GROUP BY twamDate ORDER BY twamDate DESC";
    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function count_Notsign()
    {
    	$sql =  "select twamDate,COUNT(twamAttendance) from `tworkorder_adminstrators` GROUP BY twamDate ORDER BY twamDate DESC";
    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}