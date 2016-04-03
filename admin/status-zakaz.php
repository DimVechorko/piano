<? include "controller/function.php";
$table = "status-zakaz";
if (isset($_POST["go"])) {
    $array = array("name"=>$_POST['name'],"color"=>$_POST['color']);
    if ($_POST["go"] == "save") {
        $array += array("default"=>0);
        DB::insert(DB::insertSql($table,$array),$array);
        header("Location: ".$_SERVER['REQUEST_URI']);
	} else {
        $id = $_POST['go'];
        DB::update(DB::updateSql($table,$array),$array,$id);
        header("Location: ".$_SERVER['REQUEST_URI']);
	}
}

if (isset($_GET["delete"])) {
    DB::del($_GET["title"],$_GET["delete"]);
    header("Location: news.php");
}

$records = DB::select($table);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed">
    <div class="modal <?=$table?> fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Статус</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <label>Название</label>
                            <input type="text" class="form-control m-b" placeholder="Заказано" name="name">
                            <label>Цвет</label>
                            <select name="color" class="form-control m-b">
                                <option value="success">success</option>
                                <option value="default">default</option>
                                <option value="warning">warning</option>
                                <option value="info">info</option>
                                <option value="primary">primary</option>
                                <option value="danger">danger</option>
                                <option value="dark">dark</option>
                            </select>
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
	$active_h = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Статусы заказов</h1>
					</div>
					<div class="wrapper-md">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><?=($records==false)?"Нет статусов":"Все статусы"?></div>
                                    <? if ($records != false) :?>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                                <tr>
                                                    <th style="width:30px;">По умочанию</th>
                                                    <th>Название</th>
                                                    <th>Цвет</th>
                                                    <th style="width:84px;"></th>
                                                </tr>
                                            </thead>
                                            <?
                                            foreach ($records as $record) {
                                                ?>
                                                <tr>
                                                    <td><input type="radio" name="default" value="<?=$record["default"]?>" <?=($record["default"])?"checked":""?> data-id="<?=$record["id"]?>"/></td>
                                                    <td><?=$record["name"]?></td>
                                                    <td><button class="btn btn-sm btn-<?=$record["color"]?> w-xs"><?=$record["name"]?></button></td>
                                                    <td>
                                                        <button class="btn btn-xs btn-info edit"
                                                                data-id="<?=$record["id"]?>"
                                                                data-title="<?=$table?>" data-toggle="modal"
                                                                data-target=".<?=$table?>"><i class="icon-pencil"></i></button>
                                                        <a href="?delete=<?=$record["id"]?>&title=<?=$table?>" class="btn
                                                        btn-xs
                                                        btn-danger" onclick="return confirm('Удалить?');"><i
                                                                class="icon-close"></i></a>
                                                    </td>
                                                </tr>
                                                <?
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
						<button class="btn m-b-xs btn-success" data-toggle="modal" data-target=".<?=$table?>">Добавить статус</button>
                        <br><br><br><br>
                        <smal>* шаблоны цветов</smal><br><br>
                        <button class="btn btn-sm btn-success w-xs">success</button><br>
                        <button class="btn btn-sm btn-default w-xs">default</button><br>
                        <button class="btn btn-sm btn-warning w-xs">warning</button><br>
                        <button class="btn btn-sm btn-info w-xs">info</button><br>
                        <button class="btn btn-sm btn-primary w-xs">primary</button><br>
                        <button class="btn btn-sm btn-danger w-xs">danger</button><br>
                        <button class="btn btn-sm btn-dark w-xs">dark</button><br>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>