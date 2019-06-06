<?php //这是测试的控制器，可以删除。
class authController extends Controller
{
    public function index()
    {
        $mysqlModel = new Model("roleauth");
		$roleId = "";
		if($_GET['roleId'] !="" ) $roleId = $_GET['roleId'];
		//获取角色对应的权限
		$data = array();
        if($roleId != ""){
			$tempArr = $mysqlModel -> selectByCondition($data,$customCondition=' roleAuth_roleId='.$roleId);//selectAll();
			//用id做结果的下标
			foreach ($tempArr as $key => $value) { 
			   $authArr[$value['roleAuth_id']] =  $tempArr[$key];
			}
			
			$this->assign('authArr', $authArr);
			 //print_r($authArr);
		}
		
		$authMaxId = $mysqlModel -> getMaxId("");
		$this->assign('authMaxId', $authMaxId);
		
		//获取角色基本信息

		$mysqlModel2 = new authModel("bmanage","zmanage");
        $Zmanage = $mysqlModel2 ->unionSelectAll_auth('bManageId','zManageBranch',$roleId);
		//print_r( $Zmanage);
        $this->assign('Zmanage', $Zmanage[0]);
		
		
		 
         
    }
}