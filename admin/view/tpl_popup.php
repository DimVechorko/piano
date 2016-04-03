
<div class="modal marka fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="../controller/inc_add_category.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Раздел</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Введите название раздела</label>
						<input type="text" class="form-control m-b" placeholder="Название" name="names">
						<label>Введите Title</label>
						<input type="text" class="form-control m-b" placeholder="Title" name="title">
						<label>Введите Description</label>
						<input type="text" class="form-control m-b" placeholder="Description" name="description">
						<label>Введите Keywords</label>
						<input type="text" class="form-control m-b" placeholder="Keywords" name="keywords">
						<label>Введите URL</label>
						<input type="text" class="form-control m-b" placeholder="URL" name="url">
						<input type="hidden" name="go" value="marka">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button" name="button_set_cat">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal editCat fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="../controller/inc_update_cat.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Редактировать категорию</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Выберите раздел</label>
                        <select name="marka" class="form-control m-b">
                            <?php foreach ($array_cat as $value) {?>
                                <option value="<?= $value["id"]?>"><?= $value["name_ru"]?></option>
                            <?}?>
                        </select>
                        <label>Введите название подраздела</label>
                        <input class="form-control m-b" placeholder="Название" name="names">
                        <label>Введите Title</label>
                        <input type="text" class="form-control m-b" placeholder="Title" name="title">
                        <label>Введите Description</label>
                        <input type="text" class="form-control m-b" placeholder="Description" name="description">
                        <label>Введите Keywords</label>
                        <input type="text" class="form-control m-b" placeholder="Keywords" name="keywords">
                        <label>Введите URL</label>
                        <input type="text" class="form-control m-b" placeholder="URL" name="url">
                        <input type="hidden" name="go" value="model">
                        <input type="hidden" name="edit" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success button">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal model fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="../controller/inc_add_subcategory.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Подраздел</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Выберите раздел</label>
						<select name="marka" class="form-control m-b">
							<?php foreach ($array_cat as $array_cat) {?>
								<option value="<?= $array_cat["id"]?>"><?= $array_cat["name_ru"]?></option>
							<?}?>
						</select>
						<label>Введите название подраздела</label>
						<input class="form-control m-b" placeholder="Название" name="names">
						<label>Введите Title</label>
						<input type="text" class="form-control m-b" placeholder="Title" name="title">
						<label>Введите Description</label>
						<input type="text" class="form-control m-b" placeholder="Description" name="description">
						<label>Введите Keywords</label>
						<input type="text" class="form-control m-b" placeholder="Keywords" name="keywords">
						<label>Введите URL</label>
						<input type="text" class="form-control m-b" placeholder="URL" name="url">
						<input type="hidden" name="go" value="model">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>




