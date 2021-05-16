<?php
echo "Задание 1.<br>";//------------------------------------------------------ Задание 1

(int)$a = rand(-100,100);
(int)$b = rand(-100,100);

echo "$a<br>$b<br>result: ";

if($a>0 && $b>=0){
    //echo $a - $b;
    echo sub($a, $b);
}elseif($a<0 && $b<0){
    //echo $a * $b;
    echo multiply($a, $b);
}else{
    //echo $a + $b;
    echo sum($a, $b);
};


echo "<br><br>Задание 2.<br>";//---------------------------------------------- Задание 2

$z = rand(0,15);
echo "$z - случайное число. <br>";
switch ($z){
    case 0:
        echo "0,";    
    case 1:
        echo "1,";
    case 2:
        echo "2,";
    case 3:
        echo "3,";
    case 4:
        echo "4,";    
    case 5:
        echo "5,"; 
    case 6:
        echo "6,";
    case 7:
        echo "7,";
    case 8:
        echo "8,";
    case 9:
        echo "9,";
    case 10:
        echo "10,";
    case 11:
        echo "11,";
    case 12:
        echo "12,";
    case 13:
        echo "13,";
    case 14:
        echo "14,";
    case 15:
        echo "15.";
    default:
        echo " -switch.<br>";
};

fromX_to15($z);
function fromX_to15($x){ //рекурсия
    if($x < 15 && $x >= 0){
        echo "$x,";
        $x++;
        fromX_to15($x);
    }elseif($x == 15){
        echo "$x - рекурсия.<br>";
    };
};


//---------------------------------------------------------------------------- Задание 3. 

function sum ($x, $y){ // Сумма
    return $x + $y;
};

function sub($x, $y){ // Разность
    return $x - $y;
};

function multiply($x, $y){ // Умножение
    return $x * $y;
};

function divided($x, $y){ // Деление
    if($y == 0){return 'делить на 0 нельзя';}
    else{
        return $x / $y;
    };
};


echo "<br>Задание 4.";//------------------------------------------------------ Задание 4.

$r = rand(1, 10);
$t = rand(1, 10);

function mathOperation ($a, $b, $operation){
    switch($operation){
        case "Сумма":
            return sum($a, $b);
        case "Разность":
            return sub($a, $b);
        case "Умножение":
            return multiply($a, $b);
        case "Деление":
            return divided($a, $b);
        default: 
        return "не коректное название операции";
    };
};
echo "<br>$r*$t ="; echo mathOperation($r, $t, 'Умножение');
echo "<br>$r-$t ="; echo mathOperation($r, $t, 'Разность');
echo "<br>$r/$t ="; echo mathOperation($r, $t, 'Деление');
echo "<br>$r+$t ="; echo mathOperation($r, $t, 'Сумма');


//----------------------------------------------------------------------------- Задание 6.

echo "<br><br>Задание 6.<br>";
$intValue = rand(0,10);
$powerVal = rand(0,10);
echo "Случайное число от одного до десяти: $intValue,<br>возведенное в степень $powerVal.<br>";

function power($val, $pow){
    if($pow == 0){
        return 1;
    }elseif($pow == 1){
        return $val;
    }else{
        return $val*power($val,$pow-1);
    };
};
echo "Result: " . power($intValue, $powerVal);

echo "<br><br>Задание 7.<br>";//----------------------------------------------- Задание 7.

$ht = rand(0,24);
$mt = rand(0,59);

function timeEnd($hour, $min){
    $hEnd = null;
    $mEnd = null;

    if($hour == 1 || $hour == 21){
        $hEnd = "Час";
    }elseif(($hour >= 2 && $hour <=4) || ($hour >= 22 && $hour <=24)){
        $hEnd = "Часа";
    }else{
        $hEnd = "Часов";
    } 

    if($min == 1 || $min == 21 || $min== 31 || $min == 41 || $min == 51){
        $mEnd = "Минута";
    }else if
    ($min == 0 || ($min >=5 && $min <=20) ||($min >=25 && $min <=30) || ($min >=35 && $min <=40) || ($min >=45 && $min <=50) || ($min >=55 && $min <=59)){
        $mEnd = "Минут";
    }else{
        $mEnd = "Минуы";
    };
    
    return "Время $hour $hEnd, $min $mEnd.";
};

echo timeEnd($ht, $mt);