<? include "controller/function.php";
$table = "clients";
$records = DB::select($table);
if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: ".$_SERVER['REQUEST_URI']);
}
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_y = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Клиенты</h1>
					</div>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading"><?=($records==false)?"Нет клиентов":"Все клиенты"?></div>
									<? if ($records != false) :?>
                                        <div class="table-responsive">
                                            <table class="table table-striped b-t b-light">
                                                <tr>
                                                    <td>Имя</td>
                                                    <td>Телефон</td>
                                                    <td>Email</td>
                                                    <td>Удалить</td>
                                                </tr>
                                                <?
                                                foreach ($records as $record) {
                                                    ?>
                                                    <tr>
                                                        <td><?=$record["name"]?></td>
                                                        <td><?=$record["phone"]?></td>
                                                        <td><?=$record["email"]?></td>
                                                        <td><a title="Удалить" href="?delete=<?=$record["id"]?>&title=<?=$table?>" class="btn btn-xs btn-danger" onclick="return confirm('Удалиь?');"><i class="fa fa-times"></i></a></td>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>