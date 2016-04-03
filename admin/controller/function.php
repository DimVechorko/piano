<?
if (!empty($_COOKIE['sid'])) {
    session_id($_COOKIE['sid']);
}
session_start();

require_once 'classes/DBase.php';
require_once 'classes/Login.php';
$site_login = Install::select()[0]["name"];