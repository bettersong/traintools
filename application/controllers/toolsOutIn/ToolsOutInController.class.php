<?php //这是测试的控制器，可以删除。
class ToolsOutInController extends Controller
{
   // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
       $mysqlModel1 = new Model("tworkorder_dev");
		
		//$data['twdevStatus_out']= 1;
        $outToolsArr = $mysqlModel1 ->selectAll();//selectByCondition($data);//selectByCondition($data,$customCondition='')
         
		//$data['twdevStatus_in']= 1;
		//$data = "";
        //$inToolsArr = $mysqlModel1 ->selectAll();//selectByCondition($data);//selectByCondition($data,$customCondition='')
		
	    $this->assign('toolsArr', $outToolsArr);
        //$this->assign('inToolsArr', $inToolsArr); 
    }
	public function index_m()
    {
        
		 $this->assign('test', "999999999999");
		/*$mysqlModel1 = new Model("tworkorder_dev");
		
		$data['twdevStatus_out']= 1;
        $outToolsArr = $mysqlModel1 ->selectByCondition($data);//selectByCondition($data,$customCondition='')
         
		$data['twdevStatus_in']= 1;
        $inToolsArr = $mysqlModel1 ->selectByCondition($data);//selectByCondition($data,$customCondition='')
		
	    $this->assign('outToolsArr', $outToolsArr);
        $this->assign('inToolsArr', $inToolsArr);*/
    }
}