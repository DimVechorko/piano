<? include "controller/function.php";
if (isset($_POST["go"])) {
	if ($_POST["go"]=="arrmail") {
		DB::truncate("mailer");
		$handle = fopen($_FILES['csv']['tmp_name'], "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$arrInsert = array("email"=>$data[0]);
			DB::insert(DB::insertSql("mailer",$arrInsert),$arrInsert);
		}
		fclose($handle);
		header("Location: ".$_SERVER['REQUEST_URI']);
	} else {
		include "classes/class.phpmailer.php";
		$mailers = DB::select("mailer");
		foreach ($mailers as $mailer) {
			$mail = new PHPMailer();
			$mail->CharSet = 'utf-8';
			$mail->From = $_POST['email'];      // от кого
			$mail->FromName = $_POST['name'];   // от кого
			$mail->AddAddress($mailer['email']); // кому - адрес, Имя
			$mail->IsHTML(true);        // выставляем формат письма HTML
			$mail->Subject = $_POST['subject'];  // тема письма
			if ($_FILES['file']) {
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
			}
			$mail->Body = $_POST['text'];
			$mail->Send();
		}

		header("Location: ".$_SERVER['REQUEST_URI']);
	}
}
$records = DB::select("mailer");
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	include "view/tpl_popup_email.php";
	$active_l = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Рассылка прайслиста и новостей"?></h1>
					</div>
					<div class="wrapper-md">
						<form method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Все поля обязательны для заполнения!</div>
										<div class="panel-body">
											<div class="form-group">
												<div class="col-lg-12">
													<label>Имя отправителя</label>
													<input type="text" class="form-control m-b required-js" name="name" value="">
													<label>Email отправителя</label>
													<input type="text" class="form-control m-b required-js" name="email" value="">
													<label>Тема письма</label>
													<input type="text" class="form-control m-b required-js" name="subject" value="">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading font-bold">Текст письма</div>
												<div class="panel-body">
													<div id="summernote" ui-jq="summernote" ui-options="{lang: 'ru-RU', height:200, minHeight: null, maxHeight: null, focus:true}">Введиет текст письма</div>
													<textarea name="text" class="hidden"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading font-bold">Прикрепить файл:</div>
												<div class="panel-body">
													<input ui-jq="filestyle" name="file" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="files_send"  accept="text/csv" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" name="go" value="send">
									<div class="btn btn-success button listsave">Отправить</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col w-lg bg-light lter b-l bg-auto">
					<div class="wrapper">
						<button class="btn w-full btn-success" data-title="<?=$param?>" data-toggle="modal" data-target=".updateemail"><i class="glyphicon glyphicon-download-alt"></i> Загрузить адреса</button>
						<ul class="list-group no-bg">
							<?
								if ($records) {
									foreach ($records as $record) {
										?><li class="list-group-item min"><small><?=$record['email']?></small></li><?
									}

								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>