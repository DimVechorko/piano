<? include "controller/function.php";
$table = "news";
if (isset($_POST["go"])) {
    $array = array("date"=>$_POST['date'],"title"=>$_POST['title'],"text"=>$_POST['text'],"longtext"=>NULL,"img"=>NULL);
    if ($_POST["go"] == "save") {
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

$records = DB::select($table,"date|DESC");
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed">
    <div class="modal <?=$table?> fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Новость</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <label>Дата</label>
							<div class="input-group date m-b">
								<input type="text" class="form-control" name="date" ui-jq="datetimepicker" ui-options="{format: 'YYYY-MM-DD HH:mm:ss', locale: 'ru'}">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
                            <label>Название</label>
                            <input type="text" class="form-control m-b" placeholder="Новость" name="title">
                            <label>Текст</label>
                            <input type="text" class="form-control m-b" placeholder="Не большой текст" name="text">
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
	$active_n = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Все новости</h1>
					</div>
					<div class="wrapper-md">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><?=($records==false)?"Нет новостей":"Новости"?></div>
                                    <? if ($records != false) :?>
                                    <div class="table-responsive">
<!--                                        <table class="table table-striped b-t b-light" ui-jq="dataTable" ui-options="{bPaginate: false, bFilter: false, bInfo: false, order: [[ 0, 'desc' ]], aoColumns: [null,{bSortable:false},{bSortable:false},{bSortable:false,sWidth: '50px'}]}" style="width: 100%; margin: 0px;">-->
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                                <tr>
                                                    <th width="20">Дата</th>
                                                    <th>Заголовок</th>
                                                    <th>Текст</th>
                                                    <th style="width:84px;"></th>
                                                </tr>
                                            </thead>
                                            <?
                                            foreach ($records as $record) {
                                                ?>
                                                <tr>
                                                    <td><?=DateFormat::dateDMY($record["date"])?></td>
                                                    <td><?=$record["title"]?></td>
                                                    <td><?=$record["text"]?></td>
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
						<button class="btn m-b-xs btn-success" data-toggle="modal" data-target=".<?=$table?>">Добавить новость</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>