<?php //这是测试的控制器，可以删除。
class safetyModel extends Model
{
    public function index()
    {
    }
    public function unionSelectAll_detail($field_table1,$field_table2,$safetyId)
	{
        $sql = "select * from `safety_disclosure` left join `pmanage` on `safety_disclosure`.safetyPublisher=`pmanage`.pManageId where `safety_disclosure`.safetyId = $safetyId";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}