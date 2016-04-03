<?
include "controller/function.php";
$zakaz_id = $_GET["id"];
$zakaz_count = DB::selectSql("SELECT * FROM zakaz_count  WHERE zakaz_id = '$zakaz_id'");
$zakaz = DB::selectSql("SELECT * FROM zakaz  WHERE id = '$zakaz_id'");

//$zakaz = unserialize($zakaz_name[0]["id_price"]);
//$a = DB::selectId("settings",1);

require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_b = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">
            <div class="hbox hbox-auto-xs hbox-auto-sm">
                <div class="col">
                    <div class="bg-light lter b-b wrapper-md wrapper-md__i">
                        <h1 class="m-n font-thin h3 inline">Заказы</h1>
                    </div>
                    <div class="wrapper-md">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th width="100">Фото</th>
                                                <th>Наименование</th>
                                                <th>Кол-во</th>
                                                <th>Цена</th>
                                                <th>Итого</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?
                                            foreach ($zakaz_count as $zakaza) {
                                                //$zakaz_view = DB::selectId("price",$zakaza["price_id"]);
                                                $img = unserialize($zakaza["img"])
                                                ?>
                                                <tr>
                                                    <td><img src="../<?=$img[0]?>" alt="" style="width: 100px"/></td>
                                                    <td>Артикул:<br><?=$zakaza["nomer"]?><br><br>Название:<br><span class="name_products"><?=$zakaza["name"]?></span></td>
                                                    <td><?=$zakaza["amount"]?></td>
                                                    <td><?=ceil($zakaza["cost"])?></td>
                                                    <td><?=ceil($zakaza["sum"])?></td>
                                                </tr>
                                            <?
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col w-lg bg-light lter b-l bg-auto">
                    <div class="wrapper">
                        <div class="">
                            <h4 class="m-t-xs m-b-xs">Заказ №<?=$zakaz[0]["id"]?></h4>
                            <ul class="list-group no-bg no-borders pull-in">
                                <li class="list-group-item">
                                    <div class="clear">
                                        <small class="text-muted">Дата:</small>
                                        <div><?=$zakaz[0]["date"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Имя:</small>
                                        <div><?=$zakaz[0]["name"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Телефон:</small>
                                        <div><?=$zakaz[0]["phone"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Почта:</small>
                                        <div><?=$zakaz[0]["email"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Сумма заказа:</small>
                                        <div><?=$zakaz[0]["sum"]?><span>руб.</span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <!--<div class="clear">
                                        <small class="text-muted">Комментарий к заказу:</small>
                                        <div><?/*=$zakaz["comment"]*/?></div>
                                    </div>-->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? include "view/js.php"; ?>
</body>
</html>