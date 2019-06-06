<?php
class RealTimeLocalController extends Controller
{
    public function index()
    {   
        if(isset($_POST['date']))
            $date = $_POST['date'];
        else
    	    $date = "2018-11-12";
		
        $mysqlModel = new RealTimeLocalModel("local_record","pmanage","bmanage");
        $local1 = $mysqlModel ->LocalPerson($date);
        //$this->assign('local', $local);
        $local_TM = $mysqlModel ->LoaclTM($date);
        //$this->assign('local_TM', $local_TM);
        $local = array_merge($local1,$local_TM);
        unset($local[0]);
        unset($local[1]);
        //print_r($local);
        $this->assign('local', $local);

        $mysqlMode2 = new Model("bmanage");
        $bManage = $mysqlMode2 ->selectAll();
        $this->assign('bManage', $bManage);

        $mysqlMode3 = new RealTimeLocalModel("local_record","detail","toolslist");
        $localDevice = $mysqlMode3 ->LocalDevice($date);
        $this->assign('localDevice', $localDevice);
    }
    public function index_m()
    {   
        if(isset($_POST['date']))
            $date = $_POST['date'];
        else
            $date = "2018-11-12";
        
        $mysqlModel = new RealTimeLocalModel("local_record","pmanage","bmanage");
        $local = $mysqlModel ->LocalPerson($date);
        $this->assign('local', $local);

        $local_TM = $mysqlModel ->LoaclTM($date);
        $this->assign('local_TM', $loclocal_TMal);
        print_r($local);


        $mysqlMode2 = new Model("bmanage");
        $bManage = $mysqlMode2 ->selectAll();
        $this->assign('bManage', $bManage);

        $mysqlMode3 = new RealTimeLocalModel("local_record","detail","toolslist");
        $localDevice = $mysqlMode3 ->LocalDevice($date);
        $this->assign('localDevice', $localDevice);
    }
}