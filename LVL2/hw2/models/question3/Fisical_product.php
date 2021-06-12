<?php 

namespace app\models\question3;

class Fisical_product extends Item {
    public $name;
    public $price;
    public $count;

    public function __construct($name ='none', $price = 0, $count = 0){
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
    }
    public function total_sum(){
        return $this->price * $this->count;
    }
}

var_dump('sdfsdfdsf');