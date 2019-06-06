<?php session_start();
//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
// // 获取ajax发送来的值

$msg = "error";

$userName = $_POST['userName'];
$password = $_POST['password'];

$data['pManageName'] = $userName;
$data['pManagePassword'] = $password;

$mysqlModel = new Model('Pmanage');
//$res返回的是一个二维数组
$res1 = $mysqlModel->selectByCondition($data,' limit 1');


if (empty($res1)){//用户不存在
	$msg = "error";
} 
else{//用户存在，判断单位是否存在及已通过审核
	
	$pManageId =  $res1[0]['pManageId'];//用户ID
	$bumenId =  $res1[0]['pManageBranch'];//用户的部门id
	$isSuperAdmin =  $res1[0]['isSuperAdmin'];
	//获取用户信息
	$getModel =  new Model("Pmanage","bmanage2");//new Model('Pmanage','zmanage','bmanage');
	
	//$res = $getModel->unionSelectAll_3('pManagePosition','zManageId','zManageBranch','bManageId',' pManageId = '.$pManageId);
    $res = $getModel ->query("select * from pmanage left join bmanage2 on pmanage.pManageBranch=bmanage2.bManageId where  pManageId = '$pManageId'");//unionSelectAll('pManageBranch','bManageId','','',' pManageId = '.$pManageId);
	$_SESSION['userInfo'] = $res[0];
	$roleIds = $res[0]['pManageRoleIds'];
	//用户角色对应的字母名称
	$res2 = $getModel ->query("select roleEnName from rolebaseinfo  where  roleId in ($roleIds)");//unionSelectAll('pManageBranch','bManageId','','',' pManageId = '.$pManageId);
	$_SESSION['userInfo']['roleEnName'] = "";
	foreach($res2 as $key2=>$value2){
		$_SESSION['userInfo']['roleEnName'] = $_SESSION['userInfo']['roleEnName'].$value2['roleEnName'].",";
	}
	$_SESSION['userInfo']['roleEnName'] = rtrim($_SESSION['userInfo']['roleEnName'],",");
	//设置该用户的树形部门信息
	//if(1==1 || $isSuperAdmin==1){
		$mysqlModel = new Model("bmanage2");
        $Bmanage = $mysqlModel ->selectAll_bmanage();
		$bumenArr = getBmanageALL($Bmanage);
		
		
		$map = array_combine(array_column($bumenArr, 'id'), array_column($bumenArr, 'pid'));
		$idsArr = getIdAndPid($map, array($bumenId) );		
		
		//print_r($idsArr);
		
		$bumenNames = "";//登录用户的树形部门（目录）
		$i=1;
		$bumenTreeArr = array();
		$adminBumenId = 1;
		foreach($idsArr as $index => $value){
			//该用户最近的主管单位
			$isAdministration = $bumenArr[$value]['isAdministration'];
			if($isAdministration==1)$adminBumenId = $bumenArr[$value]['id'];
			
			if( $i<count($idsArr) ) $bumenNames .= $bumenArr[$value]['name'].' => ';
			else $bumenNames .= $bumenArr[$value]['name'];
			
			if($bumenArr[$value]['name']==3);
			
			$bumenTreeArr[$value] = $bumenArr[$value]['name'];//
			$i++;
		}
		
			 		
		//$bumenTree = getbumenTree($Bmanage,$pManageId);
		
		//$_SESSION['userInfo']['Bmanage'] = $bumenArr;
		$_SESSION['userInfo']['bumenTreeArr'] = $bumenTreeArr;
		$_SESSION['Bmanage'] = $Bmanage;
		$_SESSION['bumenArr'] = $bumenArr;
		
		$_SESSION['userInfo']['bumenTree'] = $bumenNames;
		if($adminBumenId !=1 ){
		 	$_SESSION['userInfo']['adminBumenId'] = $adminBumenId;
		 	$_SESSION['userInfo']['adminBumenInfo'] = $bumenArr[$adminBumenId];
		 	$_SESSION['userInfo']['adminBumenName'] = $bumenArr[$adminBumenId]['bManageName'];
			
		 }
					 
		if($_SESSION['userInfo']['pManageName']=='admin')$_SESSION['userInfo']['adminBumenName'] = '系统维护部';
				
		//获取我所在的主管部门下的全部子部门ID，含主管部门自己的ID
		$result1=getSubs($Bmanage,$_SESSION['userInfo']['adminBumenId']);
		$myAdminBumen_subArr = array();
		$myAdminBumen_subArr[0]=$_SESSION['userInfo']['adminBumenId'];
		$i=1;
		foreach($result1 as $index => $value){
			$myAdminBumen_subArr[$i]=$value['bManageId'];
			$i++;
			
		}
		$_SESSION['myAdminBumen_subArr'] = $myAdminBumen_subArr;
		
		//是否有编辑权限（移动端）
    	$roleEnNameArr = explode(",", $_SESSION['userInfo']['roleEnName']);//用户角色的数组形式
		if ( in_array("taskorder_charge", $roleEnNameArr) || $_SESSION['userInfo']['isSuperAdmin']==1  ){
			$_SESSION['userInfo']['canEdit'] = 1; //拥有编辑权限
		}
		else {
			$_SESSION['userInfo']['canEdit'] = 0; //无编辑权限
		}
	 
	
	//获取权限信息
	/*$roleId = $_SESSION['userInfo']['pManagePosition'];
	$authModel =  new Model('roleauth');
	$res2 = $authModel->selectByCondition(""," where roleAuth_roleId = $roleId ");*/
	
	$msg = "success";

}


