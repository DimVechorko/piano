<?php

include 'classes/DBase.php';
include 'classes/Login.php';

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();

class Autorizired
{
    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            header("Allow: POST");
            $arr = array("error"=>"Метод не POST");
            return $arr;
        }
        setcookie("sid", "");
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $remember = !!$_REQUEST["password"];
        if (empty($username)) {
            $arr = array("error"=>"Вы не ввели логин");
            return $arr;
        }
        if (empty($password)) {
            $arr = array("error"=>"Вы не ввели пароль");
            return $arr;
        }
        $auth_result = Login::authorize($username,$password,$remember);

        if (!$auth_result) {
            $arr = array("error"=>"Не правильный логин или пароль");
            return $arr;
        }
        $arr = array("success"=>"login");
        return $arr;
    }

    public function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            header("Allow: POST");
            $arr = array("error"=>"Метод не POST");
            return $arr;
        }

        setcookie("sid", "");
        Login::logout();
        $arr = array("success"=>"logout");
        return $arr;
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            header("Allow: POST");
            $arr = array("error"=>"Метод не POST");
            return $arr;
        }

        setcookie("sid", "");

        $username = $_REQUEST["username"];
        $password1 = $_REQUEST["password1"];
        $password2 = $_REQUEST["password2"];

        if (empty($username)) { $arr = array("error"=>"Вы не ввели логин"); return $arr; }
        if (empty($password1)) { $arr = array("error"=>"Вы не ввели пароль"); return $arr; }
        if (empty($password2)) { $arr = array("error"=>"Вы не ввели пароль"); return $arr; }

        if ($password1 !== $password2) { $arr = array("error"=>"Пароли не совпадают"); return $arr; }
        Login::create($username, $password1);
        Login::authorize($username, $password1);
        $arr = array("success"=>"reg");
        return $arr;
    }
}
$ajaxRequest = new Autorizired();
if ($_REQUEST["act"]=="login") {
    if (array_key_exists('success',$ajaxRequest->login())) {
        header("Location: zakaz.php");
    } else {
        Login::resultAuth($ajaxRequest->login());
    }
} else if ($_REQUEST["act"]=="logout") {
    Login::resultAuth($ajaxRequest->logout());
}
