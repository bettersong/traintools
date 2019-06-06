<?php //这是测试的控制器，可以删除。
class dealInfoController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function pushInfo()
    {
      $InfoArr = array();
      if ($_GET['type']=='info') {
        $mysqlModel = new Model("inform");
        $data = array();
        $data['informId'] = $_GET['editid'];
        $InfoArr = $mysqlModel ->selectByCondition($data);
      }
      else if($_GET['type']=='aqjs')
      {
        $mysqlModel = new Model("safety_disclosure");
        $data = array();
        $data['safetyId'] = $_GET['editid'];
        $InfoArr = $mysqlModel ->selectByCondition($data);
      }
      $this->assign('InfoArr', $InfoArr);
    }

    public function adminInfo()
    {
      if ($_GET['type']  == '0' || $_GET['type']==''||$_GET['type'] =="info") {
        $mysqlModel = new dealInfoModel("inform");
        $InfoArr = $mysqlModel ->InformselectAll($_SESSION['userInfo']['adminBumenId']);
      }
      else if($_GET['type'] =="aqjs"){
        $mysqlModel = new dealInfoModel("safety_disclosure");
        $InfoArr = $mysqlModel ->SafetyselectAll($_SESSION['userInfo']['adminBumenId']);
      }
      //设置变量，前端可用
      $this->assign('InfoArr', $InfoArr);  
    }
}