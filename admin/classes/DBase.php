<?php

require_once ("ConnectDB.php");

class Install extends ConnectDB {
    public static function select() {
        return DB::select("install");
    }
}

class DB extends ConnectDB {

    public static function deleteCartLogin($session) {
        $delete = parent::$DBH->prepare("DELETE FROM cart WHERE id_session='$session'");
        $delete->execute();
    }

    public static function select($table, $sort=NULL) {
        if (isset($sort) and $sort) { list($row,$s) = explode("|",$sort); $sorted = "ORDER BY  `$row` $s "; } else { $sorted = ""; }
        $select = parent::$DBH->prepare("SELECT * FROM  `{$table}` $sorted");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectSql($sql) {
        $select = parent::$DBH->prepare($sql);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            //return $result = $select->errorInfo();
            return $count;
        } else {
            return $result;
        }
    }

    public static function selectID($table,$id) {
        $select = parent::$DBH->prepare("SELECT * FROM `{$table}` WHERE id=$id");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectParam($table,$attr,$val,$sort=NULL,$limit=NULL) {
        if (isset($sort) and $sort) { list($row,$s) = explode("|",$sort); $sorted = "ORDER BY  `$row` $s "; } else { $sorted = ""; }
        $select = parent::$DBH->prepare("SELECT * FROM `{$table}` WHERE $attr='$val' $sorted $limit");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        $count = $select->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public static function selectAI($table) {
        $bd = self::$dbname;
        $select = parent::$DBH->prepare("SELECT auto_increment FROM information_schema.tables WHERE table_name='$table' AND table_schema='$bd'");
        $select->execute();
        $row = $select->fetch();
        $ai = $row['auto_increment'];
        return $ai;
    }

    public static function  insertSql($table,$arr) {
        $sql = "INSERT INTO `".$table."` (";
        $i=1;$j=1;
        foreach ($arr as $k=>$v) {
            if (count($arr)==$i) { $f=""; } else {$f=",";}
            $sql .= '`'.$k.'`'.$f;
            $i++;
        }
        $sql .=") VALUES (";
        foreach ($arr as $k=>$v) {
            if (count($arr)==$j) { $f=""; } else {$f=",";}
            $sql .= ":".$k.$f;
            $j++;
        }
        $sql .=")";

        return $sql;
    }

    public static function insert($sql,$arr) {
        $insert = parent::$DBH->prepare($sql);
        foreach ($arr as $k=>$v) { $insert->bindParam(':'.$k , Rename::trimStr($v)); }
        $insert->execute();
        //$result = self::$DBH->lastInsertId();
        $result = $insert->errorInfo();
        return $result;
    }

    public static function updateSql($table,$arr) {
        $sql = "UPDATE `".$table."` SET ";
        $i=1;
        foreach ($arr as $k=>$v) {
            if (count($arr)==$i) { $f=""; } else {$f=",";}
            $sql .= "`".$k."`=:".$k.$f;
            $i++;
        }
        $sql .= " WHERE id=:id";
        return $sql;
    }

    public static function update($sql,$arr,$id) {
        $update = parent::$DBH->prepare($sql);
        $update->bindParam(':id' , $id);
        foreach ($arr as $k=>$v) {
            $update->bindParam(':'.$k , Rename::trimStr($v));
        }
        $result = $update->execute();
        if ($result) {
            return $result;
        } else {
            //return $update->errorInfo();
            //return false;
        }
    }

    public static function updatePM($sql) {
        $update = parent::$DBH->prepare($sql);
        $result = $update->execute();
        //$result = $update->errorInfo();
        return $result;
    }

    public static $arrayDeleteCat = array();

    public static  function arrCatDelete ($arr,$id) {
        if(empty($arr[$id])) { return false; }
        foreach ($arr[$id] as $record) {
            self::$arrayDeleteCat[] = array("id"=>$record["id"]);
            self::arrCatDelete($arr,$record["id"]);
        }
        return self::$arrayDeleteCat;
    }

    public static function deleteCart($id) {
        $select = parent::$DBH->prepare("DELETE FROM `cart` WHERE id=$id");
        $select->execute();
    }
    public static function deleteOther($table,$field,$id) {
        $select = parent::$DBH->prepare("DELETE FROM `$table` WHERE $field=$id");
        $result = $select->execute();
        if($result == true) {
            return $result;
        }else{
            $result = $select->errorInfo();
            return $result;
        }
    }

    public static function del($table,$id) {
        if ($table=="catalog") {
            $thisCat = DB::selectID("catalog",$id);
            self::$arrayDeleteCat[] = array("id"=>$thisCat[0]["id"]);
            DB::arrCatDelete(DB::getCat("catalog"), $id);
            $arrayDelete = self::$arrayDeleteCat;
            foreach ($arrayDelete as $rec) {
                $price = DB::selectParam("price", "section", $rec["id"]);
                if ($price) {
                    foreach ($price as $record) {
                        if ($record["img"]) {
                            if (file_exists("../".$record["img"])) {
                                unlink("../".$record["img"]);
                            }
                        }
                    }
                    $delete = parent::$DBH->prepare("DELETE FROM price WHERE section={$rec["id"]}");
                    $delete->execute();
                }
                $delete = parent::$DBH->prepare("DELETE FROM catalog WHERE id={$rec["id"]}");
                $delete->execute();
            }
        } else if ($table=="section") {
            $thisCat = DB::selectID("section",$id);
            self::$arrayDeleteCat[] = array("id"=>$thisCat[0]["id"]);
            DB::arrCatDelete(DB::getCat("section"), $id);
            $arrayDelete = self::$arrayDeleteCat;
            foreach ($arrayDelete as $rec) {
                $delete = parent::$DBH->prepare("DELETE FROM pages WHERE section={$rec["id"]}");
                $delete->execute();
                $delete = parent::$DBH->prepare("DELETE FROM section WHERE id={$rec["id"]}");
                $delete->execute();
            }
        } else if ($table=="price") {
            $photo = DB::selectID($table,$id)[0]["img"];
            if ($photo) { if (file_exists("../".$photo)) { unlink("../".$photo); } }
            $delete = parent::$DBH->prepare("DELETE FROM {$table} WHERE id=$id");
            $delete->execute();
        } else {
            $delete = parent::$DBH->prepare("DELETE FROM {$table} WHERE id=$id");
            $result  = $delete->execute();
            return $result;
        }
    }

    public static function saveSort($table,$arr,$id) {
        $sql = "UPDATE `$table` SET ";
        $i=1;
        foreach ($arr as $k=>$v) {
            if (count($arr)==$i) { $f=""; } else {$f=", ";}
            $sql .= "`".$k."`='".$v."'".$f;
            $i++;
        }
        $sql .=" WHERE id=$id";
        $update = parent::$DBH->prepare($sql);
        $res = $update->execute();
        return $res;
    }

    // фото
    public static function filesUpload($file,$table) {
        if ($file["error"] == UPLOAD_ERR_OK) {
            $dir = '../img/upload/'.$table.'/';
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $img = $dir.uniqid().".".$ext;
            move_uploaded_file($file['tmp_name'], $img);
            $img = str_replace('../', '', $img);
            return $img;
        } else {
            return false;
        }
    }

    // меню
    public static function getCat($table) {
        $select = parent::$DBH->prepare("SELECT * FROM `{$table}` ORDER BY nn ASC");
        $select->execute();
        $count = $select->rowCount();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        if ($count == 0) {
            return false;
        }
        $arr_cat = array();
        if ($count != 0) {
            foreach ($result as $results) {
                if(empty($arr_cat[$results['parent']])) {
                    $arr_cat[$results['parent']] = array();
                }
                $arr_cat[$results['parent']][] = $results;
            }
            return $arr_cat;
        }
    }

    public static function viewCatLi($arr,$parent,$table) {
        if ($table=="catalog") { $link = "production"; }
        else if ($table=="section") { $link = "pages"; }
        if(empty($arr[$parent])) { return; }
        if ($parent == 0) { echo '<ol class="dd-list">'; }
        else { echo '<ol class="dd-list">'; }
        foreach ($arr[$parent] as $arrays) {
            if (isset($_GET["id"]) AND $_GET["id"] == $arrays["id"] AND isset($_GET["table"]) AND $_GET["table"] == $table) {
                $style = 'style="color:red;"';
            } else {
                $style = '';
            }
            echo '<li class="dd-item" data-id="'.$arrays["id"].'" '.$style.'>
                  <span class="pull-right">
                      <a title="Перейти в категорию: '.$arrays["name_ru"].'" href="production.php?id='.$arrays['id'].'&table='.$table.'" class="btn btn-xs main btn-success"><i class="fa fa-link"></i></a>
                      <a title="Редактировать категорию: '.$arrays["name_ru"].'" class="btn btn-xs main btn-info edit" data-id="'.$arrays['id'].'" data-parent="'.$arrays['parent'].'" data-title="'.$table.'" data-toggle="modal" data-target=".'.$table.'"><i class="fa fa-pencil"></i></a>
                      <a title="Удалить категорию: '.$arrays["name_ru"].'" href="?delete='.$arrays["id"].'&title='.$table.'" class="btn btn-xs main btn-danger" onclick="return confirm(\'Удалить?\');"><i class="fa fa-times"></i></a>
                  </span>';
            echo '<div class="dd-handle">'.$arrays["name_ru"].'</div>';
            self::viewCatLi($arr,$arrays['id'],$table);
            echo '</li>';
        }
        if ($parent == 0) { echo '</ol>'; }
        else { echo '</ol>'; }
    }

    public static function viewCatOptions($arr,$parent, $level, $active=NULL) {
        if(empty($arr[$parent])) { return; }
        foreach ($arr[$parent] as $arrays) {
            if($active == $arrays['id']) {
                $selected = "selected=\"selected\"";
            } else {
                $selected = "";
            }
            echo '<option value="'.$arrays['id'].'" '.$selected.'>';
            for ($i=0;$i<$level;$i++) {
                echo "&nbsp;&nbsp;&nbsp;";
            }
            echo "-&nbsp;";
            echo $arrays["name_ru"].'</option>';
            self::viewCatOptions($arr, $arrays['id'], $level+1, $active);
        }
    }
}

class AttrValue extends ConnectDB {
    public static function conbine($attr,$value) {
        $data_attr = serialize(array_combine($attr, $value));
        return $data_attr;
    }
}

class Rename {
    public static function replace($str=null) {
        $str = self::trimStr($str);
        $str = self::translitIt($str);
        $str = self::replaceStr($str);
        return $str;
    }

    public static function translitIt($str) {
        $tr = array(
            "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
            "Д"=>"d","Е"=>"e","Ё"=>"e","ё"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
            "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
            "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
            "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
            "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
            "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
            "Q"=>"q","W"=>"w","E"=>"e","R"=>"r","T"=>"t",
            "Y"=>"y","U"=>"u","I"=>"i","O"=>"o","P"=>"p",
            "A"=>"a","S"=>"s","D"=>"d","F"=>"f","G"=>"g",
            "H"=>"h","J"=>"j","K"=>"k","L"=>"l","Z"=>"z",
            "C"=>"c","V"=>"v","B"=>"b","N"=>"n","M"=>"m", " "=>"-"
        );
        return strtr($str,$tr);
    }

    public static function trimStr($str) {
        $str = preg_replace('/[\s]{2,}/u',' ',$str);
        $str = trim($str) ;
        return $str;
    }

    public static function replaceStr($str) {
        $str = str_replace(' ','-', $str);
        $str = str_replace(',','', $str);
        $str = str_replace('.','', $str);
        $str = str_replace('/','', $str);
        return $str;
    }
}

class ParseJson {
    public static function parseJsonArray($jsonArray, $parentID = 0) {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray['children'])) {
                $returnSubSubArray = self::parseJsonArray($subArray['children'], $subArray['id']);
            }
            $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }
}

