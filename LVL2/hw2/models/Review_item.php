<?php

namespace app\models;

class Review_item extends Model
{
    public $id;
    public $name;
    public $textReview;
    public $item_catalog_id;

    public function getTableName() {
        return 'review_item';
    }
}