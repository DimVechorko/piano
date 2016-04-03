<? include "controller/function.php";
$table = "payment_config";
//if (isset($_POST["go"])) {
//    $array = array(
//        "name"=>$_POST['name'],
//        "name_clients"=>$_POST['name_clients'],
//        "discount"=>$_POST['discount'],
//        "delivery"=>$_POST['delivery'],
//        "comments"=>$_POST['comments']
//    );
//    if ($_POST["go"] == "save") {
//        $array += array("update"=>"0000-00-00 00:00:00");
//        DB::insert(DB::insertSql($table,$array),$array);
//        header("Location: ".$_SERVER['REQUEST_URI']);
//	} else {
//        $id = $_POST['go'];
//        DB::update(DB::updateSql($table,$array),$array,$id);
//        header("Location: ".$_SERVER['REQUEST_URI']);
//	}
//}

$records = DB::select($table);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed">
    <?
    include "view/header.php";
	$active_k = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Платежная система</h1>
					</div>
					<div class="wrapper-md">
                        <div class="row step1">
                            <div class="col-lg-12">
                                <h1 class="m-n font-thin h3">Выберите систему оплаты</h1><br>
                                <input type="radio" name="type" value="1"/>
                                <label>Яндекс деньги</label><br>
                                <input type="radio" name="type" value="2"/>
                                <label>Робокасса</label><br><br>
                            </div>
                        </div>
                        <div class="row step2">
                            <div class="col-lg-12 step1-1 hidden">
                                 <form method="post">
                                     <label>shopId</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                     <label>scId(демо)</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                     <label>scId</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                     <label>ShopPassword</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                 </form>
                            </div>
                            <div class="col-lg-12 step1-2 hidden">
                                 <form method="post">
                                     <label>Login</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                     <label>Password 1</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                     <label>Password 2</label>
                                     <input type="text" class="form-control m-b" placeholder="Опт1" name="name">
                                 </form>
                            </div>
                        </div>
                        <div class="row step3 hidden">
                            <div class="col-lg-12">

                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>