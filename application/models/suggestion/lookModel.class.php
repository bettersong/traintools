<?php
 
class lookModel extends Model
{
    public function selectMessageAll()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        
        $sql = "SELECT * FROM message LEFT JOIN pmanage ON messagePersonId = pManageId WHERE `message`.adminBumenId IN ($myAdminBumensubArrString) ORDER BY messageId";
         
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}