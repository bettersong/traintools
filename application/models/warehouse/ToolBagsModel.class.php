<?php
 
class ToolBagsModel extends Model
{
    public function selectAll_Bags($value='')
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
    	$sql = "SELECT * FROM tm_tool_bag LEFT JOIN warehousemessage ON rep_id = waMessageId LEFT JOIN gpslibs ON tb_GPSId = GPSId where adminBumenId in ($myAdminBumensubArrString)";


    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    //查询可用定位设备
    public function select_gps($value='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM gpslibs WHERE GPSisUse = 0 AND GPSAdmin in ($myAdminBumensubArrString)";
            
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}