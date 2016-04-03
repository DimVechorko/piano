<? include "controller/function.php";
$param = "zakaz";
$record = DB::select($param);
//var_dump($record);
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
                                    <div class="panel-heading"><?=($record==false)?"Нет заказов":"Заказы"?></div>
                                    <? if ($record != false) :?>
                                        <div class="table-responsive">
                                            <table class="table table-striped b-t b-light">
                                                <thead>
                                                <tr>
                                                    <th width="20">№</th>
                                                    <th>№Заказа</th>
                                                    <th>Дата</th>
                                                    <th>Имя</th>
                                                    <th>Сумма</th>
                                                    <th style="width:70px;"></th>
                                                    <th>Удалить</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?
                                                        $i = 1;
                                                        foreach ($record as $records) { ?>
                                                        <tr>
                                                            <td><?=$i?></td>
                                                            <td>№<?=$records["id"]?></td>
                                                            <td><?=$records["date"]?></td>
                                                            <td><?=$records["name"]?></td>
                                                            <td><?=$records["sum"]?></td>
                                                            <td><a href="zakaz_view.php?id=<?=$records["id"]?>" class="btn btn-xsm btn-info view_zakaz">просмотр</a></td>
                                                            <td valign="top" class="dataTables_empty">
                                                                <div class="btn btn-sm btn-danger del-zakaz delete" data-id="<?=$records["id"]?>" data-table="zakaz" data-name="Заказ №<?=$records["id"]?>" title="Удалить заказ" data-toggle="modal" data-target=".delete_name"><i class="fa fa-times"></i></div>
                                                            </td>
                                                        </tr>
                                                    <? $i++; } ?>
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
<? include "view/tpl_popup.php"; ?>
<? include "view/js.php"; ?>
</body>
</html>