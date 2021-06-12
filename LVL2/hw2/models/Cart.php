<?php

namespace app\models;

class Cart extends Model 
{
    public $id;
    public $catalog_item_id;
    public $session_id;
    public $user_id;
    public $count;
    public $order_status;

    public function getTableName() {
        return 'cart';
    }
}