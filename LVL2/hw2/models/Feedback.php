<?php

namespace app\models;

class Feedback extends Model
{
    public $id;
    public $user_id;
    public $feedback;

    public function getTableName() {
        return 'feedback';
    }
}