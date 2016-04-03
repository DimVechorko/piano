<? include "controller/function.php";
$table = "catalog";
$title = "Каталог продукции";
$records = false;

if (isset($_POST["go"])) {
    if ($_POST["name_en"]) { $url = Rename::replace($_POST["name_en"]); } else { $url = Rename::replace($_POST["name_ru"]); }
    $save = array(
        "parent"=>$_POST["section"],
        "name_ru"=>$_POST["name_ru"],
        "name_en"=>$url,
        "title"=>$_POST['title'],
        "desc"=>$_POST['desc'],
        "keywords"=>$_POST['keywords']
    );
	if ($_POST["go"] == "save") {
        $save += array("nn"=>DB::selectAI($table));
		DB::insert(DB::insertSql($table,$save),$save);
		header("Location: ".$_SERVER['REQUEST_URI']);
	} else {
		DB::update(DB::updateSql($table,$save),$save,$_POST['go']);
		header("Location: ".$_SERVER['REQUEST_URI']);
	}
}

if (isset($_GET["delete"])) {
    DB::del($_GET["title"],$_GET["delete"]);
	if (isset($_GET["act"]) and $_GET["act"]) {
		header("Location: production.php?id=".$_GET["act"]."&table=catalog");
	} else {
		header("Location: production.php");
	}
}

if (isset($_GET["id"])) {
	$id = $_GET["id"];
	//$records = DB::selectParam("price","section",$_GET["id"],"nn|ASC");
	$records = DB::selectSql("
							  SELECT pr.id, fc.name as factory, tp.name as type_name, md.name as model, sz.id as size_id, sz.length, sz.height, pr.img, pr.nn, pr.best, pr.hide
FROM price as pr 
JOIN factory as fc ON fc.id=pr.factory_id
JOIN type as tp ON tp.id= fc.type_id 
JOIN models as md ON md.id=pr.model_id
JOIN size as sz ON sz.id=pr.size_id
WHERE section=$id order by best DESC, hide ASC, nn ASC");
}
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<div class="modal <?=$table?> fade" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Группы товаров</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<label class="hidden_section">Введите раздел</label>
							<select name="section" class="form-control m-b hidden_section">
								<option value="0" selected="selected"></option>
                                <? DB::viewCatOptions(DB::getCat($table),0,0); ?>
							</select>
							<label>Введите название</label>
							<input type="text" class="form-control m-b required-js" placeholder="Название" name="name_ru">
							<label>Заголовок в браузере (Title)</label>
							<input type="text" class="form-control m-b" placeholder="Title" name="title">
							<label>Описание раздела (Description)</label>
							<input type="text" class="form-control m-b" placeholder="Description" name="desc">
							<label>Ключевые слова (Keywords)</label>
							<input type="text" class="form-control m-b" placeholder="Keywords" name="keywords">
							<label>Url</label>
							<input type="text" class="form-control m-b" placeholder="Url" name="name_en">
							<input type="hidden" name="go" value="save">
							<input type="hidden" name="edit" value="">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<div type="button" class="btn btn-success button">Сохранить</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<? include "view/header.php";
	$active_f = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col w-xl bg-white-only b-l bg-auto no-border-xs">
					<div class="padder-md">
						<div class="m-b text-md m-t font-bold">Меню каталога</div>
                        <div ui-jq="nestable" class="dd">
						    <? DB::viewCatLi(DB::getCat($table),0,$table); ?>
                        </div>
                        <button type="button" class="btn btn-success w-full nestable_save" data-table="<?=$table?>">Сохранить сортировку</button>
					</div>
				</div>
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Каталог продукции</h1>
					</div>
					<div class="m-b-sm">
						<div class="btn-group btn-group-justified">
							<a href="add_product.php" class="btn btn-success" ><i class="fa fa-plus"></i> Добавить товар</a>
						</div>
					</div>
					<div class="wrapper-md">
						<? if ($records != false) :?>
							<div class="row">
								<div class="col-lg-12">
                                    <ul class="sortable list">
                                        <?
                                        foreach ($records as $record) {
											$record['img'] = unserialize($record['img']);
                                        ?>
                                        <li class="list-group-item " draggable="true" data-id="<?=$record["id"]?>">
                                            <span class="pull-right">
                                                <a href="add_product.php?edit=<?=$record["id"]?>" title="Редактировать" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                                <a title="Удалить" href="?delete=<?=$record["id"]?>&title=price&act=<?=$_GET["id"]?>" class="btn btn-xs btn-danger" onclick="return confirm('Удалить?');"><i class="fa fa-times"></i></a><br>
                                                <div title="Скрыть из каталога"  class="btn btn-xs <?=($record['hide'])?'btn-success':'btn-default'?> m-t edit_tags" data-id="<?=$record["id"]?>" data-attr="hide" data-now="<?=$record['hide']?>"><i class="fa fa-eye-slash"></i></div>
                                                <a title="Лучшее" class="btn btn-xs <?=($record['best'])?'btn-success':'btn-default'?> m-t edit_tags" data-id="<?=$record["id"]?>" data-attr="best" data-now="<?=$record['best']?>"><i class="fa fa-star"></i></a>
                                            </span>
                                            <span class="pull-left"><i class="fa fa-sort text-muted fa m-r-sm"></i> </span>
                                            <div class="clear">
<!--                                                <div class="col-lg-4">-->
                                                        <img height="120" class="photo-product"
                                                            src="<?=($record['img'][0])?"img/".$record['img'][0]:"img/photo.jpg"?>"
                                                            title="<?=($record['img_title'])?$record['img_title']:""?>"
                                                            alt="<?=($record['img_alt'])?$record['img_alt']:""?>">
<!--                                                </div>-->
<!--                                                <div class="col-lg-8">-->
                                                    <!--Артикул: <strong><?/*=$record['nomer']*/?></strong><br>-->
                                                    Наименование: <strong><?=$record['type_name'].' '.$record['factory']?></strong><br>
                                                   <!-- Описание: <strong><?/*=$record['brand']*/?></strong><br>-->
                                                    Модель: <strong><?=$record['model']?></strong><br>
                                                    <!--Количество: <strong><?/*=$record['kol']*/?></strong><br>-->
<!--                                                </div>-->
                                            </div>
                                        </li>
                                    <?}?>
                                    </ul>
                                </div>
							</div>
						<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>