<?php
	 require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
	 
	 $type = $_POST['localname'];
     $twOrderId=$_POST['twOrderId'];
     $mysqlMode4 = new Model("tm_dev_location");

     //大工具查询
     $help = $mysqlMode4->help_tool_big($twOrderId);
     $tmpArr1 = array();
     foreach ($help as $key => $value) {
     	$twtlId = $value['twtlId'];
     	$tmpArr1[$twtlId][0] = explode(",", rtrim($value['twtlDetail'],","));   //取出工具编号
     	$tmpArr1[$twtlId][1] = explode(",",rtrim($value['twtltGPSCodes'],","));    //取出定位器
     	$tmpArr1[$twtlId][2] = $value['twtlToolId'];    //保留工具ID
     	$tmpArr1[$twtlId][3] = $value['twtlName'];      //保留工具名称
     }
     $tmpArr2=$tmpArr1;
     foreach ($tmpArr1 as $key => $value) {
        $detailId = $value[0][0];
        foreach($value[1] as $K => $V){
            $tmpArr2[$key][1][$K] = $mysqlMode4->local_tool_big($detailId);     //根据详情工具查出定位信息
            $tmpArr2[$key][1][$K]['twtlDetail'] = $value[0][$K];                //把工具编号和查出的定位器信息对应
            $tmpArr2[$key][1][$K]['twtlToolId'] = $value[2];                    //保留工具ID
            $tmpArr2[$key][1][$K]['twtlName'] = $value[3];                      //保留工具名称
        }
     }
     $local_All_big=array(); //构造数组保存以上信息
     foreach ($tmpArr2 as $key => $value) {
        foreach ($value[1] as $K => $V) {
            array_push($local_All_big, $V);
        }
     }
	 //echo json_encode($local_All_big); //工单所有大工具信息（包含无定位信息）
	 //以上为大工具

	 //人员查询
     $type = 1;
     $local_All_person_only = $mysqlMode4->LocalMobile($type,$twOrderId);     //只包含拥有定位器人员
     //echo json_encode($local_All_person_only);

     $local_All_worker = $mysqlMode4->localAllWorker($twOrderId); //所有施工人员
        foreach ($local_All_worker as $key => $value) {
            $local_All_worker[$key]['twamPersonId'] = $value['twkePersonId'];
            $local_All_worker[$key]['twamName'] = $value['pManageName'];
            $local_All_worker[$key]['twamUserJobName'] = "施工人员";
            $local_All_worker[$key]['twamId'] = $value['twkeId'];
        }
     //echo json_encode($local_All_worker);//所有施工人员

     $local_worker = $mysqlMode4->localWorker($twOrderId);  //只拥有定位器的施工人员
     foreach ($local_worker as $key => $value) {
        $local_worker[$key]['twamPersonId'] = $value['twkePersonId'];
        $local_worker[$key]['twamName'] = $value['pManageName'];
        $local_worker[$key]['twamUserJobName'] = "施工人员";
     }
     $local_All_person_gps = array_merge($local_All_person_only,$local_worker);
        // $this->assign('local_All_person_gps', $local_All_person_gps);
        // $this->assign('local_worker', $local_worker);

     //查询工单中所有核心人员的信息
     $adminstratorsAll = $mysqlMode4->Findadminstrators($twOrderId);
     $local_All_person = $local_All_person_only;
     $tmp_admin = $local_All_person;   //保存核心人员临时信息
     foreach ($adminstratorsAll as $key => $value) {
        $sign = 0;
        foreach ($tmp_admin as $K => $V) {
            if ($V['twamId'] != $value['twamId']) {
                $sign++;
            }
        }
        if ($sign == count($tmp_admin)) array_push($local_All_person, $value);
     }
     $local_All_person = array_merge($local_All_person,$local_All_worker);
     // $this->assign('local_All_personJson', $local_All_personJson);
     //local_All_person所有核心人员，包含未拥有定位器人员
     //以上为查询核心人员

     //工具包即小工具查询
     $type = 3;
     $local_All_small = $mysqlMode4->LocalMobile($type,$twOrderId);
     $local_All_smallJson = json_encode($local_All_small);

     //综合过程1,包含无定位信息
     $sum1 = array();
     $sum1[0] = $local_All_big;
     $sum1[1] = $local_All_person;
     $sum1[2] = $local_All_small;
     // $sum1Json = json_encode($sum1);
     // $this->assign('sum1Json', $sum1Json);

     //综合过程2,只包含含定位器的工具及人员的信息
     $local_All_big_only=$local_All_big;
     foreach ($local_All_big_only as $key => $value) {    //去除无定位信息的大工具
        if (!isset($value['dev_imei'])) {
            unset($local_All_big_only[$key]);
        }
     }
     // $local_All_big_onlyJson = json_encode($local_All_big);
     // $this->assign('local_All_big_onlyJson', $local_All_big_onlyJson); //工单所有大工具信息（包含无定位信息）
     $sum2 = array();
     $sum2[0] = $local_All_big;
     $sum2[1] = $local_All_person_only;
     $sum2[2] = $local_All_small;
     // $sum2Json = json_encode($sum2);
     // $this->assign('sum2Json', $sum2Json);

     $adminArr =  array();
     foreach ($local_All_person as $key => $value) {
        if ($value['twamUserJobName'] == "主体作业负责人") {
            $adminArr = $value;
        }
     }
     //$this->assign('adminArr', $adminArr);

     $data = array();
     $data['local_All_big'] = $local_All_big;
     $data['local_All_person_only'] = $local_All_person_only;
     $data['local_All_worker'] = $local_All_worker;
     $data['local_All_person_gps'] = $local_All_person_gps;
     $data['local_worker'] = $local_worker;
     $data['local_All_personJson'] = $local_All_person;
     $data['local_All_smallJson'] = $local_All_small;
     $data['sum1Json'] = $sum1;
     $data['local_All_big_onlyJson'] = $local_All_big_only;
     $data['sum2Json'] = $sum2;
     $data['adminArr'] = $adminArr;
     echo json_encode($data);