<?php

function minusCount($item_id){
    $sql = "UPDATE cart SET `count` = `count`-1 WHERE catalog_item_id={$item_id}";
    executeSql($sql);
}

function deleteFromCart($item_id, $count){
    if($count > 1){
        minusCount($item_id);
    } else {
        $sql = "DELETE FROM cart WHERE catalog_item_id={$item_id}";
        executeSql($sql);
    }
}

function get_CartList($user_id, $session){
    $sql = "SELECT cat.name, cat.price, cat.img_filename, cat.id as catalog_item_id, car.`count`, car.id
    FROM cart car
    JOIN `catalog` cat ON cat.id = car.catalog_item_id
    WHERE `session_id`='{$session}' OR user_id='{$user_id}'";
    return getAssocResult($sql);
}

function countInCart($user_id = "0"){
    $session = session_id();
    if(is_null($user_id)){
        $sql = "SELECT SUM(`count`) as sum FROM `cart` WHERE `session_id`='{$session}'";
        $sumCount = getOneResult($sql);
    } else{
        $sql = "SELECT SUM(`count`) as sum FROM `cart` WHERE user_id='{$user_id}'";
        $sumCount = getOneResult($sql);
    }
    if(is_null($sumCount['sum'])){
        return 0;
    }
    return $sumCount['sum'];
}

function addToCart($item_id, $session_id, $user_id){
    if(is_null($user_id)){ // не авторизованные пользователи

        $sql_checkItemToUser = "SELECT id FROM `cart` WHERE `session_id`='{$session_id}' AND catalog_item_id={$item_id}";
        $UserItems_check = getOneResult($sql_checkItemToUser);

        if($UserItems_check){
            $sql = "UPDATE `cart` SET `count` = `count` + 1 WHERE `session_id`='{$session_id}' AND catalog_item_id={$item_id}";
            executeSql($sql);
            return;
        } else {
            $sql = "INSERT INTO cart (catalog_item_id, `session_id`) VALUES ({$item_id},'{$session_id}')";
            executeSql($sql);
            return;
        }

    } else { // Авторизованные пользователи

        $sql_checkCart = "SELECT `user_id` FROM `cart` WHERE `session_id`='{$session_id}'";
        $userExists_inCart = getOneResult($sql_checkCart);

        if($userExists_inCart){
            $sql_checkItemToUser = "SELECT id FROM `cart` WHERE `session_id`='{$session_id}' AND catalog_item_id={$item_id}";
            $UserItems_check = getOneResult($sql_checkItemToUser);
            if($UserItems_check){
                $sql = "UPDATE `cart` SET `count` = `count` + 1 WHERE user_id='{$user_id}' AND catalog_item_id={$item_id}";
                executeSql($sql);
                return;
            } else {
                $sql = "INSERT INTO cart (catalog_item_id, `session_id`, `user_id`) VALUES ({$item_id},'{$session_id}',{$user_id})";
                executeSql($sql);
                return;
            }

        } else {
            $sql = "INSERT INTO cart (catalog_item_id, `session_id`, `user_id`) VALUES ({$item_id},'{$session_id}',{$user_id})";
            executeSql($sql);
            return;
        }
    }
}