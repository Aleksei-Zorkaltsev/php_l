<?php

use app\models\question3\{Item, Digital_product, Fisical_product, Weight_product};
use app\interfaces\IModel;
use app\models\{Product, User, Cart, Feedback, Order_list, Review_item, Order};
use app\engine\Db;

include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product(new Db());
$user = new User(new Db());
$cart = new Cart(new Db());
$order = new Order(new Db());
$order_list = new Order_list(new Db());
$review_item = new Review_item(new Db());
$feedback = new Feedback(new Db());


// -- цифровой и физический
$item = [
    'name' => 'товар',
    'price' => 300,
    'count' => 3
];
$fis_prod = new Fisical_product($item['name'] , $item['price'] , $item['count']);
echo $fis_prod->total_sum() ."<br>";
$fis_prod->buy();

$digit_prod = new Digital_product($item['name'] , $item['price'] , $item['count']);
echo $digit_prod->total_sum() ."<br>";
$digit_prod->buy();

// -------- Вес
$item2 = [
    'name' => 'товар',
    'price' => 100,
    'weight' => 2
];
$w_prod = new Weight_product($item2['name'] , $item2['price'] , $item2['weight']);
echo $w_prod->total_sum() ."<br>";
$w_prod->buy(); 


function foo(IModel $model) {
    $model->getAll();
}
























die();
/*
//CREATE
$product = new Product();
$product->name = 'Чай';
$product->price = 23;
$product->insert();

//READ
$product = new Product();
$product->getOne(5);
$product->getAll();

//UPDATE
$product = new Product();
$product->getOne(5);
$product->price = 25;
$product->update();

//DELETE
$product = new Product();
$product->getOne(5);
$product->delete();
*/