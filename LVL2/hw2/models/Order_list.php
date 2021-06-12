<?php

namespace app\models;

class Order_list extends Model
{
    public $id;
    public $order_id;
    public $item_id;
    public $session_id;
    public $counts_item;
    public $user_id;
    public $item_price;

    public function getTableName() {
        return 'order_list';
    }
}