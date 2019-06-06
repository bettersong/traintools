<?php
 
class pManageModel extends Model
{
	public function PmunionSelectAll($value='')
	{
		//print_r( $_SESSION['myAdminBumen_subArr']);
		$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
		if($_SESSION['userInfo']['isSuperAdmin']==1){
			$sql = "SELECT * ,bmanage2.bManageName as bManageName2,bmanage2b.bManageName as bManageName1 ,bmanage2.bManageId as bManageId2 FROM pmanage LEFT JOIN bmanage2 ON pmanage.pManageBranch =bmanage2.bManageId LEFT JOIN bmanage2 as bmanage2b on bmanage2.bManageParentId=bmanage2b.bManageId LEFT JOIN gpslibs ON pManageGpsId=GPSId";
		}
		else {
		//$sql = "SELECT * FROM `pmanage` LEFT JOIN `bmanage2` ON `pmanage`.pManageBranch =`bmanage2`.bManageId WHERE bManageId IN  ($myAdminBumensubArrString)";
		 $sql = "SELECT * ,bmanage2.bManageName as bManageName2,bmanage2b.bManageName as bManageName1 ,bmanage2.bManageId as bManageId2 FROM pmanage LEFT JOIN bmanage2 ON pmanage.pManageBranch =bmanage2.bManageId LEFT JOIN bmanage2 as bmanage2b on bmanage2.bManageParentId=bmanage2b.bManageId LEFT JOIN gpslibs ON pManageGpsId=GPSId WHERE bmanage2.bManageId IN  ($myAdminBumensubArrString)";
		}
        
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
	}
	public function PmunionSelectAll_builders($value='')
	{
		$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
		$adminBumenId = $_SESSION['userInfo']['adminBumenId'];
		$sql = "SELECT * FROM `pmanage_builders` LEFT JOIN `bmanage2` ON `pmanage_builders`.adminBumenId =`bmanage2`.bManageId LEFT JOIN gpslibs ON pManageGpsId = GPSId WHERE bManageId=$adminBumenId";
        //echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
	}

	public function selectGPSAll()
	{
		$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
		$sql = "SELECT * FROM gpslibs WHERE GPSisUse = 0 AND GPSAdmin in ($myAdminBumensubArrString)";

		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
	}
}