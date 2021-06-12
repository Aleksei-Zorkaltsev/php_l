<?php
function updateUserCart($user_id, $session){
    $updateSession = "UPDATE cart SET session_id = '{$session}' WHERE user_id = {$user_id} AND (order_status IS NULL)";
    executeSql($updateSession);
}

function itemCartSumPrice($item_id, $session){
    $result = getOneResult("SELECT `count` FROM cart WHERE session_id = '{$session}' AND catalog_item_id = {$item_id}" );
    $result2 = getOneResult("SELECT price FROM `catalog` WHERE id={$item_id}");
    return $result['count']*$result2['price'];
}

function deleteFromCart($item_id, $session_id){
    $sql = "DELETE FROM cart WHERE catalog_item_id={$item_id} AND `session_id`='{$session_id}'";
    executeSql($sql);
    return 0;
}

function minusCount($item_id, $count, $session_id){
    if((int)$count <= 1){ 
        return deleteFromCart($item_id, $session_id);
    } else {
        $sql = "UPDATE cart SET `count` = $count-1 WHERE catalog_item_id={$item_id}";
        executeSql($sql);

        $sql2 = "SELECT `count` FROM `cart` WHERE `session_id`='{$session_id}' AND catalog_item_id={$item_id}";
        $result = getOneResult($sql2);
        return $result['count'];
    }
}

function get_CartList($session){
    $sql = "SELECT cat.name, cat.price, cat.img_filename, cat.id as catalog_item_id, car.count, car.id, cat.price
    FROM cart car
    JOIN `catalog` cat ON cat.id = car.catalog_item_id
    WHERE session_id='{$session}' AND (car.order_status IS NULL)";

    return getAssocResult($sql);
}

function countInCart($session){
    $sql = "SELECT SUM(`count`) as sum FROM `cart` WHERE `session_id`='{$session}' AND (order_status IS NULL)";
    $sumCount = getOneResult($sql);

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
            $sql2 = "SELECT `count` FROM `cart` WHERE `session_id`='{$session_id}' AND catalog_item_id={$item_id}";
            $result = getOneResult($sql2);
            return $result['count'];
        } else {
            $sql = "INSERT INTO cart (catalog_item_id, `session_id`) VALUES ({$item_id},'{$session_id}')";
            executeSql($sql);
            return 2;
        }

    } else { // Авторизованные пользователи

        $sql_checkCart = "SELECT `user_id` FROM `cart` WHERE `session_id`='{$session_id}'";
        $userExists_inCart = getOneResult($sql_checkCart);

        if($userExists_inCart){
            $sql_checkItemToUser = "SELECT id FROM `cart` WHERE `session_id`='{$session_id}' AND catalog_item_id={$item_id}";
            $UserItems_check = getOneResult($sql_checkItemToUser);

            if($UserItems_check){
                $sql = "UPDATE `cart` SET `count` = `count` + 1 WHERE user_id='{$user_id}' AND catalog_item_id={$item_id} AND `session_id`='{$session_id}'";
                executeSql($sql);

                $sql2 = "SELECT `count` FROM `cart` WHERE user_id='{$user_id}' AND catalog_item_id={$item_id} AND `session_id`='{$session_id}'";
                $result = getOneResult($sql2);

                return $result['count'];
                
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