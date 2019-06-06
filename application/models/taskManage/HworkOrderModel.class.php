<?php
 
class HworkOrderModel extends Model
{
    public function selectHostory()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $date1=$_GET['date1'];
        $date2=$_GET['date2'];
        if($date1 && date2){
            $sql = "SELECT * FROM tworkorder WHERE adminBumenId IN ($myAdminBumensubArrString) and JiHuaDate>'$date1' and JiHuaDate<'$date2' order by JiHuaDate desc";
        }else{
            $sql = "SELECT * FROM tworkorder WHERE adminBumenId IN ($myAdminBumensubArrString) order by JiHuaDate desc";
        }
         
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
        return $res;
    }
}