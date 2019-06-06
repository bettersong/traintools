<?php
 
class safetyInformModel extends Model
{
	public function select_safetyInform($value='')
	{
		$sql = "select twSafecon,pushTime from tworkorder where twOrderId = $value";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}