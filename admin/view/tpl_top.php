<? if (!Login::isAuthorized()) { header("Location: lock.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=$site_login?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <? include "view/css.php"; ?>
</head>
<body>