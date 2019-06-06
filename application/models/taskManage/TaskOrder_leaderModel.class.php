<?php
 
class TaskOrder_leaderModel extends Model
{
    public function selectHostory($value='')
    {
    	$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * from tworkorder where  adminBumenId in ($myAdminBumensubArrString) order by JiHuaDate desc";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
        //print_r($res);
        return $res;
    }
}