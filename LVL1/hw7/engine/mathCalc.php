<?php
function sum ($x, $y){
    return $x + $y;
}

function sub($x, $y){
    return $x - $y;
}

function multiply($x, $y){
    return $x * $y;
}

function divided($x, $y){
    if($y == 0){return 'делить на 0 нельзя';}
    else{
        return $x / $y;
    };
}

function math_operation($x, $y, $operation){

    switch($operation){
        case "add":
            return sum($x, $y);
        case "sub":
            return sub($x, $y);
        case "multiply":
            return multiply($x, $y);
        case "divided":
            return divided($x, $y);
    }
}