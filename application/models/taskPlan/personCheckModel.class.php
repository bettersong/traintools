<?php
 
class personCheckModel extends Model
{
    public function select_person($value='')
    {
    	$sql = "SELECT * FROM tworkorder_adminstrators LEFT JOIN pmanage ON twamPersonId = pManageId LEFT JOIN gpslibs ON pManageGpsId = GPSId WHERE twamtWorkOrderId = $value";
        //echo $sql.'<br>';
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    public function select_builders($value='')
    {
    	$sql = "SELECT * FROM tworkorder_workers LEFT JOIN pmanage_builders ON twkePersonId = pManageId LEFT JOIN gpslibs ON pManageGpsId = GPSId WHERE twkeWorkOrderId = $value";
        //echo $sql;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_allBuilders($value='')
    {
    	$sql = "SELECT * FROM pmanage_builders  LEFT JOIN gpslibs ON pManageGpsId = GPSId WHERE pManageId NOT IN (SELECT twkePersonId FROM tworkorder_workers WHERE twkeWorkOrderId = $value)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_admin()
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
    	$sql = "SELECT * FROM pmanage WHERE adminBumenId in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_GPSLocate()
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
    	$sql = "SELECT * FROM gpslibs WHERE GPSisUse = 0 AND GPSAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}