<?php
//echo json_encode('!DEL ZAKAZ');
require_once '../classes/DBase.php';
require_once '../classes/Login.php';
//var_dump($_POST);
if (isset($_POST['delete'], $_POST['table'])) {
    $id = intval($_POST['delete']);
    $table = $_POST['table'];
    $result = DB::del($table,$id);
    if($result == true) {
        $table = 'zakaz_count';
        $result_zc = DB::deleteOther($table,'zakaz_id',$id);
        //echo json_encode($result_zc);
        header("Location: ../zakaz.php");
    }
}