<?php

function getOrders(){
    $sql = "SELECT id, name, phone, session_id, user_id, `status` FROM orders WHERE `status` = 'wait_approve' ";
    $result = getAssocResult($sql);
    return $result;
}
function getOrdersApproved(){
    $sql = "SELECT id, name, phone, session_id, user_id, `status` FROM orders WHERE `status` = 'approved' ";
    $result = getAssocResult($sql);
    return $result;
}

function addOrder($name, $phone, $session_id, $user_id, $cart_list){
    if($name == '' || $phone == ''){
        return false;
    }
    
    if(!$user_id){
        $user_id = 'NULL';
    }
    $insertOrder = "INSERT INTO orders (name, phone, session_id, user_id) VALUES ('{$name}', '{$phone}', '{$session_id}', $user_id)";
    executeSql($insertOrder);
    $lastInsert = getOneResult("SELECT LAST_INSERT_ID() as id");
    $lastInsertID = $lastInsert['id'];
    $totalSum = 0;
    $sql_InsertValues = '';
    foreach($cart_list as $list){
        $id_item = $list['catalog_item_id'];
        $price = $list['price'];
        $count = $list['count'];
        $sql_InsertValues = $sql_InsertValues . " ({$lastInsertID}, {$id_item}, '{$session_id}', {$count}, {$user_id}, {$price} ),";
        $totalSum = $totalSum + ($price * $count);
    }
    $sql_insert = "INSERT INTO order_list (order_id, item_id, session_id, counts_item, user_id, item_price) VALUES ";
    executeSql($sql_insert . substr($sql_InsertValues, 1, -1) . ";");

    $sql_cart_status_update = "UPDATE cart SET order_status = 'add_orders' WHERE `session_id` = '{$session_id}'";
    executeSql($sql_cart_status_update);

    $sql_totalSumSet = "UPDATE orders SET total_sum = {$totalSum} WHERE `session_id` = '{$session_id}'";
    executeSql($sql_totalSumSet);

    return true;
}

function getUserOrders($id){
    $sql = "SELECT id, name, phone, `status` FROM orders WHERE user_id={$id}";
    return getAssocResult($sql);
}

function orderAproved($id){
    executeSql("UPDATE orders SET `status` = 'approved' WHERE id = {$id}");
}

function getUserLogin($id){
    $sql = "SELECT id FROM users WHERE id={$id}";
    $result = getOneResult($sql);
    return $result['id'];
}

function getoneOrder($id){
    $sql = "SELECT o.id, o.name, o.phone, o.session_id, o.user_id, o.total_sum, o.`status`
    FROM orders o
    WHERE o.id={$id}";
    $result = getOneResult($sql);
    return $result;
}

function getOrderDetails($id){
    $id = (int)$id;
    $sql = "SELECT ol.order_id, ol.item_id, ol.counts_item, ol.item_price, c.name, c.img_filename
    FROM order_list ol
    JOIN `catalog` c ON ol.item_id = c.id
    WHERE ol.order_id={$id}";
    $result = getAssocResult($sql);
    return $result;
}

function user_deleteOrder($order_id, $user_id){
    $checkSave = getOneResult("SELECT id FROM orders WHERE id ={$order_id} AND user_id = {$user_id}");
    if($checkSave['id']){
        $sql_del = "DELETE FROM orders WHERE id={$order_id}";
        executeSql($sql_del);
    }
}

function admin_deleteOrder($order_id){
    $sql_del = "DELETE FROM orders WHERE id={$order_id}";
    executeSql($sql_del);
}