<?php

class ConnectDB {
    protected  $host='localhost';
    static  $dbname='piano';
    protected  $user='root';
    protected  $pass='';
    static   $DBH;

    function __construct() {
        try {
            self::$DBH = new PDO("mysql:host=$this->host;dbname=".self::$dbname, $this->user, $this->pass);
            self::$DBH->exec("set names utf8");
        }
        catch(PDOException $e) {
            die('Ошибка: ' . $e->getMessage());
        }
    }
}


