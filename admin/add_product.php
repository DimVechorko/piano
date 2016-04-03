<? include "controller/function.php";
//var_dump($_POST);
//var_dump($_FILES['image']);
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT pr.id, pr.section, pr.factory_id, pr.model_id, pr.size_id, pr.colors, pr.link, fc.name as factory, tp.name as type_name, md.name as model, sz.id as size_id, sz.length, sz.height, pr.img, pr.nn, pr.best, pr.hide
FROM price as pr 
JOIN factory as fc ON fc.id=pr.factory_id
JOIN type as tp ON tp.id= fc.type_id 
JOIN models as md ON md.id=pr.model_id
JOIN size as sz ON sz.id=pr.size_id
WHERE pr.id=$id";
    $relateds = DB::selectSql($sql);
    $relateds[0]['img'] = unserialize($relateds[0]['img']);
    $relateds[0]['colors'] = unserialize($relateds[0]['colors']);
} else {
    //$relateds = DB::select("price");
    //$relateds[0]['colors'] = unserialize($relateds[0]['colors']);
}
$factory = DB::selectSql("SELECT factory.id, factory.name, factory.type_id, type.name as type_name FROM factory JOIN type ON factory.type_id = type.id order by factory.type_id, factory.name ASC");
$models = DB::select("models");
$colors = DB::select("colors");
$sizes = DB::select("size");
function base64_encode_image($filename, $filetype)
{
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
}

