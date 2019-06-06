<?php
 
class bManageModel extends Model
{
    function selectAll_bmanage(){
		
		//$db = new Mysql();
		//$sql = 'select id,pid,name from test order by pid asc';
		//$result = $db->select($sql);
		//$result1 = $result;
		
		
		//$sql = sprintf("select * from `%s`", $this->_table);
		$table = $this->_table;
		$sql = "select *,bManageId as id,bManageParentId as pid,bManageName as name from $table where bManageHidden=0 order by bManageId asc ";//by bManageParentId asc
		//echo $sql.'<br>';
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
        //var_dump($res);
        return $res;
	}
}