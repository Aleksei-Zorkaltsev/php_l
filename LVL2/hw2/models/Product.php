<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $price;
    public $img_filename;
    public $likes;
    public $about_info;

    protected function getTableName(){
        return 'Product';
    }
}

