<?php

namespace app\models\question3;

abstract class Item {

    public function buy(){
        echo "Товар приобретен <br>" ;
        return;
    }
}