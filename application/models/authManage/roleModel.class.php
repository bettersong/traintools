<?php
 
class roleModel extends Model
{
    //2表联合查询
    public function unionSelectAll_role($field_table1,$field_table2,$field2_table2='',$field_table3='')
    {
        $table1 = $this->_table;
        $table2 = $this->_table2;
		//三表联合查询
        if($this->_table3 != ''){
            $table3 = $this->_table3;
			//三个表都有关联
			$sql = sprintf("select * from `%s` left join `%s`  on `%s`.%s=`%s`.%s left join `%s` on `%s`.%s =`%s`.%s", $table1,$table2, $table1,$field_table1, $table2,$field_table2,$table3, $table2,$field2_table2, $table3,$field_table3);
			 
        }else{//两个表联合查询
			 $sql = sprintf("select * from `%s` left join `%s` on `%s`.%s=`%s`.%s order by bManageId asc", $table1,$table2, $table1,$field_table1, $table2,$field_table2);
		}
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}