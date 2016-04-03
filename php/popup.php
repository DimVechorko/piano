<div class="popup_overlay" onClick="popup_out();"></div>
	
	<div class="popup" id="video_popup">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/close-modal.png" alt="закрыть" title="закрыть"/></div>
<!--		<iframe width="700" height="394" src="https://www.youtube.com/embed/myluFT7hCGI?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>-->
<!--        <iframe width="560" height="315" src="https://www.youtube.com/embed/8zN_z0bV68I" frameborder="0" allowfullscreen></iframe>-->
        <video id="video" controls>
            <source src="video/Pianos_Interview.mp4" type="video/mp4" ></source>
            <source src="video/Pianos_Interview.webm" type="video/webm" ></source>
        </video>
            
        </video>
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
                <label class="name ">
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
				<label class="name ">
					<input type="text" name="name"  class="modal_input">
				</label><br>
				<? echo $desc_phone ?>
				<? echo $phone_field ?>
				<? echo $desc_email ?>
				<label class="email ">
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
				<label class="name ">
					<input type="text" name="name"  class="modal_input" >
				</label>
				<? echo $desc_phone ?>
				<? echo $phone_field ?>
				<? echo $desc_email ?>
				<label class="email ">
					<input type="text" name="email"  class="modal_input " >
				</label>
				<? echo $desc_ques ?>
				<textarea class="ques modal_textarea" name="ques"></textarea>
				<div data-name="question" class="button noselect btn">ЗАДАТЬ ВОПРОС</div>
			</form>
		</div>
	</div>
	
	
<!--
	<div class="popup popup--adv" id="simple1">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		<div class="text-center">
		    <img src="img/popup/simple1.jpg" alt="">
		</div>
		
		<div class="popup_h1">Беззвучное звучание</div><br>
		<div class="popup_h2">Этот уникальный механизм оснащён стоп-планкой – молоточки пианино/рояля останавливаются прежде, чем они соприкоснуться<br>со струнами. Она монтируется таким образом, чтобы вы имели возможность использовать музыкальный инструмент в обычном режиме. Также система оснащена сенсорной панелью управления — 88 клавишных сенсора измеряют силу и частоту движения каждой отдельной клавиши, и преобразуют их в MIDI-файлы</div>
		
		<input type="button" class="button_site " value="УЗНАТЬ Подробнее" onclick="popup('callback');">
	</div>
	
	<div class="popup popup--adv" id="simple2">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		<div class="text-center">
		    <img src="img/popup/simple2.jpg" alt="">
		</div>
		
		<div class="popup_h1">Бережная защита</div><br>
		<div class="popup_h2">Эта система является необходимым условием для сохранения долговечности материала и насыщенности звука. Установив эту систему на своё пианино/рояль, вы получите:
            <ul>
                <li>- поддержание нужного для инструмента микроклимата</li>
                <li>- сохранение и стабильность настроек</li>
                <li>- предотвращение коррозии струн </li>
                <li>- исключение разбухания и рассыхания механических элементов инструмента</li>
                <li>- защиту от износу сукна</li>
            </ul>
        </div>
		
		<input type="button" class="button_site " value="УЗНАТЬ Подробнее" onclick="popup('callback');">
	</div>
	<div class="popup popup--adv" id="simple3">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		<div class="text-center">
		    <img src="img/PianoDisk_v1.gif" alt="">
		</div>
		
		<div class="popup_h1">Невидимый пианист</div><br>
		<div class="popup_h2">Устройство PianoDisc встраивается в любую модель <br>рояля или пианино и позволяет воспроизводить более <br>5 000 музыкальных произведений с помощью <br>самодвижущихся клавиш без участия музыканта </div>
		
		<input class="button_site" type="button" value="Подробнее о PianoDisc">
		
	</div>
