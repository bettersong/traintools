<?php
 
class RealTimeLocalModel extends Model
{
    public function LocalDevice($date)
    {
        $sql = "select * from (select * from `local_record` left join `detail`  on `local_record`.localUserId=`detail`.DetailId left join `toolslist` on `detail`.deToolListId =`toolslist`.toListId where  `local_record`.localrObj = 2 and `local_record`.localTime LIKE '"."{$date}"."%' order by `local_record`.localTime desc) as local_record group by `local_record`.localUserId";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}