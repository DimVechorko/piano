var linklocation;
$(document).ready(function() {
	$('.app-content').css('display','none');
	$('.app-content').fadeIn(1000);

	$('.dd-list').find('a').each(function(){
		if($(this).data('parentdel')==0){$(this).hide();}
	});

	$('.nav a.transition').click(function(){
		event.preventDefault();
		linklocation = this.href;
		$('.app-content').fadeOut(500, redirectPage);
	});

    // скрытие меню
    setTimeout(function(){ $('.dd-item').each(function(){ $(this).find('button:first').click(); }); },1000);
    //

    $('input[name="type"]').change(function(){
        $('.step2 .step1-1').addClass('hidden');
        $('.step2 .step1-2').addClass('hidden');
        $('.step2 .step1-'+$(this).val()).removeClass('hidden');
    });

	// Редактирование
	$('.edit').click(function(){
        var el = $(this);
        if (el.data('title') == "catalog") {
            if (el.data('parent')==0) { $('.hidden_section').hide(); }
            else { $('.hidden_section').show(); }
            var value = "form=edit&table="+el.data('title')+"&id="+el.data('id');
        } else if (el.data('title') == "section") {
            if (el.data('parent')==0) { $('.hidden_section').hide(); }
            else { $('.hidden_section').show(); }
            var value = "form=edit&table="+el.data('title')+"&id="+el.data('id');
        } else {
            var value = "form=edit&table="+el.data('title')+"&id="+el.data('id');
        }
		edit(value,el.data('title'));
	});
    //

    // Редактирование статуса заказа по умолчанию
    $('input[name="default"]').change(function(){
        value = "form=editDefStatus&id="+$(this).data('id');
        edit(value,"statusDef");
    });
    //

    // Добавление удаление атрибутов
	$('.addattr').click(function(){
		var now = parseInt($(this).attr('data-idd'));
		var next = now+1;
		$(this).attr('data-idd', next);
		var tr = '<tr class="line">';
		tr += '<td><input class="form-control" name="attr[]" placeholder="Название"></td>';
		tr += '<td><input class="form-control" name="val[]" placeholder="Значение"></td>';
		tr += '<td class="catButt__i"><button type="button" class="btn btn-danger delattr"><i class="fa fa-minus-circle"></i></button></td>';
		tr += '</tr>';
		$(this).closest('table').find('tr:last').after(tr);

		$('.delattr').click(function() {
			var now = parseInt($(this).closest('.addAttr__i').find('.addattr').attr('data-idd'));
			var prew = now-1;
			$(this).closest('.addAttr__i').find('.addattr').attr('data-idd',prew);
			$(this).closest('tr.line').remove();
		});

	});
	$('.delattr').click(function() {
		var now = parseInt($(this).closest('.addAttr__i').find('.addattr').attr('data-idd'));
		var prew = now-1;
		$(this).closest('.addAttr__i').find('.addattr').attr('data-idd',prew);
		$(this).closest('tr.line').remove();
	});
    //

    // скрытие или показ подгрупп товаров
	$('.section-js').click(function(){ $('.hidden_section').hide(); });
	$('.subsection-js').click(function(){ $('.hidden_section').show(); });
    //

    // кнопка сохранить
	$('div.button').click(function() {
		$('body').find('form:not(this)').removeClass('error');
		var answer = validator($(this).closest('form').get(0));
		if(answer != false) {
			if ($(this).hasClass('listsave')) {
				//var sHTML = $('#summernote').code();
				$//('textarea[name="text"]').val(sHTML);
			}
			$(this).closest('form').submit();
		}
	});
    //

    // сортировка меню
    $('.nestable_save').click(function(){
        updateMenuSort($('.dd').nestable('serialize'),$(this).data('table'));
		$('.bg-white-only').fadeOut();
		$('.bg-white-only').fadeIn();
    });

	// Сортировка прайс-листа
	$('.sortable').sortable().bind('sortupdate', function(e, ui) {
		var arr_sort_price = [];
		$('.sortable li').each(function(){
			var id = parseInt($(this).attr('data-id'));
			var nn = parseInt($(this).index())+1;
			var tmp_arr = {
				id: id,
				nn: nn
			};
			arr_sort_price.push(tmp_arr)
		});

		updatePriceSort(arr_sort_price);
	
	});
	// сортировка прайса
	/*$('.sortable').sortable().bind('sortupdate', function(e, ui) {
		var arr_sort_price = [];
		$('.sortable li').each(function(){
			var id = parseInt($(this).attr('data-id'));
			var nn = parseInt($(this).index())+1;
			var tmp_arr = {
				id: id,
				nn: nn
			};
			arr_sort_price.push(tmp_arr)
		});
		saveSort('price',arr_sort_price);
	});*/
    //

    // редактирование лучшие и скрыть из каталога
    $('.edit_tags').click(function(){
        var now = $(this).attr('data-now');//1 - active button, 0 - not active button
		var id_prod = $(this).data('id');//id продукта
		var type_button = $(this).data('attr');// тип нажатой кнопки hide or best
        if (now == 1) {
			var next = 0;
			$(this).removeClass('btn-success').addClass('btn-default');
		}
		else{
			var next = 1;
			$(this).removeClass('btn-default').addClass('btn-success');
		}
        $(this).attr('data-now',next);
		console.log(next);
        var value = "form=tags&id="+id_prod+"&attr="+$(this).data('attr')+"&val="+next;
		$.ajax({
			type: "POST",
			url: "controller/data.php",
			dataType: "json",
			data: "form=tags&id="+$(this).data('id')+"&attr="+type_button+"&val="+next,
			success: function(data){
				console.log(data);
				//window.location.reload();
			}
		});
        //editDraw(value,"tags");
    });

	//Загрузка фотографий
	/*$('#files').change(function(){
		if ($('.item__photo').length<5) {
			var input = $(this)[0];
			if (input.files && input.files[0]) {
				if (input.files[0].type.match('image.*')) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('.upload_photo').append('' +
							'.<div class="item__photo col-xs-12 pos-rlt m-t">' +
							'<i class="glyphicon text-danger glyphicon-remove-circle removeIcon"></i>' +
							'<input type="hidden" name="tmpPhoto[]" value="' + e.target.result + '">' +
							'<img src="' + e.target.result + '"><br></div>');
						$('.removeIcon').click(function () {
							$(this).closest('.item__photo').remove();
						});
					}
					reader.readAsDataURL(input.files[0]);
				} else console.log('is not image mime type');
			} else console.log('not isset files data or files API not supordet');
		} else {
			allerts('danger','Ошибка','Можно загрузить только 10 фотографий.')
		}
	});
	$('.removeIcon').click(function(){ $(this).closest('.item__photo').remove(); });*/
	/************Превью для основного фото***************/
	$('#image').change(function() {
		var input = $(this)[0];
		if ( input.files && input.files[0] ) {
			if ( input.files[0].type.match('image.*') ) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#image_preview').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			} else console.log('is not image mime type');
		} else console.log('not isset files data or files API not supordet');
	});
	$('#myform').bind('reset', function() {
		$('#image_preview').attr('src', '../img/photo.jpg');
	});
	/*****************************************************/
	/*****************очистить форму************/
	$('.reset').click(function(){
		$(document).ready(function() {
			$('input').val('');
		});
		window.onload=function(){
			$(document).ready(function() {
				$('input').val('');
			});
		};
	});
	/*****************************************/
	/**********Создание превью изображений (галерея)******/

	var previewWidth = 278, // ширина превью
			previewHeight = 278, // высота превью
			maxFileSize = 2 * 1024 * 1024, // (байт) Максимальный размер файла (2мб)
			selectedFiles = {},// объект, в котором будут храниться выбранные файлы
			queue = [],
			image = new Image(),
			imgLoadHandler,
			isProcessing = false,
			errorMsg, // сообщение об ошибке при валидации файла
			previewPhotoContainer = document.querySelector('#preview-photo'); // контейнер, в котором будут отображаться превью

	// Когда пользователь выбрал файлы, обрабатываем их
	$('input[type=file][id=photo]').on('change', function() {
		var newFiles = $(this)[0].files; // массив с выбранными файлами

		for (var i = 0; i < newFiles.length; i++) {

			var file = newFiles[i];

			// В качестве "ключей" в объекте selectedFiles используем названия файлов
			// чтобы пользователь не мог добавлять один и тот же файл
			// Если файл с текущим названием уже существует в массиве, переходим к следующему файлу
			if (selectedFiles[file.name] != undefined) continue;

			// Валидация файлов (проверяем формат и размер)
			if ( errorMsg = validateFile(file) ) {
				alert(errorMsg);
				return;
			}

			// Добавляем файл в объект selectedFiles
			selectedFiles[file.name] = file;
			queue.push(file);

		}

		$(this).val('');

		processQueue(); // запускаем процесс создания миниатюр

	});

	//$(document).ready(function(){if ($("#preview-photo").is("li")==false){ processQueue();} // запускаем процесс создания миниатюр});
	// Валидация выбранного файла (формат, размер)
	var validateFile = function(file)
	{
		if ( !file.type.match(/image\/(jpeg|jpg|png|gif)/) ) {
			return 'Фотография должна быть в формате jpg, png или gif';
		}

		if ( file.size > maxFileSize ) {
			return 'Размер фотографии не должен превышать 2 Мб';
		}
	};

	var listen = function(element, event, fn) {
		return element.addEventListener(event, fn, false);
	};

	// Создание миниатюры
	var processQueue = function()
	{
		// Миниатюры будут создаваться поочередно
		// чтобы в один момент времени не происходило создание нескольких миниатюр
		// проверяем запущен ли процесс
		if (isProcessing) { return; }

		// Если файлы в очереди закончились, завершаем процесс
		if (queue.length == 0) {
			isProcessing = false;
			return;
		}

		isProcessing = true;

		var file = queue.pop(); // Берем один файл из очереди
		var div = document.createElement('DIV');
		var li = document.createElement('LI');
		var hr = document.createElement('HR');
		var span = document.createElement('SPAN');
		var spanDel = document.createElement('SPAN');
		var canvas = document.createElement('CANVAS');
		var ctx = canvas.getContext('2d');
		div.setAttribute('class', 'col-sm-6');
		span.setAttribute('class', 'img');
		span.setAttribute('class', 'preview');
		spanDel.setAttribute('class', 'delete btn-sm btn-danger');//<button class="close" type="button" data-dismiss="modal"><i class="fa fa-close"></i></button>
		spanDel.innerHTML = 'Удалить';
		div.appendChild(li);
		li.appendChild(hr);
		li.appendChild(span);
		$('.selectColors').clone().appendTo(li);
		li.appendChild(spanDel);
		li.setAttribute('data-id', file.name);

		image.removeEventListener('load', imgLoadHandler, false);

		// создаем миниатюру
		imgLoadHandler = function() {
			ctx.drawImage(image, 0, 0, previewWidth, previewHeight);
			URL.revokeObjectURL(image.src);
			span.appendChild(canvas);
			isProcessing = false;
			setTimeout(processQueue, 200); // запускаем процесс создания миниатюры для следующего изображения
		};

		// Выводим миниатюру в контейнере previewPhotoContainer
		previewPhotoContainer.appendChild(div);
		listen(image, 'load', imgLoadHandler);
		image.src = URL.createObjectURL(file);

		//генерация рандомного значения
		/*var n=Math.floor(Math.random()*11);
		 var k = Math.floor(Math.random()* 1000000);
		 var random = String.fromCharCode(n)+k;*/

		// Сохраняем содержимое оригинального файла в base64 в отдельном поле формы
		// чтобы при отправке формы файл был передан на сервер
		var fr = new FileReader();
		fr.readAsDataURL(file);
		fr.onload = (function (file) {
			return function (e) {
				$('#preview-photo').append(
						'<input type="hidden" name="photos[]" value="' + e.target.result + '" data-id="' + file.name+ '">'
				);
			}
		}) (file);

		//$('#preview-photo select').removeClass("hidden").removeClass("selectColors");
	};

	if ($("#preview-photo").is("li")){ processQueue();}

	// Удаление фотографии
	$(document).on('click', '#preview-photo li span.delete', function() {
		var fileId = $(this).parents('li').attr('data-id');
		console.log(fileId);
		console.log(selectedFiles);
		$.ajax({ type: "POST", url: "../controller/inc_delete.php", dataType: "json", data: "data="+fileId,
			success: function (data) {
				console.log(data);
			}
		});

		if (selectedFiles[fileId] != undefined) delete selectedFiles[fileId]; // Удаляем файл из объекта selectedFiles
		$(this).parents('li').siblings('input').remove();
		$(this).parents('li').remove(); // Удаляем превью
		$('input[name^=photo][data-id="' + fileId + '"]').remove(); // Удаляем поле с содержимым файла

	});
	/******************************************************************************************/
	//добавить значение
	$(document).on('click', '.add_button', function(){
		var arr_data;
		var table;
		var field;
		var id_factory;
		var type;
		if($(this).hasClass('add_factory')){
			table = 'factory';
			field = 'name';
			arr_data = $('input[name="factory"]').val();
			type = $(this).parents('.input-group').find('select[name="type"]').val();
			console.log(type);
			if($.isEmptyObject(type)){
				alert('Выберите тип инструмента');
				return;
			}
			if($.isEmptyObject(arr_data)){
				alert('Введите значение в поле');
				return;
			}
		}
		if($(this).hasClass('add_model')){
			if($(this).siblings('select[name="factory"]').val() == 'false'){
				alert('Выберите фабрику');
				return;
			}
			console.log($(this).siblings('select[name="factory"]').val());
			table = 'models';
			field = 'name';
			arr_data = $('input[name="model"]').val();
			id_factory = $(this).siblings('select[name="factory"]').val();
			if($.isEmptyObject(arr_data)){
				alert('Введите значение в поле');
				return;
			}
		}
		if($(this).hasClass('add_color')){
			table = 'colors';
			field = 'name';
			arr_data = $('input[name="color"]').val();
			if($.isEmptyObject(arr_data)){
				alert('Введите значение в поле');
				return;
			}
		}
		if($(this).hasClass('add_length')){
			table = 'size';
			field = 'length';
			arr_data = $('input[name="length"]').val();
			if($.isEmptyObject(arr_data)){
				alert('Введите значение в поле');
				return;
			}
		}
		if($(this).hasClass('add_height')){
			table = 'size';
			field = 'height';
			arr_data = $('input[name="height"]').val();
			if($.isEmptyObject(arr_data)){
				alert('Введите значение в поле');
				return;
			}
		}
		$.ajax({
			type: "POST", url: "controller/inc_settings.php", dataType: "json", data: "arr_data="+arr_data+"&table="+table+"&field="+field+"&type="+type,
			success: function(data){
				console.log(data);
				//if(data==true){
					window.location.reload();
				//}
			}
		});
	});
	//удалить значение
	$(document).on('click', '.delete_filter', function(){
		var table;
		var field;
		var arr_data = [];
		var arr_id = [];
		if($(this).hasClass('delete_factory')){
			table = 'factory';
			field = 'name';
			$(this).closest('.factory_group').find("input[name='factory']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('delete_model')){
			table = 'models';
			field = 'name';
			$(this).closest('.model_group').find("input[name='model']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('delete_color')){
			table = 'colors';
			field = 'name';
			$(this).closest('.color_group').find("input[name='color']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('delete_length')){
			table = 'size';
			field = 'length';
			$(this).closest('.sizes_group').find("input[name='length']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}

		arr_data = JSON.stringify(arr_data);
		arr_id = JSON.stringify(arr_id);
		$.ajax({
			type: "POST", url: "controller/inc_settings.php", dataType: "json", data: "arr_data="+arr_data+"&arr_id="+arr_id+"&table="+table+"&field="+field+"&delete=",
			success: function(data){
				console.log(data);
				if(data==true){
					window.location.reload();
				}
			}
		});
	});
	//сохранить значение
	$(document).on('click', '.save_filter', function(){
		var table;
		var field;
		var arr_data = [];
		var arr_id = [];
		if($(this).hasClass('save_factory')){
			table = 'factory';
			field = 'name';
			$(this).closest('.factory_group').find("input[name='factory']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('save_model')){
			table = 'models';
			field = 'name';
			$(this).closest('.model_group').find("input[name='model']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('save_color')){
			table = 'colors';
			field = 'name';
			$(this).closest('.color_group').find("input[name='color']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('save_sizes')){
			table = 'size';
			field = 'length';
			$(this).closest('.sizes_group').find("input[name='length']:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		arr_data = JSON.stringify(arr_data);
		arr_id = JSON.stringify(arr_id);
		$.ajax({
			type: "POST", url: "controller/inc_settings.php", dataType: "json", data: "arr_data="+arr_data+"&arr_id="+arr_id+"&table="+table+"&field="+field+"&save=",
			success: function(data){
				console.log(data);
				if(data==true){
					window.location.reload();
				}
			}
		});
	});
	//
	$(document).on('click', '.add_sizes', function(){
			var table = 'sizes';
		    var height = $(this).parents('.input-group').find('input[name="height"]').val();
			var width = $(this).parents('.input-group').find('input[name="width"]').val();
		console.log(height);
		console.log(width);
			$.ajax({
				type: "POST", url: "controller/data.php", dataType: "json", data: "form=sizes&table="+table+"&height="+height+"&width="+width,
				success: function(data){
					window.location.reload();
				}
			});
	});
	/*$(document).on('click', '.add_module', function(){
		var table = 'modules';
		var add_modal = $(this).parents('.input-group').find('input[name="add_module"]').val();
		console.log(add_modal);
		$.ajax({
			type: "POST", url: "controller/data.php", dataType: "json", data: "form=add_amount_module&table="+table+"&add_modal="+add_modal,
			success: function(data){
				console.log(data);
				window.location.reload();
			}
		});
	});*/
	/*$(document).on('click', '.included_price', function(){
		var table = 'included_price';
		var included_price = $(this).parents('.input-group').find('input[name="included_price"]').val();
		console.log(included_price);
		$.ajax({
			type: "POST", url: "controller/data.php", dataType: "json", data: "form=add_included_price&table="+table+"&add_included_price="+included_price,
			success: function(data){
				console.log(data);
				window.location.reload();
			}
		});
	});*/

	// Удаление
	$(document).on('click', '.delete', function () {
		console.log($(this).attr('data-id'));
		console.log($(this).attr('data-table'));
		$('.modal.delete_name').find('input[name="delete"]').val($(this).attr('data-id'));
		$('.modal.delete_name').find('.modal_body_text').text($(this).attr('data-name'));
		$('.modal.delete_name').find('input[name="table"]').val($(this).attr('data-table'));
		$('.modal.delete_name').find('input[name="id_company"]').val($(this).attr('data-company'));
	});

	$(document).on('click', '.delete-size', function(){
		var table = 'sizes';
		var arr_data = [];

		var arr_sizes = $(this).parents('#sizes').find(".sizes_checkbox:checkbox:checked").each(function(){
			arr_data.push($(this).val());
		});
		console.log(arr_data);
		arr_data = JSON.stringify(arr_data);
		$.ajax({
			type: "POST",
			url: "controller/data.php",
			dataType: "json",
			data:"form=delete&arr_data="+arr_data+"&table="+table,
			success: function(data){
				console.log(data);
				if(data==true){
					window.location.reload();
				}
			}
		});
	});

	/*$(document).on('click', '.delete-zakaz', function(){
		var id = $(this).closest('form').find('input[name="delete"]').val();
		var table = $(this).closest('form').find('input[name="table"]').val();
		console.log(id);
		console.log(table);
		$.ajax({
			type: "POST",
			url: "controller/inc_delete.php",
			dataType: "json",
			data:"form=delete&id="+id+"&table="+table,
			success: function(data){
				console.log(data);
				if(data==true){
					//window.location.reload();
				}
			}
		});
	});*/
	/*$(document).on('click', '.delete-amount-modules', function(){
		alert();
		var table = 'modules';
		var arr_data = [];

		var arr_modules = $(this).parents('#amount_modules').find(".amount_modals_checkbox:checkbox:checked").each(function(){
			arr_data.push($(this).val());
		});
		console.log(arr_data);
		arr_data = JSON.stringify(arr_data);
		$.ajax({
			type: "POST",
			url: "controller/data.php",
			dataType: "json",
			data:"form=delete&arr_data="+arr_data+"&table="+table,
			success: function(data){
				console.log(data);
				if(data==true){
					window.location.reload();
				}
			}
		});
	});*/
	/*$('.delete-included-price').click( function(){
		var table = 'included_price';
		var arr_data = [];

		var arr_sizes = $(this).parents('#included_price').find(".included_price_checkbox:checkbox:checked").each(function(){
			arr_data.push($(this).val());
		});
		console.log(arr_data);
		arr_data = JSON.stringify(arr_data);
		$.ajax({
			type: "POST",
			url: "controller/data.php",
			dataType: "json",
			data:"form=delete&arr_data="+arr_data+"&table="+table,
			success: function(data){
				console.log(data);
				if(data==true){
					window.location.reload();
				}
			}
		});
	});*/
	/*$(document).on('click', '.save_filter', function(){
		var table;
		var field;
		var arr_data = [];
		var arr_id = [];

		if($(this).hasClass('save-included-price')){
			table = 'included_price';
			field = 'name';
			$(this).parents('#included_price').find(".included_price_checkbox:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}
		if($(this).hasClass('save-amount_modules')){
			table = 'modules';
			field = 'name';
			$(this).parents('#amount_modules').find(".amount_modals_checkbox:checkbox:checked").each(function(){
				arr_id.push($(this).closest('span').siblings('input').attr('data-id'));
				arr_data.push($(this).closest('span').siblings('input').val());
			});
		}

		arr_data = JSON.stringify(arr_data);
		arr_id = JSON.stringify(arr_id);
		$.ajax({
			type: "POST", url: "controller/data.php", dataType: "json", data: "form=save_input&arr_data="+arr_data+"&arr_id="+arr_id+"&table="+table+"&field="+field,
			success: function(data){
				console.log(data);
				if(data==true){
					window.location.reload();
				}
			}
		});
	});*/
	$('.form-control').keyup(function(){
		$(this).closest('.input-group').find(".checkbox_control").attr('checked','checked');
	});
	$('.amount_module_checkbox').click(function(){
		$(this).closest('.modules').find('input:checkbox').each(function(){
			$(this).prop('checked',false);
			console.log('checked-false')
		});
		$(this).find('input:checkbox').prop('checked',true);
	});
});

// Функция редактирования
function edit(value,title) {
	$.ajax({ type: "POST", url: "controller/data.php", dataType: "json", data: value,
		success: function (data) {
			//console.log(data);
			if (title == "catalog") {
				$('input[name="name_ru"]').val(data[0]["name_ru"]);
				$('input[name="title"]').val(data[0]["title"]);
				$('input[name="desc"]').val(data[0]["desc"]);
				$('input[name="keywords"]').val(data[0]["keywords"]);
				$('input[name="name_en"]').val(data[0]["name_en"]);
				$('input[name="go"]').val(data[0]["id"]);
                $('select[name="section"] option').removeAttr('selected');
                $('select[name="section"] option').each(function(){
                    if ($(this).val()==data[0]["id"]) {
                        $(this).attr('selected','selected');
                    }
                });
			} else if (title == "section") {
                $('input[name="name_ru"]').val(data[0]["name_ru"]);
                $('input[name="name_en"]').val(data[0]["name_en"]);
                $('input[name="go"]').val(data[0]["id"]);
                $('select[name="section"] option').removeAttr('selected');
                $('select[name="section"] option').each(function(){
                    if ($(this).val()==data[0]["id"]) {
                        $(this).attr('selected','selected');
                    }
                });
            } else if (title == "news") {
				$('input[name="title"]').val(data[0]["title"]);
				$('input[name="date"]').val(data[0]["date"]);
				$('input[name="text"]').val(data[0]["text"]);
				$('input[name="go"]').val(data[0]["id"]);
			} else if (title == "provider") {
                $('input[name="name"]').val(data[0]["name"]);
                $('input[name="name_clients"]').val(data[0]["name_clients"]);
                $('input[name="discount"]').val(data[0]["discount"]);
                $('input[name="delivery"]').val(data[0]["delivery"]);
                $('input[name="comments"]').val(data[0]["comments"]);
                $('input[name="go"]').val(data[0]["id"]);
            } else if (title == "opt") {
                $('input[name="name"]').val(data[0]["name"]);
                $('input[name="sum"]').val(data[0]["sum"]);
                $('input[name="go"]').val(data[0]["id"]);
            } else if (title == "status-zakaz") {
                $('input[name="name"]').val(data[0]["name"]);
                $('select[name="color"] option').removeAttr('selected');
                $('select[name="color"] option').each(function(){
                   if ($(this).val() == data[0]["color"]) {
                       $(this).attr('selected','selected');
                   }
                });
                $('input[name="go"]').val(data[0]["id"]);
            } else if (title == "statusDef") {
                allerts('success','Сохранено', 'Изменен статус по умолчанию');
            }
		}
	});
}
//

// функция сортировки
function updateMenuSort(jsondata,table) {
	var myJsonString = JSON.stringify(jsondata);
	$.ajax({ type: "POST", url: "controller/data.php", dataType: "json", data: "form=savesortmenu&table="+table+"&array="+myJsonString,
		success: function (data) { location.reload(); }
	});
}
function updatePriceSort(jsondata) {
	var myJsonString = JSON.stringify(jsondata);
	console.log(myJsonString);
	$.ajax({ type: "POST", url: "controller/data.php", dataType: "json", data: "form=savesortprice&array="+myJsonString,
		success: function (data) { console.log(data); }
	});
}
// Валидатор
function validator(form) {
	var $form = form;
	var checker = true;

	$("input", $form).each(function(){
		if ($(this).hasClass('required-js')) {
			if (!$(this).val()) {
				checker = false;
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		}

		if ($(this).hasClass('number-js')) {
			if ($(this).val().match(/[^0-9]/g)) {
				checker = false;
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		}
	});
	return checker;
}
//

// Редирект между страниц
function redirectPage() {
    window.location = linklocation;
}
//

// Alert
function allerts(style,type,text) {
	$('#content').append('<div class="alert alert-'+style+' fade in" style="position: fixed; right: 10px; top: 10px; z-index: 999"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>'+type+'!</strong> '+text+'</div>');
}