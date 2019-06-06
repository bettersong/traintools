<?php
 
class toolsCheckModel extends Model
{
    public function select_tools_small($value='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = " SELECT * FROM tworkorder_toollists LEFT JOIN `toolslist`ON twtlToolId = toListId LEFT JOIN tm_tool_bag ON twtltToolBagId = tb_id WHERE toListType = 1 AND twtltWorkOrderId = $value AND twtlPreparedAmount != 0 AND toListAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function select_toollist_small($twOrderId)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = " SELECT * FROM toolslist WHERE toListId NOT IN (SELECT twtlToolId FROM tworkorder_toollists WHERE twtltWorkOrderId = $twOrderId AND twtlPreparedAmount != 0) AND toListType = 1 AND toListAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        $toolsAllArr = $sth->fetchAll();
        //print_r($toolsAllArr);
        return $toolsAllArr;          
    }

    public function select_tools_big($value='')
    {
        //获取大工具类别ID
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql1 = " SELECT * FROM tworkorder_toollists LEFT JOIN toolslist ON twtlToolId = toListId WHERE twtltWorkOrderId = $value AND toListType = 2 AND toListAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql1);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function select_toollist_big()
    {
        //获取大工具类别ID
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = " SELECT * FROM toolslist  WHERE toListType = 2 AND toListAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    //用于查询工具仓库信息
    public function toolList_warehouse($toolId)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM detail LEFT JOIN  toolslist on deToolListId=toListId  left join warehousemessage ON waMessageId = toListWarehouseId  WHERE deToolListId = $toolId AND DetailAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_gps()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM gpslibs WHERE GPSisUse=0 AND GPSAdmin in ($myAdminBumensubArrString)";

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_detail()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT DetailCode FROM detail LEFT JOIN toolslist ON deToolListId = toListId WHERE toListType = 2 AND DetailAdmin in ($myAdminBumensubArrString)";

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_tbg()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM tm_tool_bag WHERE adminBumenId in ($myAdminBumensubArrString)";

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function selece_detail_gpslibs($DetailId)
    {
        $sql = "SELECT * FROM detail LEFT JOIN gpslibs ON toListGPSId = GPSId WHERE DetailId = $DetailId";

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetch();
    }
}