<?php 
/** 
 *公共函数集合
 *
 * @author zhouhuixiang
 * @version 1.0
*/

/* 函数说明：更加目录、控制器、动作获取判断操作authType的权限
$authType: 权限类型（show,add,edit,del等）
$asCatalog: 目录
$controller: 控制器
$action: 动作
*/
function checkAuthByAction($authType,$asCatalog,$controller,$action){//checkAuthByAction
	     
	global $auths_action;
	
	//echo 'ddddddddddddddd ';print_r($auths_action);

	$asCatalog = $asCatalog==""?"-":$asCatalog;
	$controller = $controller==""?"-":$controller;
	$action = $action==""?"-":$action;
		
	$auths = $auths_action[$asCatalog][$controller][$action];
	//$authsArr =explode(",", $auths);
	
	
	//echo "<br>路径：".$asCatalog.' '.$controller.' '.$action;
	//echo "<br>权限：".$authType.'   auth_asCatalog:'.$auths_action[$asCatalog]["-"]["-"]."  auths:";print_r($auths);
	
	//先判断父类
	$auth_parent = $auths_action[$asCatalog]["-"]["-"];
	if(strpos($auth_parent,"show") !==false){//父类被禁止显示
		
		return false;
	}
	else{
		
		if(strpos($auths,"show") !==false){//自己被禁止
		
			return false;
		}
		else return true;
		
	}
 	
}
	
//判断远程文件是否存在
//php判断元素是否在二维数组中
function array_multi_search( $p_needle, $p_haystack )
{ if( in_array( $p_needle, $p_haystack ) ) { return true; } foreach( $p_haystack as $row ) { if( array_multi_search( $p_needle, $row ) ) { return true; } } return false; }
 