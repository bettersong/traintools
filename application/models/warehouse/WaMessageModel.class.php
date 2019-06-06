<?php
 
class WaMessageModel extends Model
{
	public function WaMessageunionSelectAll()
	{
		$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
		$sql = "select * from `warehousemessage` left join `pmanage` on `warehousemessage`.waMessageMaster=`pmanage`.pManageId where waMessageAdmin in ($myAdminBumensubArrString) ";

		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
		return $sth->fetchAll();
	}

	public function selectPeople()
	{
		$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
		$sql = "SELECT * FROM pmanage WHERE adminBumenId in ($myAdminBumensubArrString) ";

		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
		return $sth->fetchAll();
	}
}