<div class="modal group fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Добавить группу товаров</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Введите группу</label>
						<input type="text" class="form-control m-b" placeholder="Название" name="names">
						<input type="hidden" name="go" value="group">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal colors fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Добавть цвета товаров</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Введите название(eng)</label>
						<input type="text" class="form-control m-b" placeholder="red" name="names">
						<input type="hidden" name="go" value="group">
					</div>
					<div class="container-fluid">
						<label>Введите код цвета</label>
						<input type="text" class="form-control m-b" placeholder="#ff000" name="rgb">
						<input type="hidden" name="go" value="colors">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal section fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Раздел</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Введите название раздела</label>
						<input type="text" class="form-control m-b" placeholder="Название" name="names">
						<input type="hidden" name="go" value="section">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal subsection fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Подраздел</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Выберите раздел</label>
						<select name="section" class="form-control m-b">
							<?php foreach ($section as $key => $value) {
				                ?><option value="<?=$section[$key]["id"]?>"><?=$section[$key]["value"]?></option><?
				            } ?>
						</select>
						<label>Введите название подраздела</label>
						<input class="form-control m-b" placeholder="Название" name="names">
						<input type="hidden" name="go" value="subsection">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal question fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Письмо<span></span></h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<h4><strong>Информация по отправившему запрос</strong></h4>
						<p class="name-js"><strong>Имя: </strong><span>Иван</span></p>
						<p class="email-js"><strong>E-mail: </strong><span>torredo@inbox.ru</span></p>
						<p class="phone-js"><strong>Телефон: </strong><span>89048588555</span></p>
						<p class="text-js"><strong>Вопрос: </strong><span>Как дела</span></p>
						<label>Введите ответ:</label>
						<textarea class="form-control m-b" name="feedback"></textarea>
						<input type="hidden" name="go" value="send">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Ответить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal delete_name fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form method="post" action="controller/inc_delete.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><strong>Удалить?</strong></h4>
				</div>
				<div class="modal-body">
						<input type="hidden" name="delete" value="id">
						<input type="hidden" name="table" value="">
                        <input type="hidden" name="zakaz_id" value="">
						<h4 class="modal_body_text"></h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">Нет</button>
					<button class="btn btn-danger button delete-zakaz">Да</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal client fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Добавить клиента</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Выберите фото</label>
						<span class="nowphoto"><br>Выбранное фото: <span></span></span>
						<input type="file" class="form-control m-b" placeholder="Выберите фото" name="photo" accept="image/jpeg,image/png,image/gif">
						<label>Введите имя</label>
						<input type="text" class="form-control m-b" placeholder="Сати Казанова" name="names">
						<label>Введите текст</label>
						<input type="text" class="form-control m-b" placeholder="Сати Казанова в платье glzn by galina zhondorova..." name="text">
						<label>Введите год</label>
						<input type="text" class="form-control m-b" placeholder="2014" name="year">
						<input type="hidden" name="go" value="save">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal press fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Добавить клиента</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Выберите логотип</label>
						<span class="nowphoto"><br>Выбранный логотип: <span></span></span>
						<input type="file" class="form-control m-b" placeholder="Выберите фото" name="photo1" accept="image/jpeg,image/png,image/gif">
						<label>Выберите фото</label>
						<span class="nowphoto1"><br>Выбранное фото: <span></span></span>
						<input type="file" class="form-control m-b" placeholder="Выберите фото" name="photo2" accept="image/jpeg,image/png,image/gif">
						<label>Введите текст</label>
						<input type="text" class="form-control m-b" placeholder="Силуэты в коллекции очень простые и свободные..." name="text">
						<input type="hidden" name="go" value="save">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- оформление клиентов -->
<div class="modal oform_klient fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="../controller/inc_update_user.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Оформление клиента</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Выберите оптовую скидку</label>
						<select name="opt" class="form-control m-b">
							<?php foreach ($array_opt as $opt_new_client){ ?>

								<option value="<?echo $opt_new_client['id'];?>"><? echo $opt_new_client['percent'];?></option>

								<?php ;} ?>
						</select>
						<label>Введите логин</label>
						<input type="text" class="form-control m-b" name="login">
						<label>Введите пароль</label>
						<input type="text" class="form-control m-b" name="pass">
						<input type="hidden" name="oform_klient" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- редактирование клиентов -->
<div class="modal edit_klient fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Редактирование клиента</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Выберите оптовую скидку</label>
						<select name="opt_edit" class="form-control m-b">
							<?
							foreach ($array_opt as $opt_all_clients) {
								?><option value="<?=$opt_all_clients['id']?>"><?=$opt_all_clients['percent']?></option><?
							}
							?>
						</select>
						<label>Введите логин</label>
						<input type="text" class="form-control m-b" disabled name="login_edit">
						<label>Введите пароль</label>
						<input type="password" class="form-control m-b" name="pass_edit">
						<input type="hidden" name="edit_klient" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--Добавление и редактирование оптовых скидок-->
<div class="modal opt fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="../controller/inc_insert_opt.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Оптовые скидки</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Название</label>
						<input type="text" class="form-control m-b" placeholder="Опт1" name="opt_name">
						<label>Значение</label>
						<input type="text" class="form-control m-b" placeholder="40" name="opt_value">
						<input type="hidden" name="go" value="save">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal opt2 fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="../controller/inc_update_opt.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Редактирование оптовых скидок</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<label>Название</label>
						<input type="text" class="form-control m-b" placeholder="Опт1" name="opt_name">
						<label>Значение</label>
						<input type="text" class="form-control m-b" placeholder="40" name="opt_value">
						<input type="hidden" name="go" value="save">
						<input type="hidden" name="edit" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-success button">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
</div>