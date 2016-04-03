<? include "controller/function.php";
$table = "provider";
if (isset($_POST["go"])) {
    $array = array(
        "name"=>$_POST['name'],
        "name_clients"=>$_POST['name_clients'],
        "discount"=>$_POST['discount'],
        "delivery"=>$_POST['delivery'],
        "comments"=>$_POST['comments']
    );
    if ($_POST["go"] == "save") {
        $array += array("update"=>"0000-00-00 00:00:00");
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
                        <h4 class="modal-title" id="myModalLabel">Поствщик</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <label>Название поставщика</label>
                            <input type="text" class="form-control m-b" placeholder="Акадия" name="name">
                            <label>Название для клиента</label>
                            <input type="text" class="form-control m-b" placeholder="МСК1" name="name_clients">
                            <label>Скидка на базовую стоимость</label>
                            <input type="text" class="form-control m-b" placeholder="0.10" name="discount">
                            <label>Срок доставки</label>
                            <input type="text" class="form-control m-b" placeholder="2 дн." name="delivery">
                            <label>Комментарий</label>
                            <input type="text" class="form-control m-b" placeholder="ФИО менеджера" name="comments">
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
    <div class="modal update fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Обновление прайс-листа</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <label>Загрузите файл CSV</label>
                            <div class="form-group">
                                <input ui-jq="filestyle" name="csv" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="files"  accept="text/csv" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                            </div>
                            <input type="hidden" name="go" value="update">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <div type="button" class="btn btn-success button">Обновить</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?
    include "view/header.php";
	$active_g = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Поставщики</h1>
					</div>
					<div class="wrapper-md">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><?=($records==false)?"Нет поставщиков":"Все поставщики"?></div>
                                    <? if ($records != false) :?>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                                <tr>
                                                    <th>Название</th>
                                                    <th>Название для клиента</th>
                                                    <th>Скидка на прайс</th>
                                                    <th>Доставка</th>
                                                    <th>Комментарии</th>
                                                    <th>Дата обновления</th>
                                                    <th style="width:170px;"></th>
                                                </tr>
                                            </thead>
                                            <?
                                            foreach ($records as $record) {
                                                ?>
                                                <tr>
                                                    <td><?=$record["name"]?></td>
                                                    <td><?=$record["name_clients"]?></td>
                                                    <td><?=$record["discount"]?></td>
                                                    <td><?=$record["delivery"]?></td>
                                                    <td><?=$record["comments"]?></td>
                                                    <td>
                                                        <?
                                                            if ($record["update"] == "0000-00-00 00:00:00") {
                                                                echo "не обновлялся";
                                                            } else {
                                                                echo DateFormat::dateDMY($record["update"])." в ".DateFormat::time($record["update"]);
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-xs btn-info edit"
                                                                data-id="<?=$record["id"]?>"
                                                                data-title="<?=$table?>" data-toggle="modal"
                                                                data-target=".<?=$table?>"><i class="icon-pencil"></i></button>
                                                        <a href="?delete=<?=$record["id"]?>&title=<?=$table?>" class="btn
                                                        btn-xs
                                                        btn-danger" onclick="return confirm('Удалить?');"><i
                                                                class="icon-close"></i></a>
                                                        <button class="btn btn-xs btn-success"
                                                                data-id="<?=$record["id"]?>" data-toggle="modal"
                                                                data-target=".update"><i class="glyphicon glyphicon-download-alt"></i> Обновить</button>
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
						<button class="btn m-b-xs btn-success" data-toggle="modal" data-target=".<?=$table?>">Добавить поставщика</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>