<?php

function get_user(){
    return $_SESSION['login'];
}
function get_user_id($login){
    $sql = "SELECT id FROM users WHERE `login` = '{$login}'";
    return getOneResult($sql);
}
function is_admin(){
    return $_SESSION['login'] == 'admin';
}

function auth($login, $pass){
    $db = getDb();
    $login = mysqli_real_escape_string($db, strip_tags(stripslashes($login)));
    $sql = "SELECT * FROM users WHERE `login` = '{$login}'";
    $row = getOneResult($sql);

    if (password_verify($pass, $row['hash_pass'])){
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['id'];
        return true;
    }
    return false;
}

function is_auth() {
    //TODO оптимизируйте if, и учтите что пользователь уже может быть авторизован по сессии
    if (isset($_COOKIE["hash"])){
        $hash = $_COOKIE["hash"];
        $sql = "SELECT * FROM `users` WHERE `hash`='{$hash}'";
        $row = getOneResult($sql);
        $user = $row['login'];

        if (!empty($user)) {
            $_SESSION['login'] = $user;
            $_SESSION['id'] = $row['id'];
        }
    }
        //var_dump('out');
        return isset($_SESSION['login']);
}