<?
require_once "../classes/DBase.php";
if(isset($_POST['arr_data']) && !empty($_POST['arr_data'])) {
    if(is_array(json_decode($_POST['arr_data'])) && is_array(json_decode($_POST['arr_id']))){
        $arr_id = json_decode($_POST['arr_id']);
        $arr_data = json_decode($_POST['arr_data']);
        $table = $_POST['table'];
        $field = $_POST['field'];
        $array = array_combine($arr_id,$arr_data);
        //удалить
        if(isset($_POST['delete'])) {
            //$delete = new DeleteVar();
            foreach ($array as $id => $value) {
                DB::del($table,$id);
                //$delete->delete_var_prod($key, $field);
            }
            echo json_encode(true);
            return;
        }
        //обновить значение
        if(isset($_POST['save'])){
            foreach ($array as $key => $value) {
                $result = DB::updatePM("UPDATE $table SET $field='$value' WHERE id='$key'");
            }
            echo json_encode($result);
            return;
        }
    }elseif(is_string($_POST['arr_data'])){
        $data = $_POST['arr_data'];
        $table = $_POST['table'];
        $field = $_POST['field'];
        $array = array(
            "$field"=>$data
        );
        if(!empty($_POST['type'])){
            $id_type = $_POST['type'];
            $array['type_id'] = (int)$id_type;
        }else{
            $id_type = '';
        }

        $result = DB::insert(DB::insertSql($table,$array),$array);
        echo json_encode($result);
        return;
    }
}


