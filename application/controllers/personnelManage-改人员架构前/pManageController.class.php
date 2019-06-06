<?php //这是测试的控制器，可以删除。
class PmanageController extends Controller
{
    public function index()
    {
          //获取人员信息，及其对应的职位及部门
          $mysqlModel = new Model("Pmanage","zmanage","bmanage"); 
          $personnerArr = $mysqlModel ->unionSelectAll('pManagePosition','zManageId','zManageBranch','bManageId');
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
    }
}