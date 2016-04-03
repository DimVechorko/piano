<?php
require_once "../classes/DBase.php";
//var_dump($_POST);
//var_dump($_FILES['image']);
$array_img = array();
$dir = '../img/';

//Категория
$section = isset($_POST['section']) ? $_POST['section']:'';
//Фабрика
$factory_select = isset($_POST['factory_select']) ? $_POST['factory_select']: '';
//Модель
$model = isset($_POST['model']) ? $_POST['model']:'';
//Длина
$length = isset($_POST['length']) ? $_POST['length']:'';
//Высота
$height = isset($_POST['height']) ? $_POST['height']:'';
$size_id = !empty($length) ? $length : $height;
//Цвета
$colors = serialize(isset($_POST['colors']) ? $_POST['colors']:'');
//ссылка на сайт производителя
$link = isset($_POST['url']) ? $_POST['url']:'';


if (isset($_POST['old_photo'])) {
    foreach ($_POST['old_photo'] as $image) {
        array_push($array_img, $image);
    }
}
if (isset($_POST['photos'])) {

        foreach ($_POST['photos'] as $n => $fileBody) {
            $fileName = uniqid();
            $url = $dir . $fileName;

            preg_match('#data:image\/(png|jpg|jpeg|gif);#', $fileBody, $fileTypeMatch);
            $fileType = $fileTypeMatch[1];

            $fileBody = preg_replace('#^data.*?base64,#', '', $fileBody);
            $fileBody = base64_decode($fileBody);
            $image = $fileName . '.' . $fileType;

            $path = '../img/' . $image;
            if (!file_exists($path)) {
                file_put_contents($url . '.' . $fileType, $fileBody);
            }
            array_push($array_img, $image);
        }
}

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $image = uniqid() . "." . $ext;
    array_unshift($array_img, $image);
    $target = $dir . $image;
    $tmp_name = $_FILES["image"]["tmp_name"];
    $path = '../img/' . $image;
    if (!file_exists($path)) {
        if (!move_uploaded_file($tmp_name, $target)) {
            die("Error loading photo ");
        } else {
            $load_img = true;
        }
    }
} elseif (!empty($_POST['old_image'])) {
    $image = $_POST['old_image'];
    array_unshift($array_img, $image);
}
$array_img = serialize($array_img);

$array = array(
    'section'=>$section,
    'factory_id'=>$factory_select,
    'model_id'=>$model,
    'size_id'=>$size_id,
    'colors'=>$colors,
    'link'=>$link,
    'img'=>$array_img
);

if (!empty($_POST['id_prod'])) {
    $id_prod = $_POST['id_prod'];
    $result = DB::update(DB::updateSql('price',$array),$array,$id_prod);
} else {
    $result = DB::insert(DB::insertSql('price',$array),$array);
}

if ($result != false) {
    header('Location:../production.php?id='.$section);
} else { echo $result;}
