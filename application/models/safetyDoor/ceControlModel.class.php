<?php
 
class ceControlModel extends Model
{
    public function safeDoor_information($value='') //安全门信息
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = " SELECT * FROM cecontrol LEFT JOIN pmanage ON ceControlMaster = pManageId LEFT JOIN cecontrollock ON ceLockId=ceControlLockId WHERE ceAdminBumenId in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function safeLock_information($value='') //安全锁信息
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = " SELECT * FROM cecontrollock WHERE adminBumenId in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function person_information($value='')   //人员信息
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = " SELECT * FROM pmanage WHERE adminBumenId in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}