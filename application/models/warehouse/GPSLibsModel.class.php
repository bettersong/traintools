<?php
 
class  GPSLibsModel extends Model
{
    public function GPSSelectAll($value='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
    	$sql = "SELECT * from gpslibs where GPSAdmin in ($myAdminBumensubArrString) ";
         //echo  $sql;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}