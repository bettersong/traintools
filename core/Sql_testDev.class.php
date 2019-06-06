<?php
/**
 *数据库基类
 *
 * @author zhouhuixiang
 * @version 1.0
*/
class Sql
{
    protected $_dbHandle;
    protected $_result;
    //连接数据库
    public function connect($host, $user, $pass, $dbname)
    {
		try {

            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $host, $dbname);
            $this->_dbHandle = new PDO($dsn, $user, $pass, array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            echo '<script>alert("数据库错误: ' . $e->getMessage() . '");</script>';exit;
        }


    }
	//测试更新工具包数据
	function testToolbag(){
		
		/*【表】
        工单-工具列表-tworkorder_toollists：工具名称 工具包ID
        工具包表-tm_tool_bag：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist：工具类别名称  工具大小

         //"tworkorder_toollists,toolslist"
        */
		
		
		$sql = "select * from toolslist ";
		//echo $sql.'<br>';
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
		
	}
	function selectAll_bmanage(){
		$table = $this->_table;
		$sql = "select *,bManageId as id,bManageParentId as pid,bManageName as name from $table where bManageHidden=0 order by bManageParentId asc ";
		//echo $sql.'<br>';
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
    //查询所有
    public function selectAll($value='')
    {
        if($value == '') $sql = sprintf("select * from `%s`", $this->_table);
        else $sql = sprintf("select * from `%s` %s", $this->_table,$value);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
	
	//获取表的记录数
    public function selectRowCount($data='',$customCondition='')
    {
		$sql = sprintf("select * from `%s` %s ".$customCondition, $this->_table, $this->formatSelect($data));
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->rowCount();
    }
	 //获取表的最大ID
    public function getMaxId($data)
    {
        $sql = "select * from $this->_table order by roleAuth_id desc limit 1";
        
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
		$res = $sth->fetchAll();
		
		
		$maxid =  $res[0]["roleAuth_id"];
		
        return $maxid;
    }
	//五表联合查询
    public function unionSelectAll_5($field1_table1,$field2_table1,$field3_table1,$field4_table1,$field_table2,$field_table3,$field_table4,$field_table5,$deToolListId,$admin='')
    {
		$table1 = $this->_table;
        $table2 = $this->_table2;
	    $table3 = $this->_table3;
		$table4 = $this->_table4;
		$table5 = $this->_table5;
		 
			//三个表都有关联
			$sql = sprintf("select * from `%s` left join `%s`  on `%s`.%s=`%s`.%s left join `%s` on `%s`.%s =`%s`.%s  left join `%s` on `%s`.%s =`%s`.%s left join `%s` on `%s`.%s =`%s`.%s where `%s`.%s=%s", $table1,$table2, $table1,$field1_table1, $table2,$field_table2
 ,$table3, $table1,$field2_table1, $table3,$field_table3 ,$table4, $table2,$field3_table1, $table4,$field_table4 ,$table5, $table1,$field4_table1, $table5,$field_table5, $table1,$field1_table1 ,$deToolListId );
		if($admin!='')
            $sql .= $admin;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
		$details = $sth->fetchAll();
        return $details;
    }
	//2表联合查询
    public function unionSelectAll($field_table1,$field_table2,$field2_table2='',$field_table3='',$customCondition='',$admin='')
    {
        $table1 = $this->_table;
        $table2 = $this->_table2;
		$where = '';
		if($customCondition != '')$where = ' where '.$customCondition;
		//三表联合查询
        if($this->_table3 != ''){
            $table3 = $this->_table3;
			//三个表都有关联
			$sql = sprintf("select * from `%s` left join `%s`  on `%s`.%s=`%s`.%s left join `%s` on `%s`.%s =`%s`.%s", $table1,$table2, $table1,$field_table1, $table2,$field_table2,$table3, $table2,$field2_table2, $table3,$field_table3);
			 
        }else{//两个表联合查询
			 $sql = sprintf("select * from `%s` left join `%s` on `%s`.%s=`%s`.%s", $table1,$table2, $table1,$field_table1, $table2,$field_table2);
		}
        if ($admin!='') {
            $sql = $sql . $where. $admin;
        }
		else $sql = $sql . $where;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
	//3表联合查询
	
    public function unionSelectAll_3($field_table1,$field_table2,$field2_table2='',$field_table3='',$customCondition='',$admin='')
    {
        $table1 = $this->_table;
        $table2 = $this->_table2;
		$table3 = $this->_table3;
		//三个表都有关联
		$where = '';
		if($customCondition != '')$where = ' where '.$customCondition;
			$sql = sprintf("select * from `%s` left join `%s`  on `%s`.%s=`%s`.%s left join `%s` on `%s`.%s =`%s`.%s", $table1,$table2, $table1,$field_table1, $table2,$field_table2,$table3, $table2,$field2_table2, $table3,$field_table3);
        if ($admin!='') {
            $sql = $sql . $where.$admin;
        }
        else $sql = $sql . $where;

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
	//松散联合查询：至少有三个表，且只有一个表与其他两个表有关联
    public function unionSelectAll_loose($field_table1,$field2_table1,$field_table2='',$field_table3='')
    {
        $table1 = $this->_table;
        $table2 = $this->_table2;
		//三表联合查询
        if($this->_table3 != ''){
            $table3 = $this->_table3;
			 //只有一个表与其他两个表有关联
			 $sql = sprintf("select * from `%s` left join `%s`  on `%s`.%s=`%s`.%s left join `%s` on `%s`.%s =`%s`.%s", $table1,$table2, $table1,$field_table1, $table2,$field_table2,$table3, $table1,$field2_table1, $table3,$field_table3);
        }
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    //根据条件 (id) 查询 
    public function select($id,$idName='')
    {
        if($idName=='')$idName='id';
		$sql = sprintf("select * from `%s` where `%s` = '%s'", $this->_table, $idName,$id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetch();
    }
	//根据条件查询：更加$data数组字段对应的值进行查询,$customCondition为用户自定义的where条件，如:limit 1
	public function selectByCondition($data,$customCondition='')
    {
		$sql = sprintf("select * from `%s` %s ".$customCondition, $this->_table, $this->formatSelect($data));
		//echo $sql.' <br>' ;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    //根据条件 (id) 删除
    public function delete($id,$idName='')
    {
        if($idName=='')$idName='id';
		$sql = sprintf("delete from `%s` where `%s` = '%s'", $this->_table, $idName,$id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        // return $sql;
        return $sth->rowCount();
    }
    //自定义SQL查询，返回影响的行数
    public function query($sql)
    {
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->rowCount();
    }
    //新增数据
    public function add($data)
    {
        $sql = sprintf("insert into `%s` %s", $this->_table, $this->formatInsert($data));
        // return $sql;
        $this->query($sql);
        return $this->_dbHandle->lastInsertId() ;
    }
    //修改数据
    public function update($id, $data,$idName='')
    {
        if($idName=='')$idName='id';
		$sql = sprintf("update `%s` set %s where `%s` = '%s'", $this->_table, $this->formatUpdate($data), $idName,$id);
         // return $sql;
        return $this->query($sql);
    }

    //修改人员数据
    public function update_pmanage($personId,$GPSId)
    {
        $sql = "UPDATE pmanage set pManageGpsId = $GPSId WHERE pManageId = $personId";
        return $this->query($sql);
    }

    //修改工单中工具编号集合
    public function update_biglist($twtlId,$bigid)
    {
        $sql = "UPDATE tworkorder_toollists set twtlDetail = '$bigid,' WHERE twtlId = $twtlId";
        return $this->query($sql);
    }

    //修改工单中定位器集合
    public function update_local($twtlId,$bigid)
    {
        $sql = "UPDATE tworkorder_toollists set twtltToolBagId = '$bigid,' WHERE twtlId = $twtlId";
        return $this->query($sql);
    }

	//根据数组更新值
	 public function updateByData($data_update,$bydata)
    {
 		$sql = "update $this->_table set ";
		$i=1;
		foreach($data_update as $key=>$val){
			if( $i<count($data_update) )$sql .= $key."=".$val.",";
			else $sql .= "  ".$key."='$val'";
			$i++;
		}
		if($bydata !=""){
			$sql .= " where ";
			$i=1;
			foreach($bydata as $key=>$val){
				if( $i<count($bydata) )$sql .= " ".$key."='$val' and ";
				else $sql .= " ".$key."='$val'";
				$i++;
			}
		}
		
		
       //return $sql;
       return $this->query($sql);
    }
    //将数组转换成插入格式的sql语句
    private function formatInsert($data)
    {
        $fields = array();
        $values = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $values[] = sprintf("'%s'", $value);
        }

        $field = implode(',', $fields);
        $value = implode(',', $values);

        return sprintf("(%s) values (%s)", $field, $value);
    }
	 //将数组转换成条件查询格式的sql语句
    private function formatSelect($data='')
    {
		$fields = array();
        $values = array();
		$conditions = '';
		$i=1;
		$dataLen = count($data);
        foreach ($data as $key => $value) {
			if($dataLen>1 && $i<$dataLen)$conditions .= $key."='".$value."' and ";
			else $conditions .= $key."='".$value."'";
			$i++;
        }

        if($data != '')$conditions = "where ".$conditions;
        return $conditions;
    }
	
    //将数组转换成更新格式的sql语句
    private function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }
        return implode(',', $fields);
    }
	private function formatUpdateByData($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }
        return implode(',', $fields);
    }

    public function maxId($date)
    {
        $sql = "SELECT max(id), max(create_time) FROM tm_dev_location WHERE create_time LIKE '$date%' AND localUserId != '' GROUP BY dev_imei";//localUserId
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
    public function LocalPerson($date,$PersonMaxId)
    {
        $Max_id = '';
        foreach ($PersonMaxId as $key => $value) {
            $Max_id = $Max_id." id = ".$value['max(id)']." or";
        }
        $Max_id = substr($Max_id,0,strlen($Max_id)-3);
        $Max_id = $Max_id." AND create_time LIKE '$date%'";
        $sql = "select * from `tm_dev_location` left join `pmanage`  on `tm_dev_location`.dev_imei=`pmanage`.pManageDev_imei left join `bmanage` on `pmanage`.pManageBranch =`bmanage`.bManageId where".$Max_id;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    //在今日工单upload中用于查出工具负责人信息
    public function select_toollistForm($toolName)
    {
        $sql = "SELECT * FROM toolslist LEFT JOIN detail ON toListId = deToolListId LEFT JOIN warehousemessage ON DetailWarehouse = waMessageId WHERE toListName = '$toolName'";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        return $sth->fetch();
    }

    //用于手机版小工具添加
    public function select_dev_small($value='')
    {
        $sql = "SELECT * FROM toolslist LEFT JOIN warehousemessage ON toListWarehouseId = waMessageId WHERE toListId = $value";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function select_tool($value1='',$value2='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM tworkorder_toollists LEFT JOIN `toolslist`ON twtlToolId = toListId LEFT JOIN tm_tool_bag ON twtltToolBagId = tb_id WHERE toListType = 1 AND twtltWorkOrderId = {$value1} AND twtlId = $value2 AND toListAdmin in ($myAdminBumensubArrString)";

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    //用于大工具添加查询
    public function select_tool_big($value1='',$value2='')
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM toolslist LEFT JOIN warehousemessage ON toListWarehouseId = waMessageId WHERE toListId = $value1 AND toListAdmin in ($myAdminBumensubArrString)";

        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetch();
    }
    //用于查询工具仓库信息
    public function toolList_warehouse1($toolId)
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "SELECT * FROM detail LEFT JOIN warehousemessage ON waMessageId = DetailWarehouse WHERE deToolListId = $toolId AND DetailAdmin in ($myAdminBumensubArrString)";
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }
}