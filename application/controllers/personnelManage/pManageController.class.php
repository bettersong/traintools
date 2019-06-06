<?php //这是测试的控制器，可以删除。
class PmanageController extends Controller
{
    public function index()
    {
         //获取人员信息，及其对应的职位及部门
         $mysqlModel = new pManageModel("Pmanage","bmanage2");
         $personnerArr = $mysqlModel ->PmunionSelectAll('pManageBranch','bManageId');
         $personnerJson = json_encode($personnerArr);//转换成json并赋值给js后可以直接以数组形式方式。

         //获取GPS列表
         $gpslibs = $mysqlModel ->selectGPSAll();
         $this->assign('gpslibs', $gpslibs);
         
		 //var_dump($personnerArr);
		 
         //获取单独的部门信息
         $mysqlModel = new Model("bmanage2");
         $bumenArr = $mysqlModel ->selectAll();
         $bumenJson = json_encode($bumenArr);//转换成json并赋值给js后可以直接以数组形式方式。
		 
         //获取单独的职位信息
         $mysqlModel = new Model("zmanage");
         $zhiweiArr = $mysqlModel ->selectAll();
         $zhiweiJson = json_encode($zhiweiArr);//转换成json并赋值给js后可以直接以数组形式方式。
          
         
		  //获取角色列表
         $mysqlModel = new Model("rolebaseinfo","bmanage2");
		 if($_SESSION['userInfo']['isSuperAdmin']==1){//超级管理员
			 $roleInfoArr = $mysqlModel ->selectAll();
		 }else{//获取部门拥有的全部角色
			$bumenId = $_SESSION['userInfo']['pManageBranch'];//部门ID
			$bumenRoleIds = $mysqlModel ->query("select bManageRoleIds from bmanage2 where bManageId=$bumenId");
			//echo "bumenRoleIds:"; print_r($bumenRoleIds);
			$bumenRoleIds = $bumenRoleIds[0]['bManageRoleIds'];
			$roleInfoArr = $mysqlModel ->query("select * from rolebaseinfo where roleId in ($bumenRoleIds) ");
		 }
		 //print_r($roleInfoArr);
		 //转为以角色ID为下标
		 $roleIds_nameArr = array();
		 foreach($roleInfoArr as $key2=>$value2){
			//if( strpos($value['pManageRoleIds'],$value2['roleId'])!==false ) $myRoleNames .= $value2['roleName'].",";
			$roleIds_nameArr[$value['roleId']] = $value2;
		 }

		 $this->assign('roleInfoArr', $roleInfoArr);
		 $this->assign('roleIds_nameArr', $roleIds_nameArr);
		 $this->assign('roleInfoJson', json_encode($roleInfoArr));
		 $this->assign('roleIds_nameJson', json_encode($roleIds_nameArr));
        
      
		 //树形部门列表
		 $mysqlModel = new bManageModel("bmanage2");
        $Bmanage = $mysqlModel ->selectAll_bmanage();
        
		  
		//根据自己的需求，决定是否返回root节点
		//return $root['children'];
	 
		//print_r($root['children']);
		//print_r($personnerArr);
		 $this->assign('personnerArr', $personnerArr);
         $this->assign('personnerJson', $personnerJson);
         $this->assign('bumenJson', $bumenJson);
         $this->assign('zhiweiJson', $zhiweiJson);
		 
		 
		$this->assign('Bmanage', $Bmanage);
 		
    }
    function builders(){
         //获取人员信息，及其对应的职位及部门
         $mysqlModel = new pManageModel("pmanage_builders","bmanage2");
		 $personnerArr = $mysqlModel ->PmunionSelectAll_builders('pManageBranch','bManageId');
         $personnerJson = json_encode($personnerArr);//转换成json并赋值给js后可以直接以数组形式方式。
         
         //获取单独的部门信息
         $mysqlModel = new Model("bmanage");
         $bumenArr = $mysqlModel ->selectAll();
         $bumenJson = json_encode($bumenArr);//转换成json并赋值给js后可以直接以数组形式方式。
		 
         //获取单独的职位信息
         $mysqlModel = new Model("zmanage");
         $zhiweiArr = $mysqlModel ->selectAll();
         $zhiweiJson = json_encode($zhiweiArr);//转换成json并赋值给js后可以直接以数组形式方式。
          
         
         $this->assign('personnerArr', $personnerArr);
         $this->assign('personnerJson', $personnerJson);
         $this->assign('bumenJson', $bumenJson);
         $this->assign('zhiweiJson', $zhiweiJson);
		 


		 
		 //树形部门列表
		$mysqlModel = new bManageModel("bmanage2");
        $Bmanage = $mysqlModel ->selectAll_bmanage();
        
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
			if (!$pidObj['children']) {
				$pidObj['children'] = array();
			}
			//设置子节点为刚刚存在辅助数组中得引用
			$pidObj['children'][] = & $existsMap[$obj['id']];
			unset($result[$i]);
			$num++;
		} 
		$this->assign('Bmanage', $Bmanage);



		$mysqlModel = new pManageModel("pmanage_builders");
		$gpslibs = $mysqlModel->selectGPSAll();
		$gpslibsJson = json_encode($gpslibs);
		$this->assign('gpslibsJson',$gpslibsJson);


    }
}