class Price extends ConnectDB {
    public static function importPrice($files) {
        $handle = fopen($files['csv']['tmp_name'], "r");
        $out = array();
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $out[]= array("nomer"=>$data[0],"kol"=>$data[1]);
        }
        fclose($handle);
        return $out;
    }

    function replaceNomer($nomer) {
        $nomer = str_replace(' ', '', $nomer);
        $nomer = str_replace('-', '', $nomer);
        $nomer = str_replace('.', '', $nomer);
        return $nomer;
    }
}

class DateFormat {
    public static function time($date) {
        list($dat,$tim) = explode(" ", $date);
        list($h,$m,$s) = explode(":",$tim);
        return $h.":".$m;
    }

    public static function date($date) {
        list($dat,$tim) = explode(" ", $date);
        return $dat;
    }

    public static function dateDMY($date) {
        $dat = self::date($date);
        list($y,$m,$d) = explode("-", $dat);
        return $d.".".$m.".".$y;
    }

//    public static function dateRu($date) {
//        $dat = self::date($date);
//        list($y,$m,$d) = explode("-", $dat);
//        switch
//        return $d.".".$m.".".$y;
//    }
}

$obj1 = new DB();
$obj2 = new ParseJson();
$obj3 = new Rename();
$obj4 = new Price();
