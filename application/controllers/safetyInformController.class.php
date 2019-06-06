<?php //这是测试的控制器，可以删除。
class safetyInformController extends Controller
{
  public function index()
  {
      $twOrderId = $_GET['twOrderId'];
      $mysqlModel = new safetyInformModel("tworkorder");
      $safetyInform = $mysqlModel->select_safetyInform($twOrderId);
      //将包含日期时间改成只包含日期
      foreach ($safetyInform as $key => $value) {
          $safetyInform[$key]['pushTime'] = substr($value['pushTime'],0,10);
      }
      $this->assign('safetyInform', $safetyInform);
  }
}