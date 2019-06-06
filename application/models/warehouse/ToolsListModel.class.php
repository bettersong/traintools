<?php
 
class ToolsListModel extends Model
{
     //获取为使用的RFID
     public function selectUnUsedRFIDS()
     {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
    	$sql = "SELECT * from rfidtag LEFT JOIN rfidclass ON RFIDTagType = RFIDClassId where RFIDTagAdmin in ($myAdminBumensubArrString) 
        and RFIDTagCode not in(select toListRFIDCode from detail) ";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        $rfidtagJson = $sth->fetchAll();
         
        return $rfidtagJson;
     }
     
    
    public function toollistunionSelectAll($value='')
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);

        if ($value==0) {
            $sql = "select * from `toolslist` left join `rfidclass` on toListType=RFIDClassId left join `warehousemessage` on toListWarehouseId=waMessageId left join pmanage_builders on toListMaster = pManageId WHERE toListAdmin in ($myAdminBumensubArrString)";
        }
    	else
            $sql = "select * from `toolslist` left join `rfidclass` on toListType=RFIDClassId left join `warehousemessage` on toListWarehouseId=waMessageId left join pmanage_builders on toListMaster = pManageId WHERE toListType = $value and toListAdmin in ($myAdminBumensubArrString)";
        
        
    	$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
		return $sth->fetchAll();
    }

    //统计工具数量
    public function selectAmount()
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT deToolListId,COUNT(*) FROM detail WHERE DetailAdmin in ($myAdminBumensubArrString) GROUP BY deToolListId";
        
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
    
    //查询详情表内容
    public function selectDetail($deToolListId,$admin='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM `detail` LEFT JOIN gpslibs ON toListGPSId = GPSId LEFT JOIN `toolslist` ON deToolListId=toListId LEFT JOIN `pmanage` ON DetailMaster = pManageId  WHERE deToolListId = '$deToolListId' AND toListAdmin in ($myAdminBumensubArrString)";
            
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

    public function toolDetailselectAll($value='')
    {
        $sql = "SELECT * FROM toolslist LEFT JOIN toolsclass ON toListType = toClassId WHERE toListId = $value";
        
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}