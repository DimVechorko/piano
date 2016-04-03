<?php
require_once "../classes/DBase.php";
switch ($_POST["form"]) {
    //вывод по фильтру
    case 'filter':
        $for_whom = isset($_POST['for_whom']) ? $_POST['for_whom'] : '';
        //Сортировка по назначению
        if ($for_whom == 'all') {
            $sql_for_whom = "SELECT id FROM catalog WHERE name_en IN ('dlya-obucheniya','dlya-professionalov','dlya-interera');";
            $result_for = DB::selectSql($sql_for_whom);
            //Кол-во элементов в массиве
            $count_array = count($result_for);
            //Строка состоящая из id секций назначанея
            $str_id_for = '';
            $i = 0;
            foreach ($result_for as $id_for) {
                $i++;
                if ($i < $count_array) {
                    $str_id_for .= $id_for['id'] . ',';
                } else {
                    $str_id_for .= $id_for['id'];
                }
            }
            //Формирование части выборки по назначению
            $add_sql_for = 'section IN(' . $str_id_for . ')';
        } else {
            $sql_for_whom = "SELECT id FROM catalog WHERE name_en IN ('$for_whom');";
            $result_for = DB::selectSql($sql_for_whom);
            //Кол-во элементов в массиве
            $count_array = count($result_for);
            //Строка состоящая из id секций назначанея
            $str_id_for = '';
            $i = 0;
            foreach ($result_for as $id_for) {
                $i++;
                if ($i < $count_array) {
                    $str_id_for .= $id_for['id'] . ',';
                } else {
                    $str_id_for .= $id_for['id'];
                }
            }
            //Формирование части выборки по назначению
            $add_sql_for = 'section IN(' . $str_id_for . ')';
        }
        //Сортировка по типу
        $array_type = isset($_POST['type']) ? json_decode($_POST['type']) : '';
        echo json_encode($array_type);
        if (!empty($array_type)) {
            $str_id_type = '';
            $count_array = count($array_type);
            $i = 0;
            foreach ($array_type as $id_type) {
                $i++;
                if ($i < $count_array) {
                    $str_id_type .= $id_type . ',';
                } else {
                    $str_id_type .= $id_type;
                }
            }
            $sql = 'SELECT id FROM catalog WHERE parent IN($str_id_type)';
            //$result_type = DB::selectSql($sql);
            $str_id_type_new = '';
            $count_array = count($result_type);
            $i = 0;
            foreach ($result_type as $id_type) {
                $i++;
                if ($i < $count_array) {
                    $str_id_type_new .= $id_type['id'] . ',';
                } else {
                    $str_id_type_new .= $id_type['id'];
                }
            }
            $add_sql_type = ' AND section IN('.$str_id_type_new.')';
        }else{
            $add_sql_type = '';
        }
        //Сортировка по фабрике
        if (isset($_POST['factory'])) {
            switch ($_POST['factory']) {
                case 'brd1':
                    $factory = '11';
                    break;
                case 'brd2':
                    $factory = '7,8';
                    break;
                case 'brd3':
                    $factory = '1,2';
                    break;
                case 'brd4':
                    $factory = '13,14';
                    break;
                case 'brd5':
                    $factory = '';
                    break;
                case 'brd6':
                    $factory = '';
                    break;
                case 'brd7':
                    $factory = '';
                    break;
                case 'brd8':
                    $factory = '12';
                    break;
                case 'brd9':
                    $factory = '9,10';
                    break;
                case 'brd10':
                    $factory = '';
                    break;
                default:
                    $factory = '';

            }
            if (!empty($factory)) {
                $str_id_factory = ' AND factory_id IN (' . $factory . ')';
            } else {
                $str_id_factory = '';
            }
        }
        //Формирование общего запроса
        $sql = "SELECT * FROM price WHERE $add_sql_for $add_sql_type $str_id_factory";
        //echo json_encode($sql);
        //$result = DB::selectSql($sql);
        break;

    // редактирование лучших и скрытых из каталога
    case 'tags':
        $var = array($_POST['attr'] => $_POST['val']);
        $result = DB::update(DB::updateSql("price", $var), $var, $_POST['id']);
        echo json_encode($result);
        break;

    case 'edit':
        echo json_encode(DB::selectID($_POST["table"], $_POST["id"]));
        break;

    case 'savesortmenu':
        $table = $_POST["table"];
        $data = $_POST["array"];
        $menu = json_decode($data, true);
        $readbleArray = ParseJson::parseJsonArray($menu);
        $a = 1;
        foreach ($readbleArray as $k => $v) {
            $array = array("nn" => $a, "parent" => $readbleArray[$k]["parentID"]);
            DB::update(DB::updateSql($table, $array), $array, $readbleArray[$k]["id"]);
            $a++;
        }
        break;

    case 'savesortprice':
        $data = $_POST["array"];
        $prices = json_decode($data, true);
        foreach ($prices as $price) {
            $array = array("nn" => $price["nn"]);
            $result = DB::update(DB::updateSql("price", $array), $array, $price["id"]);
            echo json_encode($result);
        }
        break;
    case 'savesort':
        $data = $_POST["data"];
        $menu = json_decode($data, true);
        $readbleArray = ParseJson::parseJsonArray($menu);
        $a = 1;
        $res = array();
        foreach ($readbleArray as $k => $v) {
            if ($_POST["table"] == "catalog") {
                $res[] = DB::saveSort($_POST["table"], array("parent" => $readbleArray[$k]["parentID"], "nn" => $a), $readbleArray[$k]["id"]);
                $a++;
            }
            if ($_POST["table"] == "exclusive") {
                $res[] = DB::saveSort($_POST["table"], array("parent" => $readbleArray[$k]["parentID"], "nn" => $a), $readbleArray[$k]["id"]);
                $a++;
            }
            if ($_POST["table"] == "collection") {
                $res[] = DB::saveSort($_POST["table"], array("parent" => $readbleArray[$k]["parentID"], "nn" => $a), $readbleArray[$k]["id"]);
                $a++;
            }
            if ($_POST["table"] == "price") {
                $res[] = DB::saveSort($_POST["table"], array("nn" => $a), $readbleArray[$k]["id"]);
                $a++;
            }
        }
        echo json_encode($res);
        break;

    case 'editDefStatus':
        DB::updatePM("UPDATE `status-zakaz` SET `default`='0'");
        $array = array("default" => 1);
        $res = DB::update(DB::updateSql("status-zakaz", $array), $array, $_POST['id']);
        echo json_encode($res);
        break;

    case 'sizes':
        $array = array(
            "height" => $_POST['height'],
            "width" => $_POST['width'],
        );
        $result = DB::insert(DB::insertSql($_POST['table'], $array), $array);
        echo json_encode($result);
        break;

    case 'delete':
        if (isset($_POST['arr_data'])) {
            $arr_sizes = json_decode($_POST['arr_data']);
            foreach ($arr_sizes as $key => $id) {
                $result = DB::del($_POST['table'], $id);
            }
        } else {
            $result = 'значение значение arr_data';
        }
        echo json_encode($result);
        break;

    case 'save_input':
        if (isset($_POST['arr_id'])) {
            $arr_id = json_decode($_POST['arr_id']);
            $arr_data = json_decode($_POST['arr_data']);
            $array = array_combine($arr_id, $arr_data);
            foreach ($array as $key => $value) {
                $array = array(
                    "name" => $value,
                );
                $result = DB::update(DB::updateSql($_POST['table'], $array), $array, $key);
            }
            echo json_encode($result);

        }
        break;

    case 'moreInfo':
        if (isset($_POST['id'])) {
            //$result = DB::selectParam('price','id',$_POST['id'],false,false);
            $id = $_POST['id'];
            $result = DB::selectSql("
                                    SELECT pr.id, pr.name, pr.included_price, pr.img, ip.id as ip_id, ip.id_size, ip.id_module, ip.sale, ip.price, ip.price_old, m.name as module_name
                                    FROM price as pr
                                    RIGHT JOIN info_prod as ip ON pr.id = ip.id_price
                                    RIGHT JOIN modules as m ON m.id = ip.id_module
                                    WHERE pr.id = $id  order by price ASC
            ");
            //$result[0]['included_price'] = unserialize($result[0]['included_price']);
            //$result[0]['sizes'] = unserialize($result[0]['sizes']);
            foreach ($result as $key => $val) {
                $result[$key]['img'] = unserialize($val['img']);
                $result[$key]['included_price'] = unserialize($val['included_price']);

                $result_name_sizes = DB::selectParam('sizes', 'id', $val['id_size'], false, false);
                $sizes = $result_name_sizes[0]['height'] . 'x' . $result_name_sizes[0]['width'];
                $result[$key]['size'] = $sizes;

                $arr_name_included_price = array();
                foreach ($result[$key]['included_price'] as $value1) {
                    $name_included_price = DB::selectParam('included_price', 'id', $value1, false, false);
                    array_push($arr_name_included_price, $name_included_price[0]['name']);
                }
                $result[$key]['included_price'] = array_combine($result[$key]['included_price'], $arr_name_included_price);
            }
            echo json_encode($result);
        }
        break;

}