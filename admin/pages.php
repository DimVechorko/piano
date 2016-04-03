<? include "controller/function.php";
$table = "section";
$records = false;
$title = "Каталог продукции";

if (isset($_POST["go"])) {
    if ($_POST["name_en"]) { $url = Rename::replace($_POST["name_en"]); } else { $url = Rename::replace($_POST["name_ru"]); }
    $save = array(
        "parent"=>$_POST["section"],
        "name_ru"=>$_POST["name_ru"],
        "name_en"=>$url
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

if (isset($_POST["pages"])) {
    $array = array(
        "name"=>$_POST["name"],
        "title"=>$_POST["title"],
        "description"=>$_POST["description"],
        "keywords"=>$_POST["keywords"],
        "text"=>$_POST["text"]
    );
//	var_dump($array);
	if ($_POST["pages"] == "insert") {
        $array += array("section"=>$_POST["section"]);
        DB::insert(DB::insertSql("pages",$array),$array);
        header("Location: ".$_SERVER['REQUEST_URI']);
	} else {
        DB::update(DB::updateSql("pages",$array),$array,$_POST["section"]);
        header("Location: ".$_SERVER['REQUEST_URI']);
	}
}

if (isset($_GET["delete"])) {
    DB::del($_GET["title"],$_GET["delete"]);
    header("Location: pages.php");
}

if (isset($_GET["id"])) {
    $records = DB::selectParam("pages","section",$_GET["id"])[0];
    $sectionName = DB::selectID("section",$_GET["id"])[0]["name_ru"];
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
                        <h4 class="modal-title" id="myModalLabel">Раздел</h4>
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
                            <label>Url</label>
                            <input type="text" class="form-control m-b" placeholder="Url" name="name_en">
                            <input type="hidden" name="go" value="save">
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
    <?
    include "view/header.php";
	$active_m = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col w-xl bg-white-only b-l bg-auto no-border-xs">
					<div class="padder-md">
						<div class="m-b text-md m-t font-bold">Все страницы</div>
						<div ui-jq="nestable" class="dd">
                            <? DB::viewCatLi(DB::getCat($table),0,$table); ?>
						</div>
						<button type="button" class="btn btn-success w-full nestable_save" data-table="<?=$table?>">Сохранить сортировку</button>
					</div>
				</div>
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Страницы</h1>
					</div>
					<div class="m-b-sm">
						<div class="btn-group btn-group-justified">
							<a class="btn btn-primary section-js" data-toggle="modal" data-target=".<?=$table?>"><i class="fa fa-plus"></i> Добавить раздел</a>
							<a class="btn btn-info subsection-js" data-toggle="modal" data-target=".<?=$table?>"><i class="fa fa-plus"></i> Добавить подраздел</a>
						</div>
					</div>
					<div class="wrapper-md">
						<? if (isset($_GET["id"])) :?>
							<form method="post">
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-default">
											<div class="panel-heading font-bold">Настройки страницы: <?=$sectionName?></div>
											<div class="panel-body">
												<div class="form-group">
													<label>Заголовок</label>
													<input type="text" class="form-control m-b required-js" name="name" value="<?=(isset($records["name"]))?$records["name"]:""?>">
													<label>Meta-Title</label>
													<input type="text" class="form-control m-b required-js" name="title" value="<?=(isset($records["title"]))?$records["title"]:""?>">
													<label>Meta-Description</label>
													<input type="text" class="form-control m-b" name="description" value="<?=(isset($records["description"]))?$records["description"]:""?>">
													<label>Meta-Keywords</label>
													<input type="text" class="form-control m-b" name="keywords" value="<?=(isset($records["keywords"]))?$records["keywords"]:""?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-default">
											<div class="panel-heading font-bold">Текст</div>
											<div class="panel-body">
												<div id="summernote" ui-jq="summernote" ui-options="{lang: 'ru-RU', height:200, minHeight: null, maxHeight: null, focus:true}"><?=(isset($records["text"]))?$records["text"]:"Введите текст"?></div>
												<textarea name="text" class="hidden"><?=(isset($records["text"]))?$records["text"]:""?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
                                        <input type="hidden" name="section" value="<?=(isset($records["id"]))?$records["id"]:$_GET['id']?>">
                                        <input type="hidden" name="pages" value="<?=($records)?"update":"insert"?>">
										<div class="btn btn-success button listsave">Сохранить</div>
									</div>
								</div>
							</form>
						<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>