<?php //这是测试的控制器，可以删除。
class scencePicController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $twOrderId = $_GET['twOrderId'];//工单号
        
         //现场照片：如果缓存中有则直接从缓存中获取
        if($_SESSION['toolsCheck_scencePic'][$twOrderId] !=''){
            $pictureResourceJson = $_SESSION['toolsCheck_scencePic'][$twOrderId];
        }
        else{
            $mysqlModel = new Model("picture_now");
            $twOrderId = $_GET['twOrderId'];
            //$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
            $sql_condition = "left join pmanage on pictureUserId = pManageId where pictureTwOrderId = $twOrderId";
            $pictureResource = $mysqlModel->selectAll($sql_condition);
            $pictureResourceJson = json_encode($pictureResource);

            $_SESSION['toolsCheck_scencePic'][$twOrderId] = $pictureResourceJson;
        }
		$this->assign('pictureResourceJson', $pictureResourceJson);
    }
}