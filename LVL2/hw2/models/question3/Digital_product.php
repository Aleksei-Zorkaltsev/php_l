<?php 

namespace app\models\question3;

class Digital_product extends Fisical_product {
    
    public function __construct($name ='none', $price = 0, $count = 0){
        parent::__construct($name, $price, $count);
        $this->price = $price / 2;
    }
}