<?php
 
class TworkOrderModel extends Model
{
    //用于查询工具
   public function selectAll_toolList($TworkOrderID)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM tworkorder_toollists LEFT JOIN toolslist ON twtlToolId = toListId LEFT JOIN pmanage_builders ON pManageId = twtlMaster WHERE twtltWorkOrderId = $TworkOrderID";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    //用于查询工具仓库信息
    public function toolList_warehouse($toolId)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM detail LEFT JOIN  toolslist on deToolListId=toListId  left join warehousemessage ON waMessageId = toListWarehouseId WHERE deToolListId = $toolId AND DetailAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    //用于查询核心人员
    public function selectAll_administrators($TworkOrderID)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM tworkorder_adminstrators LEFT JOIN pmanage ON pManageId = twamPersonId LEFT JOIN bmanage2 ON pManageBranch = bManageId WHERE twamtWorkOrderId = $TworkOrderID";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    //用于查询施工人员
    public function selectAll_workers($TworkOrderID)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM tworkorder_workers LEFT JOIN pmanage_builders ON twkePersonId = pManageId WHERE twkeWorkOrderId = $TworkOrderID";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    //查询所有施工人员
    public function selectAll_pmanage_builders($value='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM pmanage_builders WHERE adminBumenId in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    //查询所有管理人员
    public function selectAll_pmanage($value='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM pmanage WHERE adminBumenId in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    //查询所有工具类别
    public function selectAll_tool()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM toolslist WHERE toListAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

}