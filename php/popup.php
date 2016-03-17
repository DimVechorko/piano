<div class="popup_overlay" onClick="popup_out();"></div>
	
	<div class="popup" id="video_popup">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/close-modal.png" alt="закрыть" title="закрыть"/></div>
		<iframe width="700" height="394" src="https://www.youtube.com/embed/myluFT7hCGI?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
	</div>
	
	<div class="popup" id="thx">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/close-modal.png" alt="закрыть" title="закрыть"/></div>
		<div class="popup_h1">СПАСИБО ЗА <br>ОСТАВЛЕННУЮ ЗАЯВКУ</div><br>
		<div class="popup_h2">Наш менеджер свяжется с вами в ближайшее время</div>
		<div class="btn" onClick="popup_out();"></div>
	</div>
	
		<div class="popup" id="callback">
			<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/close-modal.png" alt="закрыть" title="закрыть"/></div>
			<div class="popup_h1">ОБРАТНАЯ СВЯЗЬ</div><br>
			<div class="popup_h2">
				Оставьте заявку, и наш специалист свяжется с вами, чтобы ответить <br>на ваши вопросы.
			</div><br>
			<div class="modal_form">
				<form>
					<? echo $desc_name ?>
					<label class="name required">
						<input type="text" name="name"  class="modal_input">
					</label>
					<? echo $desc_phone ?>
					<? echo $phone_field ?><br>
					<div data-name="callback" class="button noselect btn">ЗАКАЗАТЬ ЗВОНОК</div>
				</form>
			</div>
		</div>
		
	<div class="popup" id="request">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/close-modal.png" alt="закрыть" title="закрыть"/></div>
		<div class="popup_h1">ОФОРМИТЬ ЗАКАЗ</div><br>
		<div class="popup_h2">
			Оставьте заявку, и наш специалист свяжется с вами в<br> ближайшее время.
		</div><br>
		<div class="modal_form">
			<form>
				<? echo $desc_name ?>
				<label class="name required">
					<input type="text" name="name"  class="modal_input">
				</label><br>
				<? echo $desc_phone ?>
				<? echo $phone_field ?>
				<? echo $desc_email ?>
				<label class="email required">
					<input type="text" name="email"  class="modal_input ">
				</label><br>
				<div data-name="request" class="button noselect btn">ЗАКАЗАТЬ</div>
			</form>
		</div>
	</div>
	<div class="popup" id="question">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/close-modal.png" alt="закрыть" title="закрыть"/></div>
		<div class="popup_h1">ЗАДАТЬ ВОПРОС</div><br>
		<div class="popup_h2">
			Заполните форму, и&nbsp;мы&nbsp;обязательно свяжемся с&nbsp;вами!
		</div><br>
		<div class="modal_form">
			<form>
				<? echo $desc_name ?>
				<label class="name required">
					<input type="text" name="name"  class="modal_input" >
				</label>
				<? echo $desc_phone ?>
				<? echo $phone_field ?>
				<? echo $desc_email ?>
				<label class="email required">
					<input type="text" name="email"  class="modal_input " >
				</label>
				<? echo $desc_ques ?>
				<textarea class="ques modal_textarea" name="ques"></textarea>
				<div data-name="question" class="button noselect btn">ЗАДАТЬ ВОПРОС</div>
			</form>
		</div>
	</div>

	<input type="hidden" name="prefix" class="prefix" value="<? echo $prefix; ?>">
	<input type="hidden" name="phone_format" class="phone_format" value="<? echo $phone_format; ?>">
	<input type="hidden" name="referer" value="<? echo $_SERVER['HTTP_REFERER'] ?>">
	<input type="hidden" name="ref_url" value="<? echo $_SERVER['QUERY_STRING'] ?>">
	<input type="hidden" class="formname" name="formname" value="">
	<input type="hidden" class="sitename" name="sitename" value="<? echo $sitename; ?>">
	<input type="hidden" class="emailsarr" name="emailsarr" value="<? echo $emailsArr; ?>">
	

	<script type="text/javascript" src="<? echo $prefix; ?>js/plugins.js"></script>