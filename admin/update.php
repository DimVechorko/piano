<? include "controller/function.php";
$param = "price";
$search = false;
if (isset($_POST['go'])) {
	DB::updatePM("UPDATE price SET kol='0'");
	$results = Price::importPrice($_FILES);
	foreach ($results as $result) {
		$res_tmp = DB::selectParam($param,"nomer",$result['nomer']);
		if (!$res_tmp) {
			$search[] = array("nomer"=>$result['nomer']);
		}
		DB::updatePM("UPDATE price SET kol='{$result['kol']}' WHERE nomer = '{$result['nomer']}'");
	}
}
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_f = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Обновление прайс листа</h1>
					</div>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-6">
								<div class="panel panel-default">
									<div class="panel-heading font-bold">Обновление прайс-листа</div>
									<div class="panel-body">
										<div class="m-b-sm">
											<div class="btn-group btn-group-justified">
												<form method="post" enctype="multipart/form-data">
													<div class="form-group">
														<input ui-jq="filestyle" name="csv" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="files"  accept="text/csv" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
													</div>
													<input type="hidden" name="go" value="update">
													<div type="button" class="btn btn-success w-full button pull-right">Обновить</div>
												</form>
											</div>
										</div>
									</div>
									<?
										if (isset($_POST['go'])) {
											echo "<div class=\"panel-footer\"><p>Прайс-лист обновлен.</p>";
											if ($search) {
												foreach ($search as $s) {
													?>
													<p><?=$s['nomer']?> - не найден в базе</p>
													<?
												}
											}
											?></div><?
										}
									?>
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