<?php
/**
 *常量与配置信息
*/
//数据库连接配置
define('DB_NAME', 'traintools');//数据库名
define('DB_USER', 'traintools');//账号 traintools
define('DB_PASSWORD', 'ttsecjtusoft');//密码
define('DB_HOST', '119.23.61.231');//本地：localhost 远程：121.41.26.77

// define('DB_NAME', 'traintools');//数据库名
// define('DB_USER', 'root');//账号 traintools
// define('DB_PASSWORD', '654321');//密码
// define('DB_HOST', 'localhost');//localhost


//网站根URL
define("APP_URL", 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"]);

//当前页面所在的目录路径
define("CURRENT_DIR", "/application/views".substr($_SERVER["REQUEST_URI"],0,strripos($_SERVER["REQUEST_URI"],"/")));

//echo CURRENT_DIR; exit;

$catlogArrForAuth = array(
   "taskManage"=>array(
	  "name"=>"工单管理",
	 "url"=>"/taskManage/TworkOrder/index",
	  "subnav"=>array(
	  	 "TworkOrder"=>array(
			 "name"=>"今日工单",
			 "url"=>"/taskManage/TworkOrder/index",
<<<<<<< .mine
			 "action"=>"index"
||||||| .r359
=======
			 "action"=>"index" 
>>>>>>> .r362
		 ),
		 "HworkOrder"=>array(
			 "name"=>"历史工单",
			 "url"=>"/taskManage/HworkOrder/index",
			 "action"=>"index"
			 "action"=>"index"
		 )
	  )
  ),
  "warehouse"=>array(
	  "name"=>"仓库/工具管理",
	  "url"=>"/warehouse/toolsList/index",
	  "subnav"=>array(
	  	 "toolsList"=>array(
			 "name"=>"工具列表",
			 "url"=>"/warehouse/toolsList/index",
			 "action"=>"index"
		 ),
		 "waMessage"=>array(
			 "name"=>"仓库基本信息",
			 "url"=>"/warehouse/waMessage/index",
			 "action"=>"index"
		 ),
		 "RFIDLibs"=>array(
			 "name"=>"RFID标签库",
			 "url"=>"/warehouse/RFIDLibs/index",
<<<<<<< .mine
			 "action"=>"index"
		 ) 
||||||| .r359
		 ) 
=======
			 "action"=>"index"
		 ),
		 "RFIDClass"=>array(
			 "name"=>"RFID类别",
			 "url"=>"/warehouse/RFIDClass/index",
			 "action"=>"index"
		 )
>>>>>>> .r362
	  )
   ),
  "deviceManage"=>array(
	  "name"=>"其他设备管理",
	  "url"=>"/deviceManage/devicList/index",
	  "subnav"=>array(
	  	 "devicList"=>array(
			 "name"=>"设备列表",
			 "url"=>"/deviceManage/devicList/index",
			 "action"=>"index"
		 ),
		 "devicClass"=>array(
			 "name"=>"设备类别",
			 "url"=>"/deviceManage/devicClass/index",
			 "action"=>"index"
		 )
	  )
   ),
  "toolsManage"=>array(
	  "name"=>"工具清点管理",
	  "url"=>"/toolsManage/clearRecord/index",
	  "subnav"=>array(
	  	 "clearRecord"=>array(
			 "name"=>"出入库清点记录",
			 "url"=>"/toolsManage/clearRecord/index",
			 "action"=>"index"
		 )
	  )
   ),
  "personnelManage"=>array(
	  "name"=>"人员管理",
	  "url"=>"/personnelManage/bManage/index",
	  "subnav"=>array(
	  	 "bManage"=>array(
			 "name"=>"部门信息管理",
			 "url"=>"/personnelManage/bManage/index",
			 "action"=>"index"
		 ),
		 "zManage"=>array(
			 "name"=>"职位信息管理",
			 "url"=>"/personnelManage/zManage/index",
			 "action"=>"index"
		 ),
		 "pManage"=>array(
			 "name"=>"人员信息管理",
			 "url"=>"/personnelManage/pManage/index",
			 "action"=>"index"
		 )
	  )
   ),
  "signManage"=>array(
	  "name"=>"考勤管理",
	  "url"=>"/signManage/todaySign/index",
	  "subnav"=>array(
	  	 "todaySign"=>array(
			 "name"=>"今日签到",
			 "url"=>"/signManage/todaySign/index",
			 "action"=>"index"
		 ),
		 "hSign"=>array(
			 "name"=>"历史签到",
			 "url"=>"/signManage/hSign/index",
			 "action"=>"index"
		 )
	  )
   ),
  "personLocal"=>array(
	  "name"=>"人员定位管理",
	  "url"=>"/personLocal/RealTimeLocal/index",
	  "subnav"=>array(
	  	 "RealTimeLocal"=>array(
			 "name"=>"人员定位",
			 "url"=>"/personLocal/RealTimeLocal/index",
			 "action"=>"index"
		 ),
		 "RealTimeLocal"=>array(
			 "name"=>"人员定位-第三方演示版",
			 "url"=>"/personLocal/RealTimeLocal/index_orther",
			 "action"=>"index"
		 ),
		 "TrackReplay"=>array(
			 "name"=>"轨迹回放",
			 "url"=>"/personLocal/TrackReplay/index",
			 "action"=>"index"
		 )
	  )
   ),
  "safetyDoor"=>array(
	  "name"=>"安全门管理",
	  "url"=>"/safetyDoor/ceControl/index",
	  "action"=>"index"
	  "subnav"=>array(
	  	 "ceControl"=>array(
			 "name"=>"监控设备控制",
			 "url"=>"/safetyDoor/ceControl/index",
			 "action"=>"index"
		 ),
		 "ceManage"=>array(
			 "name"=>"监控信息管理",
			 "url"=>"/safetyDoor/ceManage/index",
			 "action"=>"index"
		 )
	  )
   ),
  "reportForm"=>array(
	  "name"=>"报表统计",
	  "url"=>"/reportForm/reportForms/index",
	  "subnav"=>array(
	  	 "reportForms"=>array(
			 "name"=>"工单",
			 "url"=>"/reportForm/reportForms/index",
			 "action"=>"index"
		 ),
		 "peopleForms"=>array(
			 "name"=>"人员清单",
			 "url"=>"/reportForm/peopleForms/index",
			 "action"=>"index"
		 ),
		 "equipmentForms"=>array(
			 "name"=>"工器具清单",
			 "url"=>"/reportForm/equipmentForms/index",
			 "action"=>"index"
		 ),
		"equipmentDetails"=>array(
			 "name"=>"工器具明细",
			 "url"=>"/reportForm/equipmentDetails/index",
			 "action"=>"index"
		 )
	  )
   ),
  "dealInfo"=>array(
	  "name"=>"信息发布与管理",
	  "url"=>"/dealInfo/pushInfo",
	  "subnav"=>array(
	  	 "pushInfo"=>array(
			 "name"=>"信息发布",
			 "url"=>"/dealInfo/pushInfo",
			 "action"=>"pushInfo"
		 ),
		 "adminInfo"=>array(
			 "name"=>"信息管理",
			 "url"=>"/dealInfo/adminInfo",
			 "action"=>"pushInfo"
		 )
	  )
   ),
  "authManage"=>array(
	  "name"=>"权限管理",
	  "url"=>"/authManage/auth/index",
	  "subnav"=>array(
	  	 "auth"=>array(
			 "name"=>"权限列表信息",
			 "url"=>"/authManage/auth/index",
			 "action"=>"index"
		 ),
		 "role"=>array(
			 "name"=>"角色基础信息",
			 "url"=>"/authManage/role/index",
			 "action"=>"index"
		 ),
		 "authAssignment"=>array(
			 "name"=>"分配角色权限",
			 "url"=>"/authManage/authAssignment/index",
			 "action"=>"index"
		 )
	  )
   )

); 
  
 
