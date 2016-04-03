<?php

class Login extends ConnectDB {
    public static function isAuthorized() {
        if (!empty($_SESSION["user_id"])) {
            return (bool) $_SESSION["user_id"];
        }
        return false;
    }

    public function passwordHash($password, $salt = null, $iterations = 10) {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));
        for ($i = 0; $i < $iterations; ++$i) { $hash = md5(md5(sha1($hash))); }
        return array('hash' => $hash, 'salt' => $salt);
    }

    public function getSalt($username) {
        $query = "select salt from users where username = :username limit 1";
        $sth = parent::$DBH->prepare($query);
        $sth->execute(array(":username" => $username));
        $row = $sth->fetch();
        if (!$row) { return false; }
        return $row["salt"];
    }

    public static function authorize($username, $password, $remember=false) {
        $query = "select id, username from users where username = :username and password = :password limit 1";
        $sth = parent::$DBH->prepare($query);
        $salt = self::getSalt($username);
        if (!$salt) { return false; }
        $hashes = self::passwordHash($password, $salt);
        $sth->execute(array(":username" => $username,":password" => $hashes['hash'],));
        $user = $sth->fetch();
        if (!$user) {
            $is_authorized = false;
        } else {
            $is_authorized = true;
            $_SESSION["user_id"] = $user['id'];
            self::saveSession($remember);
        }

        return $is_authorized;
    }

    public function saveSession($remember = false, $http_only = true, $days = 7) {
        if ($remember) {
            // Save session id in cookies
            $sid = session_id();
            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";
            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public static function create($username, $password) {
        $user_exists = self::getSalt($username);

        if ($user_exists) {
            throw new \Exception("User exists: " . $username, 1);
        }

        $query = "insert into users (username, password, salt) values (:username, :password, :salt)";
        $hashes = self::passwordHash($password);
        $sth = parent::$DBH->prepare($query);

        parent::$DBH->beginTransaction();
        $result = $sth->execute(array(':username' => $username, ':password' => $hashes['hash'], ':salt' => $hashes['salt'],));
        parent::$DBH->commit();
        return $result;
    }

    public static function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
    }

    public static function resultAuth($arrRes) {
        $url = "http://".$_SERVER['HTTP_HOST']."/admin/index.php";
        $fields_string = "";
        foreach($arrRes as $key=>$value) {
            $fields_string .= $key.'='.$value;
        }
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        curl_exec($ch);
        curl_close($ch);
    }
}