-->
	<div class="popup popup--adv popup--adv2" id="simple4">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		
		<div class="row">
		    <div class="fl_r">
		        <div class="popup_h2">Ближе к мечте</div>
		        <div class="popup_h1">Рояли с мировым именем<br>«Mason & Hamlin»<br>со скидкой 10 %</div>
		        <div class="text">Заполните данную форму, и наш специалист свяжется с вами,<br>чтобы рассказать о модельном ряде, на который предоставляется<br>скидка от салона «Pianos»</div>
		        
		        
                <form>
                    <? echo $desc_name ?>
                    <label class="name ">
                        <input type="text" name="name"  class="modal_input">
                    </label>
                    <? echo $desc_phone ?>
                    <? echo $phone_field ?>
                    
                    <? echo $desc_email ?>
                    <label class="email ">
                        <input type="text" name="email"  class="modal_input ">
                    </label>
                    
                    <div  class="button noselect btn">Узнать больше</div>
		            
                </form>
		    </div>
		</div>
		
	</div>
	<div class="popup popup--adv popup--adv2" id="simple7">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		
		<div class="row">
		    <div class="fl_r">
		        <div class="popup_h1">Какой инструмент <br>можно арендовать?</div>
		        <div class="popup_h2">В нашем салоне доступны:</div>
		        
		        <div class="text">
		            <ul class="dots_list">
		                    <li>Белый рояль</li>
		                <br><li>Чёрный рояль</li>
		                <br><li>Белое пианино</li>
		                <br><li>Консоль</li>
		                <br><li>Белый рояль<br>с самоиграющией<br>системой</li>
		            </ul>
		        </div>
		        
		    </div>
		</div>
		
	</div>
	<div class="popup popup--adv popup--adv2" id="simple5">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		<div class="row">
		    <div class="col">
                <div class="text-center">
		            <img src="img/Pianodisk1.gif" alt="">
		        </div>
            </div>
		            
		    <div class="col col2">
		        <div class="popup_h1">Самоигровая<br>система PianoDisc</div><br>
		        <div class="popup_h2">Квинтэссенция виртуозной<br>импровизации и современных<br>технологий</div>
		        <div class="text"><p>Универсальная система PianoDisc подходит для установки на любое пианино или рояль, принося его владельцу истинное наслаждение. Чистота и глубина звучания, динамика и экспрессия исполнения даёт безграничные возможности для воспроизведения более 5 000 музыкальных произведений разных жанров: от классики до блюза.</p>
		        <p>Каждая деталь системы бережно встраивается сотрудниками салона «Pianos» в инструмент, абсолютно не влияя на качество игры и работу клавишного механизма</p>
		        <p>PianoDisc обеспечивает максимальное соответствие стандарту General MIDI. Также на каждый компонент самовоспроизводящей системы предоставляется гарантия от производителя – 5 лет</p></div>
		        
		        <input class="button_site" type="button" value="Узнать больше о системе PianoDisc">
		    </div>
		</div>
		
	</div>
	<div class="popup popup--adv popup--adv2" id="simple6">
		<div class="popup_close noselect" onClick="popup_out();"><img src="<?echo $prefix;?>img/popup/close.png" alt="закрыть" title="закрыть"/></div>
		
		<div class="row">
		    <div class="col">
                
                <div class="switcher">
                    <ul class="mini">
                        <li class="active"><img src="img/slides/FAZIOLI МАРКО ПОЛО (1).jpg" alt=""></li>
                        <li class=""><img src="img/slides/FAZIOLI МАРКО ПОЛО (2).jpg" alt=""></li>
                        <li class=""><img src="img/slides/FAZIOLI МАРКО ПОЛО (3).jpg" alt=""></li>
                    </ul>
                    <div class="main"><img src="img/slides/FAZIOLI МАРКО ПОЛО (1).jpg" alt=""></div>
                </div>
                
            </div>
		            
		    <div class="col col2">
		        <div class="popup_h1">FAZIOLI МАРКО ПОЛО</div><br>
		        <div class="popup_h2">иНФОРМАЦИЯ О ТОВАРЕ</div>
		        
		        <div class="popup_adv_info">
                    <ul class="popup_adv_info_list">
                        <li><b>Категория:</b> Дизайнерские модели.</li>
                        <li><b>Модель:</b> Марко Поло</li>
                        <li><b>Цвет:</b> Красный</li>
                        <li><b>Длина:</b>156-300</li>
                    </ul>
                    
                    <a href="">Сайт производителя </a>
                </div>
                
                <div class="product_logo">
                    <img src="img/slides/logo/logo1.png" alt="" class="">
                </div>
		        
		        <div class="text">Атмосферу экспрессивных итальянских вечеров 
                    как нельзя лучше передаёт красный концертный рояль «Марко Поло», словно сошедший со страниц книги воспоминаний Джакомо Казановы. Ещё большую идентичность инструменту придаёт 
                    расположенная на крыле репродукция картины Каналетто, 
                    изображающая один из самых известных венецианских видов — 
                    панорму Большого канала и Дворца дожей.
                </div>
		        
		        <input class="button_site" type="button" value="Узнать цену">
		    </div>
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