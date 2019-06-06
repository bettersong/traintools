<?php
/**
 * MyPHP核心框架
 */
class Core
{
    protected $_asCatalog; //仅作为目录，既不是“控制器”也不是“动作”
    
    // 运行程序
    function run()
    {
        //echo ' 333333 ';
         
        spl_autoload_register(array($this, 'loadClass'));//自动加载函数，当我们实例化一个未定义的类时，就会触发此函数

        $this->setReporting();

        $this->removeMagicQuotes();

        $this->unregisterGlobals();

        $this->Route();
    }
    // 路由处理
    function Route()
    {
       $controllerName = 'index';//index
        $action = 'index';
        if (!empty($_GET['url'])) {
            $url = $_GET['url'];
            
            //echo '  url='. $url.'<br>';
            $urlArray = explode('/', $url);
            //print_r($urlArray);
            
            //$this->_asCatalog = "";//仅作为目录，既不是“控制器”也不是“动作”
            $this->_asCatalog = '';
             // 获取动作名
            $action = array_pop($urlArray);
            // 获取控制器名
            $controllerName = ucfirst(array_pop($urlArray));
            //仅作为目录
            $this->_asCatalog = array_pop($urlArray);

        }
        
        $asCatalog = $this->_asCatalog;
        // 数据为空的处理
        $queryString  = empty($queryString) ? array() : $queryString;
        // 实例化控制器
        $controller = ucfirst($controllerName) . 'Controller';
        
        //echo "<br><br> 11asCatalog:".$this->_asCatalog." controllerName:".$controller." action:".$action.'<br><br>';
        
         //echo ' 222 ';
        
        
        // 如果控制器存和动作存在，这调用并传入URL参数
        $action = str_replace('_m','',$action);//手机端与PC端使用相同的action
        
        if ((int)method_exists($controller, $action)) {//判断某个类中是否包含某个方法
             //echo ' <br>1111 '.$controllerName.'  ';
            $dispatch = new $controller($controllerName, $action, $this->_asCatalog);
            //print_r(array($dispatch, $action)) ;exit;
			call_user_func_array(array($dispatch, "common"), $queryString);//该控制器的共同函数；动态调用普通函数，比如参数和调用方法名称不确定的时
            call_user_func_array(array($dispatch, $action), $queryString);//该控制器下动作对应的函数；动态调用普通函数，比如参数和调用方法名称不确定的时
        } else {
             //echo ' <br>2222 ';
            //echo '<div style="position: fixed;top:21px;left:40%;color:#fff;z-index: 99999;">'.$controllerName . "对应的控制器或动作不存在</div>";//exit($controller . "对应的控制器或动作不存在");
            $view = new View($controllerName, $action, $this->_asCatalog);
            $view->render();
        }
        
    }

	
    // 检测开发环境
    function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', RUNTIME_PATH. 'logs/error.log');
        }
    }
    // 删除敏感字符
    function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
        return $value;
    }
    // 检测敏感字符并删除
    function removeMagicQuotes()
    {
        if ( get_magic_quotes_gpc()) {
           $_GET = stripSlashesDeep($_GET );
            $_POST = stripSlashesDeep($_POST );
            $_COOKIE = stripSlashesDeep($_COOKIE);
            $_SESSION = stripSlashesDeep($_SESSION);
        }
    }
    // 检测自定义全局变量（register globals）并移除
    function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
           foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
    // 自动加载控制器和模型类
    function loadClass($class)
    {   
        //echo '  <br> class111='.$class.'  <br> ';
        
        $frameworks = FRAME_PATH . $class . '.class.php';
        $controllers = APP_PATH . 'application/controllers/'.$this->_asCatalog.'/' . $class . '.class.php';
        $models = APP_PATH . 'application/models/'.$this->_asCatalog.'/' . $class . '.class.php';
        //echo '  frameworks = '.$frameworks.'<br>';
        //echo '  controllers = '.$controllers.'<br>';
        //echo '  models = '.$models.'<br><br>'; 
         
        //echo $models.'<br>';
        if (file_exists($frameworks)) {
            // 加载框架核心类
            include $frameworks;
            //echo '  include: frameworks = '.$frameworks.'<br><br>';
        } elseif (file_exists($controllers)) {
            // 加载应用控制器类
            include $controllers;
            //echo '  include: controllers = '.$controllers.'<br><br>';
        } elseif (file_exists($models)) {
            //加载应用模型类
            include $models;
            //echo '  include: models22 = '.$models.'<br><br>';
        } else {
            /* 错误代码 */
        }
    }
}