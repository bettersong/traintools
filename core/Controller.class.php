<?php 
/** 
 *控制器基类
 *
 *功能：包括控制器、模型和视图的基类，控制器的主要功能就是总调度。Controller 类实现所有控制器、模型和视图（View类）的通信。在执行析构函数时，可以调用 render() 来显示视图（view）文件
 * @author zhouhuixiang
 * @version 1.0
*/
class Controller
{
    protected $_controller;
    protected $_action;
	protected $_asCatalog;
    protected $_view;
    //构造函数，初始化属性，并实例化对应模型
    function __construct($controller, $action, $asCatalog='')
    {
        $this->_controller = $controller;
        $this->_action = $action;
		$this->_asCatalog = $asCatalog;
        $this->_view = new View($controller, $action, $asCatalog);
        date_default_timezone_set('Asia/Shanghai'); //时区
		
	//获取该页面的权限信息
	 global $auths_page,$auths_action;
	 $auths_page = array();//权限数组，包含：show,add,edit,del等
	 $auths_action = array();//左侧导航的权限
	 if($_SESSION['userInfo'] !=""){
		$roleId = $_SESSION['userInfo']['pManagePosition'];
		$authModel =  new Model('roleauth');
		$data['roleAuth_c'] = $controller;
		$data['roleAuth_a'] = $action;
		$res2 = $authModel->selectByCondition($data,"  and roleAuth_roleId = $roleId ");
		$authsStr = $res2[0]['roleAuth_forbid'];
		$auths_page =explode(",", $authsStr);//implode(",", $array);
	    $auths_page= array_filter($auths_page);//去除空值
	
		//设置登录用户所在角色，在每个目录-控制器-动作的权限，如果没有对应的"目录-控制器-动作"则用"-"替代。
		$res3 = $authModel->selectByCondition(""," where roleAuth_roleId = $roleId ");
		foreach($res3 as $key => $val){
			$asCatalog = $val['roleAuth_asCatalog']==""?"-":$val['roleAuth_asCatalog'];
			$controller = $val['roleAuth_c']==""?"-":$val['roleAuth_c'];
			$action = $val['roleAuth_a']==""?"-":$val['roleAuth_a'];
			$auths_action[$asCatalog][$controller][$action]=$val['roleAuth_forbid'];
			 
		}
	}
	//print_r($auths_page);
	$this->assign('auths_page', $auths_page);
	$this->assign('auths_action', $auths_action);
	
	
	
	
	//exit;
	
	
    }
    //分配变量
    function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }
    //渲染视图
    function __destruct()
    {
       
		
		$this->_view->render();
    }
}