<?php //这是测试的控制器，可以删除。
class myNewsModel extends Model
{
	//根据条件 (id) 查询
    public function select_id($id,$idName='')
    {
        if($idName=='')$idName='id';
		$sql = sprintf("select * from `%s` where `%s` = '%s'", $this->_table, $idName,$id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function unionSelectAll_detail($field_table1,$field_table2,$safetyId)
	{
        $sql = "select * from `safety_disclosure` left join `pmanage` on `safety_disclosure`.safetyPublisher=`pmanage`.pManageId where `safety_disclosure`.safetyId = $safetyId";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}