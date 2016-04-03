<aside id="aside" class="app-aside hidden-xs bg-dark">
	<div class="aside-wrap">
		<div class="navi-wrap">
			<!-- user -->
			<div class="clearfix hidden-xs text-center hide show" id="aside-user">
				<div class="line dk hidden-folded"></div>
			</div>
			<!-- / user -->
			<!-- nav -->
			<nav ui-nav class="navi clearfix">
				<ul class="nav">
					<!--<li class="hidden-folded padder m-t m-b-sm text-muted text-xs"><span><i class="fa fa-star"></i> Быстрый доступ</span></li>-->
					<!--<li <?/*=$active_a*/?>><a href="zakaz.php" class="transition"><i class="fa fa-dashboard text-success-lter"></i><span>Статистика</span></a></li>-->
					<!--<li <?/*=$active_b*/?>><a href="zakaz.php" class="transition"><i class="glyphicon glyphicon-shopping-cart text-success-lter"></i><span>Заказы</span></a></li>-->
					<!--<li <?/*=$active_c*/?>><a href="callback.php" class="transition"><i class="glyphicon glyphicon-envelope text-success-lter"></i><span>Заявки</span></a></li>-->
					<!--<li <?/*=$active_d*/?>><a href="callback.php" class="transition"><i class="fa fa-ruble text-success-lter"></i><span>Баланс</span></a></li>-->

                    <!--<li class="line dk"></li>-->
					<li class="hidden-folded padder m-t m-b-sm text-muted text-xs"><span>Каталог</span></li>
					<!--<li <?/*=$active_f*/?>><a class="auto"><span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span><i class="glyphicon glyphicon-th text-info-lter"></i><span>Мой склад</span></a>
						<ul class="nav nav-sub dk" style="">
							<li class="nav-sub-header"><a href=""><span>Каталог</span></a></li>
							<li><a href="production.php" class="transition"><span>Каталог</span></a></li>
							<li><a href="add_product.php" class="transition"><span>Добавить товар</span></a></li>
							<li><a href="update.php" class="transition"><span>Обновление</span></a></li>
						</ul>
					</li>-->
					<li <?=$active_o?>><a href="production.php" class="transition"><i class="fa fa-gear text text-info-lter"></i><span>Каталог</span></a></li>
					<li <?=$active_o?>><a href="add_product.php" class="transition"><i class="fa fa-gear text text-info-lter"></i><span>Добавить товар</span></a></li>
                   <!-- <li <?/*=$active_g*/?>><a href="provider.php" class="transition"><i class="fa fa-truck text-info-lter"></i><span>Поставщики</span></a></li>-->

                    <li class="line dk"></li>
                   <!-- <li class="hidden-folded padder m-t m-b-sm text-muted text-xs"><span> Интернет магазин</span></li>-->
                    <!--<li <?/*=$active_h*/?>><a href="status-zakaz.php" class="transition"><i class="fa fa-tag text-info-lter"></i><span>Статусы заказов</span></a></li>-->
                    <!--<li <?/*=$active_i*/?>><a href="opt.php" class="transition"><i class="glyphicon glyphicon-import text-info-lter"></i><span>Оптовые скидки</span></a></li>-->
                   <!-- <li <?/*=$active_y*/?>><a class="auto"><span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span><i class="fa fa-group text-info-lter"></i><span>Все клиенты</span></a>
                        <ul class="nav nav-sub dk" style="">
                            <li class="nav-sub-header"><a href=""><span>Все клиенты</span></a></li>
                            <li><a href="users.php" class="transition"><span>Зарегистрированные</span></a></li>
                            <li><a href="clients.php" class="transition"><span>Не зарегистрированные</span></a></li>
                        </ul>
                    </li>-->
                    <!--<li <?/*=$active_k*/?>><a href="payment_config.php" class="transition"><i class="fa fa-money text text-info-lter"></i><span>Онлайн оплата</span></a></li>-->
                    <!--<li <?/*=$active_l*/?>><a href="mailer.php" class="transition"><i class="fa fa-send text text-info-lter"></i><span>Рассылка</span></a></li>-->

                    <!--<li class="line dk"></li>-->
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs"><span> Настройки сайта</span></li>
					<!--<li <?/*=$active_m*/?>><a href="pages.php" class="transition"><i class="glyphicon glyphicon-file icon text-info-lter"></i><span>Страницы</span></a></li>
					<li <?/*=$active_n*/?>><a href="news.php" class="transition"><i class="glyphicon glyphicon-globe icon text-info-lter"></i><span>Новости</span></a></li>-->
                    <li <?=$active_o?>><a href="settings.php" class="transition"><i class="fa fa-gear text text-info-lter"></i><span>Настройки</span></a></li>

					<li class="line dk"></li>
					<li>
						<form class="ajax" method="post" action="ajax.php">
							<input type="hidden" name="act" value="logout">
							<div class="form-actions">
								<button class="btn btn-large btn-primary btn-block" type="submit">Выход</button>
							</div>
				      </form>
					</li>
				</ul>
			</nav>
			<!-- nav -->
		</div>
	</div>
</aside>