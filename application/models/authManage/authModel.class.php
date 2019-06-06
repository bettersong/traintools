<?php
 
class authModel extends Model
{
    //2表联合查询
    public function unionSelectAll_auth($field_table1,$field_table2,$roleId)
    {
        $table1 = $this->_table;
        $table2 = $this->_table2;
		//三表联合查询
         
	  $sql = sprintf("select * from `%s` left join `%s` on `%s`.%s=`%s`.%s where zManageId=$roleId", $table1,$table2, $table1,$field_table1, $table2,$field_table2);
		 
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}