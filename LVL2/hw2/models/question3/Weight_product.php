<?php 

namespace app\models\question3;

class Weight_product extends Item {

    public $name;
    public $price;
    public $weight;

    public function __construct($name ='none', $price = 0, $weight = 0){
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function total_sum(){
        return $this->price * $this->weight;
    }
}