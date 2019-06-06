<?php //这是测试的控制器，可以删除。
class toolsCheckController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {       
        
        $twOrderId = $_GET['twOrderId'];
        $mysqlModel = new toolsCheckModel("tworkorder_toollists");
       
        //获取工单信息
        $orderInfoArr = $mysqlModel -> query("select * from tworkorder where twOrderId=$twOrderId ");
        $this->assign('orderInfoArr',$orderInfoArr[0]);
        
        //小工具信息：如果缓存中有则直接从缓存中获取
        //if($_SESSION['toolsCheck_toolsAllArr'][$twOrderId] !=''){
           // $toolsAllArr = $_SESSION['toolsCheck_toolsAllArr'][$twOrderId];
        //}
        //else{
            //$mysqlModel = new toolsCheckModel("tworkorder_toollists");
            $toolsAllArr = $mysqlModel ->select_toollist_small($twOrderId);//查询详情页所有小工具
            foreach ($toolsAllArr as $key => $value) {
                $toolId = $value['toListId'];
                $tmp = $mysqlModel ->toolList_warehouse($toolId);
                $toolsAllArr[$key]['waMessageName'] = '';
                foreach ($tmp as $tmp_key => $tmp_value) { //逆向遍历数组
                    if (strpos($toolsAllArr[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
                        $toolsAllArr[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
                        $toolsAllArr[$key]['waMessageName'] = ltrim($toolsAllArr[$key]['waMessageName'], ","); //去除最前端逗号
                    }
                }
            //}
            //$_SESSION['toolsCheck_toolsAllArr'][$twOrderId] = $toolsAllArr;
        }
        $this->assign('toolsAllArr',$toolsAllArr);
        

        //if($_SESSION['toolsCheck_toolsArr'][$twOrderId] !=''){
            //$toolsArr = $_SESSION['toolsCheck_toolsArr'][$twOrderId];
        //}
        //else{
            $toolsArr = $mysqlModel ->select_tools_small($twOrderId); //查询工单小工具
            //获取仓库工具库存和人员信息
            foreach ($toolsArr as $key => $value) {
                $toolId = $value['twtlToolId'];
                $tmp = $mysqlModel ->toolList_warehouse($toolId);
                $toolsArr[$key]['waMessageName'] = '';
                foreach ($tmp as $tmp_key => $tmp_value) { //逆向遍历数组
                    if (strpos($toolsArr[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
                        $toolsArr[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
                        $toolsArr[$key]['waMessageName'] = ltrim($toolsArr[$key]['waMessageName'], ","); //去除最前端逗号
                        $toolsArr[$key]['waMessageName'] = rtrim($toolsArr[$key]['waMessageName'], ",");
                    }
                }
            }
            //$_SESSION['toolsCheck_toolsArr'][$twOrderId] = $toolsArr;
        //}
        $this->assign('toolsArr',$toolsArr);
        
        //大工具信息：如果缓存中有则直接从缓存中获取
        // if($_SESSION['toolsCheck_toolsArr_big'][$twOrderId] !=''){
        //     $toolsArr_big = $_SESSION['toolsCheck_toolsArr_big'][$twOrderId];
        // }else{
            $toolsArr_big = $mysqlModel ->select_tools_big($twOrderId);

            //获取仓库信息
            foreach ($toolsArr_big as $key => $value) {
                $toolId = $value['twtlToolId'];
                $tmp = $mysqlModel ->toolList_warehouse($toolId);
                $toolsArr_big[$key]['waMessageName'] = '';
                foreach ($tmp as $tmp_key => $tmp_value) { //逆向遍历数组
                    if (strpos($toolsArr_big[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
                        $toolsArr_big[$key]['waMessageName'] .= $tmp_value['waMessageName'];//获取工具仓库
                    }
                }
            }

            $tmp = $toolsArr_big;
            $tmpArr = array();
            $tmp_detail = array(); //用于分割工具编号
            $tmp_local = array();  //用于分割定位器
            $mysqlModel_detail = new toolsCheckModel("detail,gpslibs");
            //按数量遍历大工具
            foreach ($tmp as $key => $value) {
                $tmp_amount = $value['twtlPreparedAmount'];
                $tmp_detail = explode(",", $value['twtlDetail']);
                for ($i=0,$j=$key+1; $i < $tmp_amount; $i++,$j++) {
                    if (isset($tmp_detail[$i])) {
                        $detailInformation = $mysqlModel_detail->selece_detail_gpslibs($tmp_detail[$i]);
                        $value['IDbig'] = $i;
                        $value['DetailId'] = $detailInformation['DetailId'];
                        $value['DetailCode'] = $detailInformation['DetailCode'];
                        $value['GPSId'] = $detailInformation['GPSId'];
                        $value['GPSCode'] = $detailInformation['GPSCode'];
                    }
                    else
                    {
                        $value['IDbig'] = $i;
                        $value['DetailId'] = "";
                        $value['DetailCode'] = "";
                        $value['GPSId'] = "";
                        $value['GPSCode'] = "";
                    }
                    array_push($tmpArr, $value);
                }
                //初始化
                $tmp_detail = array();
                $tmp_local = array();
            }
            $toolsArr_big=$tmpArr;
            //print_r($toolsArr_big);
            //$_SESSION['toolsCheck_toolsArr_big'][$twOrderId] = $toolsArr_big;
        //}
            $this->assign('toolsArr_big',$toolsArr_big);
        

        // if($_SESSION['toolsCheck_toolsArr_big_AllJson'][$twOrderId] !=''){
        //     $toolsArr_big_AllJson = $_SESSION['toolsCheck_toolsArr_big_AllJson'][$twOrderId];
        // }else{
            $toolsArr_big_All = $mysqlModel ->select_toollist_big();  //详情页大工具
            foreach ($toolsArr_big_All as $key => $value) {
                $toolId = $value['toListId'];
                $tmp = $mysqlModel ->toolList_warehouse($toolId);
                $toolsArr_big_All[$key]['waMessageName'] = '';
                foreach ($tmp as $tmp_key => $tmp_value) { //逆向遍历数组
                    if (strpos($toolsArr_big_All[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
                        $toolsArr_big_All[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
                        $toolsArr_big_All[$key]['waMessageName'] = ltrim($toolsArr_big_All[$key]['waMessageName'], ","); //去除最前端逗号
                    }
                }
            }
            $toolsArr_big_All[0]['waMessageName'] = rtrim($toolsArr_big_All[0]['waMessageName'],",");

            //print_r($toolsArr_big_All);
            $toolsArr_big_AllJson = json_encode($toolsArr_big_All);

            $_SESSION['toolsCheck_toolsArr_big_AllJson'][$twOrderId] = $toolsArr_big_AllJson;
            
        //}
        $this->assign('toolsArr_big_AllJson',$toolsArr_big_AllJson);

        //获取定位器信息
        $gpslib = $mysqlModel ->select_gps();
        $gpslibJson = json_encode($gpslib);
        $this->assign('gpslibJson',$gpslibJson);

        //获取大工具工具编号
        $detail = $mysqlModel ->select_detail();
        $detailJson = json_encode($detail);
        $this->assign('detailJson',$detailJson);

        //获取工具包信息
        $mysqlModel_tbg = new toolsCheckModel("tm_tool_bag");
        $tool_tbg = $mysqlModel_tbg->select_tbg();
        $tool_tbgJson = json_encode($tool_tbg);
        $this->assign('tool_tbgJson',$tool_tbgJson);
    }
}