echo json_encode($msg);


//获取某分类的直接子分类
function getSons($categorys,$catId=1){
	$sons=array();
	
	foreach($categorys as $item){
		
		echo $item['pid'].'  '.$catId.'<br>';
		
		if($item['pid']==$catId)
			$sons[]=$item;
	}
	return $sons;
}
 
//获取某个分类的所有子分类
function getSubs($categorys,$catId=1,$level=1){
	$subs=array();
	foreach($categorys as $item){
		if($item['pid']==$catId){
			$item['level']=$level;
			$subs[]=$item;
			$subs=array_merge($subs,getSubs($categorys,$item['bManageId'],$level+1));
			
		}
			
	}
	return $subs;
}
//获取树形全部父类目录
function getbumenTree($bumenArr,$myBumenid){
	//$bumenArr = $aArr;
	$map = array_combine(array_column($bumenArr, 'id'), array_column($bumenArr, 'pid'));
	$idsArr = getIdAndPid($map, array($myBumenid) );
	
	
	//print_r($idsArr);
	
	$bumenNames = "";//登录用户的树形部门（目录）
	$i=1;
	foreach($idsArr as $index => $value){
		
		if( $i<count($idsArr) ) $bumenNames .= $bumenArr[$value]['name'].'=>';
		else $bumenNames .= $aArr[$value]['name'];
		$i++;
	}
	return $bumenNames;
	
}
 
 //无限分类根据顶类获取所有子类
	 
/**
 * 查出ids中的id以及其父id以及其父id的父id......
 * @param $map 以id为键, pid为值的 所有数据 的map
 * @param $ids 要查找的ids
 * @return array
 */
function getIdAndPid(&$map, $ids){
    $res = array();
    foreach($ids as $id){
        joinPid($map, $id, $res);
    }
    return array_values(array_unique($res));
}

function joinPid(&$map, $id, &$res){
    // 如果其pid不为1, 则继续查找
    if(isset($map[$id]) && $map[$id] != 1){
        joinPid($map, $map[$id], $res);
    }
    $res[] = $id;
}



 function getBmanageALL($Bmanage)
    {
       
        
		$result = $Bmanage;

		$result1 = $result;
		//print_r($Bmanage);
		$maxNum = 1000;//设置最大循环次数
    $count = -1;//设置计数
	//默认根节点内容
    $root = array(
        'id' => '0',
        'text' => '铁路总公司',
    );
	//辅助，主要作用用于检测节点是否存在
	//注：下面使用的技巧都是使用对象的引用，赋值的不是一个具体值，而是一个引用
    $existsMap = array(
        '0' => &$root,
    );
	//结果记录的长度
    $len = count($result1);
	//计数
    $num = 0;
	//遍历结果集
    while ($num < $len) {
        $count++;
		//如果计数器超过了最大循环次数就退出循环
        if ($count > $maxNum) break;
        $i = $count % $len;//取得下标，取莫的作用是防止下标超出边界
        $obj = $result[$i];//取得当前节点
        if (!$obj) continue;//不存在则跳过
        $pidObj = & $existsMap[$obj['pid']];//检测辅助数组中是否有父节点数据并赋引用值给pidObj
        if (!$pidObj) continue;
		//如果存在pidObj，则设置当前节点在existsMap中
        $existsMap[$obj['id']] = array(
            'id' => $obj['id'],
            'text' => $obj['name'],
        );
		//设置子节点
        //if (!isset($pidObj['children'])) {
            //$pidObj['children'] = array();
        //}
		//设置子节点为刚刚存在辅助数组中得引用
        //$pidObj['children'][] = & $existsMap[$obj['id']];
        //unset($result[$i]);
        $num++;
    }
	
	$aArr = array();//array();
	foreach($Bmanage as $index => $value){
		
		$bManageId = $value['id'];
		$pid = $value['pid'];
		$bManageName = $value['name'];
		
		$aArr[$bManageId]=$value;
		
		
		
	}
	$bumenArr = $aArr;
	
	
	//根据自己的需求，决定是否返回root节点
    //return $root['children'];
    
	//print_r($root['children']);
	/*$aArr = "";//array();
	foreach($Bmanage as $index => $value){
		
		$bManageId = $value['id'];
		$pid = $value['pid'];
		$bManageName = $value['name'];
		
		$aArr[$bManageId]=$value;
		
		
		
	}
	$bumenArr = $aArr;
	$map = array_combine(array_column($bumenArr, 'id'), array_column($bumenArr, 'pid'));
	$idsArr = getIdAndPid($map, array("22") );
	
	
	//print_r($idsArr);
	
	$bumenNames = "";//登录用户的树形部门（目录）
	$i=1;
	foreach($idsArr as $index => $value){
		
		if( $i<count($idsArr) ) $bumenNames .= $bumenArr[$value]['name'].'=>';
		else $bumenNames .= $aArr[$value]['name'];
		$i++;
	}
	*/
	
	
     return $bumenArr;
        //$this->assign('Bmanage', $Bmanage);
         
    }



