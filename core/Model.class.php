<?php
/**
 *模型基类
 *
 * @author zhouhuixiang
 * @version 1.0
*/
class Model extends Sql
{
    protected $_model;
    protected $_table;
    function __construct($table,$table2='',$table3='',$table4='',$table5='')
    {
        //连接数据库
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);  
        
		//获取模型名称
        $this->_model = get_class($this);
        $this->_model = rtrim($this->_model, 'Model'); 
        //数据库表名与类名一致
        $this->_table = strtolower($table);
		$this->_table2 = strtolower($table2);
		$this->_table3 = strtolower($table3);
		$this->_table4 = strtolower($table4);
		$this->_table5 = strtolower($table5);
    }
    function __destruct()
    {
    }
}