<?php
 
class dealInfoModel extends Model
{
	public function InformselectAll($userid)
	{
		$sql = "select * from inform where informAdmin = " . $userid;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}

	public function SafetyselectAll($value='')
	{
		$sql = "select * from safety_disclosure where safetyAdmin = " . $userid;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}