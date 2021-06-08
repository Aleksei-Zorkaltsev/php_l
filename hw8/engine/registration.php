<?php
function registration($login, $hash_pass){
    $sql="INSERT INTO `users` (login, hash_pass) VALUES ('{$login}','{$hash_pass}')";
    executeSql($sql);
}