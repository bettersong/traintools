<?php
    require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
    $userId = $_POST['userId'];
    if(isset($_POST['date']))
        $date = $_POST['date'];
    else
        $date = date("Y-m-d");

    $mysqlModel = new Model("tm_dev_location");
    $type = $_POST['type'];
    if ($type == 1) {
        $local_info = $mysqlModel ->local_admin_history($userId,$date);
    }
    else
        $local_info = $mysqlModel ->local_worker_history($userId,$date);

    echo json_encode($local_info);
    