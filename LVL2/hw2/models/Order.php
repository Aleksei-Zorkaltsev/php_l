<?php

namespace app\models;

class Order extends Model
{
    public $id;
    public $name;
    public $phone;
    public $session_id;
    public $user_id;
    public $status;
    public $total_sum;

    public function getTableName() {
        return 'orders';
    }
}