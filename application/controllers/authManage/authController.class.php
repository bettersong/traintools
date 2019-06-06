<?php //这是测试的控制器，可以删除。
class authController extends Controller
{
    public function index()
    {
        $mysqlModel = new Model("roleauth");
		$roleId = "";
		$authArr = array();
		if($_GET['roleId'] !="" ) $roleId = $_GET['roleId'];
		//获取角色对应的权限
		$data = array();
        if($roleId != ""){
			$tempArr = $mysqlModel -> selectByCondition($data,$customCondition=' roleAuth_roleId='.$roleId);//selectAll();
			//用id做结果的下标
			//print_r($tempArr);
			foreach ($tempArr as $key => $val) { 
			   //$authArr[$value['roleAuth_id']] =  $tempArr[$key];
			   
			    $asCatalog = $val['roleAuth_asCatalog']==""?"":$val['roleAuth_asCatalog'];
				$controller = $val['roleAuth_c']==""?"":$val['roleAuth_c'];
				$action = $val['roleAuth_a']==""?"":$val['roleAuth_a'];
				 //echo "<br>路径：".$asCatalog.' '.$controller.' '.$action;
				$authArr[$asCatalog][$asCatalog."-".$controller."-".$action]=$val;//["roleAuth"]
				//权限集合
				//$roleAuth_forbid = $val['roleAuth_forbid'];
				//if($roleAuth_forbid != "")$roleAuthArr = explode(",", $roleAuth_forbid);//implode(",", $array);
				//else $roleAuthArr="";

				//$authArr[$asCatalog][$asCatalog."-".$controller."-".$action]['authArr'] = $roleAuthArr;
				
			}
			 
		}
		//$authArr = array();
		 //print_r($authArr);
		$this->assign('authArr', $authArr);
		
		
		$authMaxId = $mysqlModel -> getMaxId("");
		$this->assign('authMaxId', $authMaxId);
		
		//获取角色基本信息

		$mysqlModel2 = new authModel("bmanage","zmanage");
        $Zmanage = $mysqlModel2 ->unionSelectAll_auth('bManageId','zManageBranch',$roleId);
		//print_r( $Zmanage);
        $this->assign('Zmanage', $Zmanage[0]);
		
		
		 
         
    }
}