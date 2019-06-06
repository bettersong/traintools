<?php
 
class taskSummaryModel extends Model
{

    public function selectOrder($value='')
    {
        $sql = "SELECT * FROM tworkorder WHERE twOrderId = $value";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function selectAdmins($value='')
    {
        $sql = "SELECT * FROM tworkorder_adminstrators WHERE twamtWorkOrderId = $value";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function selectWorkers($value='')
    {
        $sql = "SELECT * FROM tworkorder_workers LEFT JOIN pmanage_builders ON twkePersonId = pManageId WHERE twkeWorkOrderId = $value";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function selectSmallTools($value='')
    {
        $sql = "SELECT * FROM tworkorder_toollists LEFT JOIN toolslist ON twtlToolId = toListId WHERE twtltWorkOrderId = $value AND toListType = 1";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function selectBigTools($value='')
    {
        $sql = "SELECT * FROM tworkorder_toollists LEFT JOIN toolslist ON twtlToolId = toListId WHERE twtltWorkOrderId = $value AND toListType = 2";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function selectPhotos($value='')
    {
        $sql = "SELECT * FROM picture_now WHERE pictureTwOrderId = $value";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}