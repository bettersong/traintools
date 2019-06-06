<?php //这是测试的控制器，可以删除。
class ToolsListController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
      $toolSize = 0;
      if (isset($_GET['selectSize'])) {
        $toolSize=$_GET['selectSize'];
      }
       //联合查询：查询设备列表及对应的分类
          $mysqlModel = new ToolsListModel("toolslist","rfidclass","warehousemessage");
          $ToolsList = $mysqlModel ->toollistunionSelectAll($toolSize);

          $mysqlModel_rfidclass = new Model("rfidclass");
          $rfidclass = $mysqlModel_rfidclass ->selectAll();
          $rfidclassJson = json_encode($rfidclass);//转换成json并赋值给js后可以直接以数组形式方式。

          $mysqlModel = new ToolsListModel("detail");
          $amount_detail = $mysqlModel ->selectAmount(); //获取工具ID和数量

          if (empty($amount_detail)&&!empty($ToolsList)) {
              $amount_detail['x'] = "test";
          }

          //将获取的工具数量和工具类型拼接
          foreach ($amount_detail as $key => $value) {
              foreach ($ToolsList as $K => $V) {
                  if($V['toListId'] == $value['deToolListId'])
                    $amount[$K] = $value['COUNT(*)'];
                  else if(!isset($amount[$K]))
                    $amount[$K] = 0;
              }
          }
          $i = count($amount);
          $j = count($ToolsList);
          for ($z=$i; $z < $j; $z++) { 
              array_push($amount,0);
          }
          
          //获取下拉的分类
         $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
         $mysqlModel_warehousemessage = new Model("warehousemessage");
         $conditions_w = "where  waMessageAdmin in ($myAdminBumensubArrString)";
         $warehousemessage = $mysqlModel_warehousemessage ->selectAll($conditions_w);
         $warehousemessageJson = json_encode($warehousemessage);//转换成json并赋值给js后可以直接以数组形式方式。

          $this->assign('ToolsList', $ToolsList);
          $this->assign('warehousemessageJson', $warehousemessageJson);
          $this->assign('rfidclassJson', $rfidclassJson);
          $this->assign('amount',$amount);
    }

    public function indexDetail()
    {
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $deToolListId = $_GET['toolsListId'];
        $this->assign('deToolListId', $deToolListId);

        $mysqlModel_rfidtag = new ToolsListModel("");
        $rfidtag = $mysqlModel_rfidtag ->selectUnUsedRFIDS();
        $rfidtagJson = json_encode($rfidtag);
        $this->assign('rfidtagJson',$rfidtagJson);

        //联合查询：查询设备列表及对应的分类
        $mysqlModel = new ToolsListModel("detail","toolslist","pmanage","rfidclass","warehousemessage");
        $Detail = $mysqlModel ->selectDetail($deToolListId," AND DetailAdmin in ($myAdminBumensubArrString) ");
        $this->assign('Detail', $Detail);
        
        //获取定位器列表
        $mysqlModel_gpslib = new ToolsListModel("gpslibs");
        $gpslib = $mysqlModel_gpslib ->select_gps();
        $gpslibJson = json_encode($gpslib);
        $this->assign('gpslibJson',$gpslibJson);

        $mysqlModel_pmanage = new Model("pmanage");
        $conditions_p = "where  adminBumenId in ($myAdminBumensubArrString)";
        $pmanage = $mysqlModel_pmanage ->selectAll($conditions_p);
        $pmanageJson = json_encode($pmanage);//转换成json并赋值给js后可以直接以数组形式方式。
        $this->assign('pmanageJson', $pmanageJson);

        $mysqlModel_detailtool = new ToolsListModel("");
        $detailtool = $mysqlModel_detailtool ->toolDetailselectAll($deToolListId);
        $detailtoolJson = json_encode($detailtool);//转换成json并赋值给js后可以直接以数组形式方式。
        $this->assign('detailtoolJson', $detailtoolJson);

    }
}