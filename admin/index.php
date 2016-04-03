<?php
require_once ("controller/function.php");
    require_once 'view/tpl_top_index.php';
?>
<div class="app app-header-fixed  ">
    <div class="container w-xxl w-auto-xs">
      <form class="form-signin ajax" method="post" action="./ajax.php">
        <h3 class="form-signin-heading">Панель администратора</h3>
        <input name="username" type="text" class="input-block-level form-control m-b " placeholder="Логин" autofocus>
        <input name="password" type="password" class="input-block-level form-control m-b " placeholder="Пароль">
          <? if (isset($_POST['error'])) :?>
              <p class="text-danger"><?=$_POST['error']?></p>
          <? endif; ?>
        <label class="checkbox m-l-md">
          <input name="remember-me" type="checkbox" value="remember-me" checked> Запомнить меня
        </label>
        <input type="hidden" name="act" value="login">
        <div class="btn btn-large btn-primary btn-block button">Войти</div>
      </form>
    </div> <!-- /container -->
</div>
<? require_once 'view/tpl_bottom.php'; ?>
