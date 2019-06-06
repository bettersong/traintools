<?php
 
class newsModel extends Model
{
	public function unionSelectAll_detail($field_table1,$field_table2,$informId)
	{
        //echo(111);
        $sql = "select * from `inform` left join `pmanage` on `inform`.informPublisher=`pmanage`.pManageId where `inform`.informId = $informId";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}