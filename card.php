<?php include "header.php" ?>

<!--====== НАВИГАЦИЯ ПО САЙТУ ====	-->

	<div id="menu_card" class="show">
		<div class="navigation">
			<a href="<?echo$SERVER['SERVER_NAME'];?>"><img src="img/logo.png" alt="pianos" title="pianos" class="logo"/></a>
			<ul>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen1"     class="navigation_li ">КАТАЛОГ</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen2"    class="navigation_li ">СОПРОВОЖДЕНИЕ</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen3"      class="navigation_li ">ДОПОЛНИТЕЛЬНАЯ КОМПЛЕКТАЦИЯ</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen4"       class="navigation_li ">СХЕМА РАБОТ</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen5"    class="navigation_li ">САЛОН</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen6"  class="navigation_li ">АРЕНДА</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen7"    class="navigation_li ">МЕРОПРИЯТИЯ</a></li>
				<li><a href="<?echo$SERVER['SERVER_NAME'];?>/#screen10" class="navigation_li ">КОНТАКТЫ</a></li>
			</ul>
			<div class="call">
				<span>+7 727 338-37-38</span>
				<input type="button" class="button_site button1" value="ЗАКАЗАТЬ ЗВОНОК" onclick="popup('callback');"/>
			</div>
		</div>
	</div>
	<div class="screen" id="screen12">
		<div class="content" id="content_id12">
			<a href="<?echo$SERVER['SERVER_NAME'];?>/#catalog" class="card_link">Вернуться в каталог</a>
			<div id="card_box">
				<div id="card_left">
					<div id="show_card"><img src="img/card1.jpg" alt="image" title="image"/></div>
					<div class="card_mini selected" onclick="card(this);" id="cm1"><img src="img/card1.jpg" alt="image" title="image"/></div>
					<div class="card_mini no_border" onclick="card(this);" id="cm2"><img src="img/card2.jpg" alt="image" title="image"/></div>
					<div class="card_mini no_border" onclick="card(this);" id="cm3"><img src="img/card3.jpg" alt="image" title="image"/></div>
				</div>
				<div id="card_right">
					<span class="card_title">FAZOLI МАРКО ПОЛО</span><br><hr class="card_hr">
					<span class="card_podtitle">ИНФОРМАЦИЯ О ТОВАРЕ</span><br>
					<span class="card_cat">Категория: <span class="card_text"> Дизайнерские модели</span></span><br><hr class="card_hr">
					<img src="img/brend1.jpg" alt="image" title="image" class="card_brend"/><br>
					<span  class="card_text">
							Атмосферу экспрессивных итальянских вечеров<br> 
							как нельзя лучше передаёт красный концертный рояль «Марко Поло», <br> 
							словно сошедший со страниц книги воспоминаний Джакомо Казановы.<br>  
							Ещё большую идентичность инструменту придаёт <br> 
							расположенная на крыле репродукция картины Каналетто,<br>  
							изображающая один из самых известных венецианских видов — <br> 
							панорму Большого канала и Дворца дожей.
					</span><br>
					<input type="button" class="button_site2" id="cart_button" value="УЗНАТЬ ЦЕНУ" onclick="popup('request');"/>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
<?php include "contacts.php" ?>
<?php include "footer.php" ?>