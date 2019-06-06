<?php
 
class TrackReplayModel extends Model
{
    public function LocalPerson($date)
    {
        $sql = "select * from (select * from `local_record` left join `pmanage`  on `local_record`.localUserId=`pmanage`.pManageId left join `bmanage` on `pmanage`.pManageBranch =`bmanage`.bManageId where `local_record`.localrObj = 1 and `local_record`.localTime LIKE '"."{$date}"."%' order by `local_record`.localTime desc ) as local_record group by `local_record`.localUserId";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    public function LocalDevice($date)
    {
        $sql = "select * from (select * from `local_record` left join `detail`  on `local_record`.localUserId=`detail`.DetailId left join `toolslist` on `detail`.deToolListId =`toolslist`.toListId where  `local_record`.localrObj = 2 and `local_record`.localTime LIKE '"."{$date}"."%' order by `local_record`.localTime desc) as local_record group by `local_record`.localUserId";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}