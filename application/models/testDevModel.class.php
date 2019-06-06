<?php
 
class testDevModel extends Model
{
	
	//测试更新工具包数据
	function testToolbag(){
		
		/*【表】
        工单-工具列表-tworkorder_toollists：工具名称 工具包ID
        工具包表-tm_tool_bag：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist：工具类别名称  工具大小

         //"tworkorder_toollists,toolslist"
        */
		$orderId = $_GET['orderId'];
		 
		$sql = "select * from tworkorder_toollists left join toolslist on twtlToolId = toListId where twtltWorkOrderId = $orderId and toListType=1 ";// left join toolslist on tworkorder_toollists.twtlName = toolslist.toListName
		
		//echo  $sql;
		
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        $res = $sth->fetchAll();
		
		
		 //var_dump($res);
		$toolbagArr = array();
		foreach ($res as $index=>$value){
			
			//echo $index. '  '.$value['twtlName']. '  数量：'.$value['twtlAmount'] . '  工具包：'.$value['twtltToolBagId'].' <br>';
			$toolbagArr[ $value['twtltToolBagId'] ][ $value['twtlToolId'] ] = $value['twtlName'];
			
		}
		
		foreach ($toolbagArr as $index=>$value){//遍历工具包ID
			
			echo $index. '  '.$value.' <br>';
			$toolbagId = $index;
			$str = "(";
			foreach ($value as $twtlToolId=>$twtlName){
				//echo $twtlToolId.'  '.$twtlName.' -- ';
				$str .= $twtlToolId."," ;
				
			} 
			$str = rtrim($str,",");
			$str .= ")";
			echo $str.'<br><br>';
			
			$sql = "select toListRFIDCode from detail where deToolListId in $str  ";
			echo ' sql:'.$sql;
			$sth = $this->_dbHandle->prepare($sql);
			$sth->execute();
	  
			$res = $sth->fetchAll();
			
			 $RFDICodes = "";
			 
			foreach ($res as $index=>$value){
				
				$RFDICodes .= $value['toListRFIDCode'].',';
			}
			$RFDICodes = rtrim($RFDICodes,",");
				 
			 
			
			echo "  RFDICodes:  ".$RFDICodes;  
			
			echo '<br><br>';
			//$toolbagArr[ $value['twtltToolBagId'] ][ $value['twtlToolId'] ] = $value['twtlName'];
			
			$sql = "update tm_tool_bag set rfid_code='$RFDICodes' where tb_id=$toolbagId  ";
			echo ' sql:'.$sql;
			
			$this->query($sql);
			 
			
			
			
		}
		
		//print_r($toolbagArr);
		
		
		
	}
}