<?php
 
class RFIDLibsModel extends Model
{
    public function RFIDSelectAll($value='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
    	$sql = "SELECT * from rfidtag LEFT JOIN rfidclass ON RFIDTagType = RFIDClassId where RFIDTagAdmin in ($myAdminBumensubArrString) ";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}