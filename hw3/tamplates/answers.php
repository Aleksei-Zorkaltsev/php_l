<?php
// -------------------------------- задание 1.
echo "Задание 1 <br>";

$num1 = 0;
while ($num1 <= 100) {
    if(($num1 % 3) == 0) {
        echo "{$num1} ";
    }
    $num1++;
}

// -------------------------------- задание 2.

echo "<br><br>Задание 2.<br>Первое решение.<br>";
$num2 = 0;
do {
    if ($num2 % 2) {
        echo "{$num2} - нечетное |" ;
    } else {
        echo "{$num2} - четное | ";
    }
    $num2++;
} while ($num2 <= 10);


echo "<br><br>Второе решение.<br>";
$num3 = 0;
do {
    echo ($num3 & 1) ? "{$num3} - нечетное / " : "{$num3} - четное / ";
    $num3++;
} while ($num3 <=10);


echo "<br><br>Третье решение. (через For) <br>";
for ($i = 0 ; $i <= 10 ; $i++) {
    echo ($i % 2) ? "{$i} - нечетное \ " : "{$i} - четное \ ";
}

// -------------------------------- задание 3.

echo "<br><br>Задание 3.<br>";
$regionAndCities = [
    'Московская область'=> ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань','Скопин','Сасово','Ряжск'],
    'ХМАО' => ['Ханты-мансийск', 'Сургут', 'Нефтеюганск']
];

foreach ($regionAndCities as $region => $cities) {
    $city_list ="";
    foreach ($cities as $city_name) {
        $city_list .= "{$city_name}, ";
    }
    $city_list = substr($city_list, 0, -2);
    echo "{$region}:<br>{$city_list}.<br>";
};

// -------------------------------- задание 4.
echo "<br><br>Задание 4.<br>";

$alfabet = [
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
];

function translit($text, $alfabet){

    $formattext = '';

    for ($i = 0; $i<= strlen($text) ; $i++) {

        $sim = mb_substr($text, $i, 1);

        if ($sim == " "){
            $formattext .= $sim;
            continue;
        } elseif (ctype_punct($sim)){
            $formattext .=$sim;
            continue;
        }

        foreach ($alfabet as $keyRuLatter => $engLatter) {
            if (mb_strtolower($sim) == $keyRuLatter) {
                
                if ($sim == $keyRuLatter) {
                    $formattext .= $engLatter;
                } else {
                    $formattext .= mb_strtoupper($engLatter);
                }
            } 
        }
    }

    return $formattext;
}
function translitOnlyLatters($text, $alfabet){

    $formattext = '';
    
    for ($i = 0; $i<= strlen($text) ; $i++) {
    
        $sim = mb_substr($text, $i, 1);
        foreach ($alfabet as $keyRuLatter => $engLatter) {
            if (mb_strtolower($sim) == $keyRuLatter) {
                    
                if ($sim == $keyRuLatter) {
                    $formattext .= $engLatter;
                } else {
                    $formattext .= mb_strtoupper($engLatter);
                }
            } 
        }
    }
    return $formattext;
}

$sometext = "ПриМер текСта. Для обРаБотки.  /%.|!@ #\  Сохраняя символы и пробелы. !";
echo translit($sometext, $alfabet) . "<br>";
echo translitOnlyLatters($sometext, $alfabet);

// -------------------------------- задание 5.

echo "<br><br>Задание 5.<br>";

$sometext2 = 'Пример текcта для проверки. Example text';

function spaceToLowerLine($text){
    return str_replace(" ", "_" , $text);
}
echo spaceToLowerLine($sometext2);


// -------------------------------- задание 7.

echo "<br><br>Задание 7.<br>";
for($i = 0; $i <= 9; print $i, $i++){}


// -------------------------------- задание 8.

echo "<br><br>Задание 8.<br>";

foreach ($regionAndCities as $region => $cities) {
    
    $city_list ="";

    foreach ($cities as $city_name) {
        $firstLatter = mb_substr($city_name, 0, 1);

        if($firstLatter == "К"){
            $city_list .= "{$city_name}, ";
        }
    }

    if($city_list == ""){
        echo "{$region}:<br>Города на букву 'К' не найдены.<br>";
    } else {
        $city_list = substr($city_list, 0, -2);
        echo "{$region}:<br>{$city_list}.<br>";
    }
}


// -------------------------------- задание 9.
echo "<br>Задание 9.<br>";
$sometext3 = "Название статьи блога.";

function translitToURL($text, $alfabet) {
    $text_replaceSpace = str_replace(" ", "_" , $text);
    $formattext = '';
    
    for ($i = 0; $i <= strlen($text_replaceSpace) ; $i++) {
        $sim = mb_substr($text_replaceSpace, $i, 1);
        
        if($sim == "_"){
            $formattext .= "_";
            continue;
        } 

        foreach ($alfabet as $keyRuLatter => $engLatter) {

            if (mb_strtolower($sim) == $keyRuLatter){
                if ($sim == $keyRuLatter) {
                    $formattext .= $engLatter;
                } else {
                    $formattext .= mb_strtoupper($engLatter);
                }
            }
        }
        
    }
    return $formattext;
}
echo translitToURL($sometext3, $alfabet);