require_once 'view/tpl_top.php';
?>
    <div class="app app-header-fixed">
        <? include "view/header.php";
        $active_f = "class=\"active\"";
        include "view/nav.php"; ?>
        <!-- content -->
        <div id="content" class="app-content" role="main">
            <div class="app-content-body">
                <div class="hbox hbox-auto-xs hbox-auto-sm">
                    <div class="col">
                        <div class="bg-light lter b-b wrapper-md wrapper-md__i">
                            <h1 class="m-n font-thin h3 inline"><?= (isset($_GET["edit"])) ? "Редактирование товара" : "Добавление товара" ?></h1>
                        </div>
                        <div class="wrapper-md">
                            <form method="post" action="controller/inc_insert.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading font-bold">Раздел</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <select name="section" class="form-control m-b">
                                                        <option
                                                            value="">Выбрать раздел
                                                        </option>
                                                        <? DB::viewCatOptions(DB::getCat("catalog"), 0, 0, $relateds[0]["section"]); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading font-bold">Фабрика:</div>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <div id="accordion" class="panel-group">
                                                                <div class="panel panel-warning">
                                                                    <div class="panel-heading input-lg">

                                                                        <a href="#collapse-factory"
                                                                           data-parent="#accordion"
                                                                           data-toggle="collapse">Редактировать</a>

                                                                    </div>
                                                                    <div id="collapse-factory"
                                                                         class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="input-group">
                                                                                            <div
                                                                                                class="input-group-addon"
                                                                                                style="border: none">
                                                                                                <select class=""
                                                                                                        name="type">
                                                                                                    <option value="">
                                                                                                        Тип
                                                                                                    </option>
                                                                                                    <option value="1">
                                                                                                        РОЯЛЬ
                                                                                                    </option>
                                                                                                    <option value="2">
                                                                                                        ПИАНИНО
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   value=""
                                                                                                   name="factory"
                                                                                                   placeholder="Новое значение">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-success add_factory add_button hidden-xs"
                                                              type="button">Добавить
                                                      </button>
                                                        <button
                                                            class="btn btn-success add_factory add_button visible-xs"
                                                            type="button" title="Добавить новое значение"><i
                                                                class="fa fa-check"></i>
                                                        </button>
                                                    </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <div
                                                                                        class="col-lg-12 factory_group">
                                                                                        <? if (isset($factory) && !empty($factory)) {
                                                                                            foreach ($factory as $fct) {
                                                                                                ?>
                                                                                                <div class="input-group"
                                                                                                     style="margin: 5px auto">
                                                                                                    <span
                                                                                                        class="input-group-addon">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            name="factory"
                                                                                                            class="checkbox_control">
                                                                                                    </span>
                                                                                                    <span
                                                                                                        class="input-group-addon"
                                                                                                        style="background-color: white">
                                                                                                        <div
                                                                                                            class=""><?php echo $fct['type_name'] ?></div>
                                                                                                    </span>
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           value="<?= $fct['name'] ?>"
                                                                                                           data-id="<?= $fct['id'] ?>">
                                                                                                </div>
                                                                                            <? } ?>
                                                                                            <div
                                                                                                class="input-group-btn">
                                                                                                <p class="navbar-text navbar-right"
                                                                                                   style="margin-right: 1px">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn form-control btn-warning save_factory save_filter"
                                                                                                        style="border-radius: 1px">
                                                                                                        Сохранить
                                                                                                    </button>
                                                                                                </p>
                                                                                                <p class="navbar-text navbar-right"
                                                                                                   style="margin-right: 1px">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn form-control btn-danger delete_factory delete_filter"
                                                                                                        style="border-radius: 1px">
                                                                                                        Удалить
                                                                                                    </button>
                                                                                                </p>
                                                                                            </div>
                                                                                        <? } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="factory_select" class="form-control m-b">
                                                                <option
                                                                    value="">Выбрать фабрику
                                                                </option>
                                                                <?php foreach ($factory as $id => $name) {
                                                                    if ((int)$name['id'] == (int)$relateds[0]['factory_id']) {
                                                                        $checked = 'selected';
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                                    <option
                                                                        value="<?php echo $name['id'] ?>" <?php echo $checked ?>><?php echo $name['type_name'] . ' ' . $name['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading font-bold">Модель:</div>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <div id="accordion" class="panel-group">
                                                                <div class="panel panel-warning">
                                                                    <div class="panel-heading input-lg">

                                                                        <a href="#collapse-model"
                                                                           data-parent="#accordion"
                                                                           data-toggle="collapse">Редактировать</a>

                                                                    </div>
                                                                    <div id="collapse-model"
                                                                         class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-inline">
                                                                                            <div class="form-group">
                                                                                                <select name="factory"
                                                                                                        class="form-control">
                                                                                                    <option
                                                                                                        value="false">
                                                                                                        Выбрать фабрику
                                                                                                    </option>
                                                                                                    <?php foreach ($models as $id => $name) {
                                                                                                        ?>
                                                                                                        <option
                                                                                                            value="<?php echo $name['id'] ?>"><?php echo $name['name'] ?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                                <div
                                                                                                    class="input-group">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           value=""
                                                                                                           name="model"
                                                                                                           placeholder="Новое значение">
                                                                                                </div>
                                                                                                <button
                                                                                                    class="btn btn-success add_model add_button"
                                                                                                    type="button">
                                                                                                    Добавить
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <div
                                                                                        class="col-lg-12 model_group">
                                                                                        <? if (isset($models) && !empty($models)) {
                                                                                            foreach ($models as $mdl) {
                                                                                                if ($mdl['id'] == 0) {
                                                                                                    continue;
                                                                                                } ?>
                                                                                                <div class="input-group"
                                                                                                     style="margin: 5px auto">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="model"
                                                               class="checkbox_control">
                                                    </span>
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           value="<?= $mdl['name'] ?>"
                                                                                                           data-id="<?= $mdl['id'] ?>">
                                                                                                </div>
                                                                                            <? } ?>
                                                                                            <div
                                                                                                class="input-group-btn">
                                                                                                <p class="navbar-text navbar-right"
                                                                                                   style="margin-right: 1px">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn form-control btn-warning save_model save_filter"
                                                                                                        style="border-radius: 1px">
                                                                                                        Сохранить
                                                                                                    </button>
                                                                                                </p>
                                                                                                <p class="navbar-text navbar-right"
                                                                                                   style="margin-right: 1px">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn form-control btn-danger delete_model delete_filter"
                                                                                                        style="border-radius: 1px">
                                                                                                        Удалить
                                                                                                    </button>
                                                                                                </p>
                                                                                            </div>
                                                                                        <? } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="model" class="form-control m-b">
                                                                <option
                                                                    value="">Выбрать модель
                                                                </option>
                                                                <?php foreach ($models as $id => $name) {
                                                                    if ((int)$name['id'] == (int)$relateds[0]['model_id']) {
                                                                        $checked = 'selected';
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                                    <option
                                                                        value="<?php echo $id ?>" <?php echo $checked ?>><?php echo $name['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!---РАЗМЕРЫ-->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading font-bold">Размеры</div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <!---Длина--->
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <div id="accordion" class="panel-group">
                                                                        <div class="panel panel-warning">
                                                                            <div class="panel-heading input-lg">

                                                                                <a href="#collapse-length"
                                                                                   data-parent="#accordion"
                                                                                   data-toggle="collapse">Редактировать
                                                                                    длину</a>

                                                                            </div>
                                                                            <div id="collapse-length"
                                                                                 class="panel-collapse collapse">
                                                                                <div class="panel-body">
                                                                                    <div class="panel-body">
                                                                                        <div class="form-group">
                                                                                            <div class="col-lg-12">
                                                                                                <div
                                                                                                    class="input-group">
                                                                                                    <input type="number"
                                                                                                           class="form-control"
                                                                                                           value=""
                                                                                                           name="length"
                                                                                                           max="4"
                                                                                                           placeholder="Новое значение">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success add_length add_button"
                                                                type="button">Добавить
                                                        </button>
                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="panel-body">
                                                                                        <div class="form-group">
                                                                                            <div
                                                                                                class="col-lg-12 sizes_group">
                                                                                                <? if (isset($sizes) && !empty($sizes)) {
                                                                                                    foreach ($sizes as $sz) {
                                                                                                        if (empty($sz['length'])) {
                                                                                                            continue;
                                                                                                        } ?>
                                                                                                        <div
                                                                                                            class="input-group"
                                                                                                            style="margin: 5px auto">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="length"
                                                               class="checkbox_control">
                                                    </span>
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                max="4"
                                                                                                                class="form-control"
                                                                                                                value="<?= $sz['length'] ?>"
                                                                                                                data-id="<?= $sz['id'] ?>">
                                                                                                        </div>
                                                                                                    <? } ?>
                                                                                                    <div
                                                                                                        class="input-group-btn">
                                                                                                        <p class="navbar-text navbar-right"
                                                                                                           style="margin-right: 1px">
                                                                                                            <button
                                                                                                                type="button"
                                                                                                                class="btn form-control btn-warning save_sizes save_filter"
                                                                                                                style="border-radius: 1px">
                                                                                                                Сохранить
                                                                                                            </button>
                                                                                                        </p>
                                                                                                        <p class="navbar-text navbar-right"
                                                                                                           style="margin-right: 1px">
                                                                                                            <button
                                                                                                                type="button"
                                                                                                                class="btn form-control btn-danger delete_length delete_filter"
                                                                                                                style="border-radius: 1px">
                                                                                                                Удалить
                                                                                                            </button>
                                                                                                        </p>
                                                                                                    </div>
                                                                                                <? } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select name="length" class="form-control m-b">
                                                                        <option value="">Выбрать длину рояля</option>
                                                                        <?php foreach ($sizes as $id => $name) {
                                                                            if (empty($name['length'])) {
                                                                                continue;
                                                                            } else {
                                                                                if ((int)$name['id'] == (int)$relateds[0]['size_id']) {
                                                                                    $checked = 'selected';
                                                                                } else {
                                                                                    $checked = '';
                                                                                }
                                                                            } ?>
                                                                            <option
                                                                                value="<?php echo $name['id'] ?>" <?php echo $checked ?>><?php echo $name['length'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!---Высота--->
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <div id="accordion" class="panel-group">
                                                                        <div class="panel panel-warning">
                                                                            <div class="panel-heading input-lg">

                                                                                <a href="#collapse-height"
                                                                                   data-parent="#accordion"
                                                                                   data-toggle="collapse">Редактировать
                                                                                    высоту</a>

                                                                            </div>
                                                                            <div id="collapse-height"
                                                                                 class="panel-collapse collapse">
                                                                                <div class="panel-body">
                                                                                    <div class="panel-body">
                                                                                        <div class="form-group">
                                                                                            <div class="col-lg-12">
                                                                                                <div
                                                                                                    class="input-group">
                                                                                                    <input type="number"
                                                                                                           max="4"
                                                                                                           class="form-control"
                                                                                                           value=""
                                                                                                           name="height"
                                                                                                           placeholder="Новое значение">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-success add_height add_button"
                                                              type="button">Добавить
                                                      </button>
                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="panel-body">
                                                                                        <div class="form-group">
                                                                                            <div
                                                                                                class="col-lg-12 sizes_group">
                                                                                                <? if (isset($sizes) && !empty($sizes)) {
                                                                                                    foreach ($sizes as $sz) {
                                                                                                        if (empty($sz['height'])) {
                                                                                                            continue;
                                                                                                        } ?>
                                                                                                        <div
                                                                                                            class="input-group"
                                                                                                            style="margin: 5px auto">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="height"
                                                               class="checkbox_control">
                                                    </span>
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                max="4"
                                                                                                                class="form-control"
                                                                                                                value="<?= $sz['height'] ?>"
                                                                                                                data-id="<?= $sz['id'] ?>">
                                                                                                        </div>
                                                                                                    <? } ?>
                                                                                                    <div
                                                                                                        class="input-group-btn">
                                                                                                        <p class="navbar-text navbar-right"
                                                                                                           style="margin-right: 1px">
                                                                                                            <button
                                                                                                                type="button"
                                                                                                                class="btn form-control btn-warning save_sizes save_filter"
                                                                                                                style="border-radius: 1px">
                                                                                                                Сохранить
                                                                                                            </button>
                                                                                                        </p>
                                                                                                        <p class="navbar-text navbar-right"
                                                                                                           style="margin-right: 1px">
                                                                                                            <button
                                                                                                                type="button"
                                                                                                                class="btn form-control btn-danger delete_length delete_filter"
                                                                                                                style="border-radius: 1px">
                                                                                                                Удалить
                                                                                                            </button>
                                                                                                        </p>
                                                                                                    </div>
                                                                                                <? } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select name="height" class="form-control m-b">
                                                                        <option
                                                                            value="">Выбрать высоту пианино
                                                                        </option>
                                                                        <?php foreach ($sizes as $id => $name) {
                                                                            if (empty($name['height'])) {
                                                                                continue;
                                                                            } else {
                                                                                if ((int)$name['id'] == (int)$relateds[0]['size_id']) {
                                                                                    $checked = 'selected';
                                                                                } else {
                                                                                    $checked = '';
                                                                                }
                                                                            } ?>
                                                                            <option
                                                                                value="<?php echo $name['id'] ?>" <?php echo $checked ?>><?php echo $name['height'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!---Цвета---->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading font-bold">Цвет</div>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <div id="accordion" class="panel-group">
                                                                <div class="panel panel-warning">
                                                                    <div class="panel-heading input-lg">

                                                                        <a href="#collapse-color"
                                                                           data-parent="#accordion"
                                                                           data-toggle="collapse">Редактировать</a>

                                                                    </div>
                                                                    <div id="collapse-color"
                                                                         class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   value=""
                                                                                                   name="color"
                                                                                                   placeholder="Новое значение">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-success add_color add_button"
                                                              type="button">Добавить
                                                      </button>
                                                    </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <div class="form-group">
                                                                                    <div
                                                                                        class="col-lg-12 color_group">
                                                                                        <? if (isset($colors) && !empty($colors)) {
                                                                                            foreach ($colors as $clr) {
                                                                                                ?>
                                                                                                <div class="input-group"
                                                                                                     style="margin: 5px auto">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="color"
                                                               class="checkbox_control">
                                                    </span>
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           value="<?= $clr['name'] ?>"
                                                                                                           data-id="<?= $clr['id'] ?>">
                                                                                                </div>
                                                                                            <? } ?>
                                                                                            <div
                                                                                                class="input-group-btn">
                                                                                                <p class="navbar-text navbar-right"
                                                                                                   style="margin-right: 1px">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn form-control btn-warning save_color save_filter"
                                                                                                        style="border-radius: 1px">
                                                                                                        Сохранить
                                                                                                    </button>
                                                                                                </p>
                                                                                                <p class="navbar-text navbar-right"
                                                                                                   style="margin-right: 1px">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn form-control btn-danger delete_color delete_filter"
                                                                                                        style="border-radius: 1px">
                                                                                                        Удалить
                                                                                                    </button>
                                                                                                </p>
                                                                                            </div>
                                                                                        <? } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered table-hover table-condensed">
                                                                <tr>
                                                                    <?php foreach ($colors as $id => $name) {
                                                                        if (!empty($relateds[0]['colors']) && is_array($relateds[0]['colors'])) {
                                                                            foreach ($relateds[0]['colors'] as $rlt_color) {
                                                                                if ($name['id'] == $rlt_color) {
                                                                                    $checked = 'checked';
                                                                                    break;
                                                                                } else {
                                                                                    $checked = '';
                                                                                }
                                                                            }
                                                                        } ?>
                                                                        <td class="">
                                                                            <label class="i-checks checkbox-inline">
                                                                                <input type="checkbox" name="colors[]"
                                                                                       value="<?php echo $name['id'] ?>" <?php echo $checked ?>><i></i>
                                                                                <?php echo $name['name'] ?>
                                                                            </label>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading font-bold">Ссылка на сайт производителя</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <input type="url" name="url" class="form-control" placeholder="URl"
                                                           value="<?php $relateds[0]['link'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading font-bold">Фото</div>
                                            <div class="panel-body">
                                                <div class="col-md-8">
                                                    <div class="panel-heading font-bold">Дополнительные фото</div>
                                                    <div class="general_photo m-b text-center" data-id="152">
                                                        <div>
                                                            <input type="file" multiple="" id="photo">
                                                        </div>
                                                        <ul id="preview-photo" class="clearfix">
                                                            <!--//ОСНОВНОЕ фото это 0ой элемент массива $arr_img-->
                                                            <? if (!empty($relateds[0]['img']) && is_array($relateds[0]['img'])) {
                                                                $i = 0;
                                                                foreach ($relateds[0]['img'] as $key => $val) {
                                                                    if ($i == 0) {
                                                                        $i++;
                                                                        continue;
                                                                    }
                                                                    $path = "img/" . $val;
                                                                    if (file_exists($path)) {
                                                                        $image = base64_encode_image($path, 'jpeg');
                                                                        //echo '<input type="hidden"  value="' . $image . '"/>';
                                                                        $img_1 = base64_encode_image($path, 'jpeg'); ?>
                                                                        <div class="col-sm-6">
                                                                            <li data-id="<?= $val ?>"
                                                                                style="list-style-type:none">
                                                                                <hr>
                                                                                <div class="preview"
                                                                                     style="background:url(<?= $path ?>);"></div>
                                                                                <span class="delete btn-sm btn-danger"
                                                                                      style="cursor:pointer">Удалить</span>
                                                                            </li>
                                                                            <input type="hidden" name="old_photo[]"
                                                                                   value="<?= $val ?>"/>
                                                                        </div>
                                                                    <? }
                                                                    $i++;
                                                                }
                                                            } ?>
                                                        </ul>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 general_photo m-b text-center">
                                                    <div class="panel-heading font-bold">Основное фото</div>
                                                    <label for="image" class="upload_photo">
                                                        <? if (!empty($relateds[0]['img']) && is_array($relateds[0]['img'])) {
                                                            $first_val = reset($relateds[0]['img']);
                                                            $path = 'img/' . $first_val;
                                                            if (file_exists($path)) {
                                                                $image = base64_encode_image($path, 'jpeg');
                                                                echo '<input type="hidden" name="old_image"  value="' . $first_val . '"/>';
                                                                echo '<input type="hidden"  value="' . $image . '"/>';
                                                            } else {
                                                                $image = '../img/photo.jpg';
                                                            }
                                                        } ?>
                                                        <div><img alt="" id="image_preview"
                                                                  src="<?= isset($image) ? $image : "../img/photo.jpg" ?>"/>
                                                        </div>
                                                        <div style="display: none"><input type="file" id="image"
                                                                                          name="image"/></div>
                                                        <div style="display: none">
                                                            <input type="reset" value="Reset"/>
                                                            <input type="submit" value="Upload..."/>
                                                        </div>
                                                        <input type="hidden" name="photo_now" value="">
                                                    </label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-right" style="padding-right:3%">
                                        <input type="hidden" name="go"
                                               value="<?= (isset($_GET["edit"])) ? $_GET["edit"] : "save" ?>">

                                        <div class="btn btn-success button listsave">Сохранить</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? require_once 'view/tpl_bottom.php'; ?>