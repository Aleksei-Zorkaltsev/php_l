<?php 
//Задлание 3:
$a = 5;
$b = '05';
var_dump($a == $b);         // Почему true?
    // неявное приведение типа правого операнда. 05 = 5, поэтому сравнение даёт истину

var_dump((int)'012345');     // Почему 12345?
    // int - числовое значение. Не набор цифр., а именно число а не набор числе. 
    // потому ноль отбрасывается. По этой же причине в первоми задание получается истина

var_dump((float)123.0 === (int)123.0); // Почему false?
    // разные типы данных при строгом сравнении

var_dump((int)0 === (int)'hello, world'); // Почему true?
    //одинаковые типы данных при приведении строки HW небыло найденно. Потому строку преобразовало в 0
    // int 0 = int 0


//задание 4:

// Не вижу смысла реализовывать первый способ. 
// Как я понял главное понять что php скрипты можно "засунуть" в любое место html разметки и он будет выполнятся.
// Так как html это по сути текст, и интерпритатор завидя вход <?php выполняет скрипт.
// Плюс скрипт можно писать перед html разметкой.

// Второй способ
/*
$nameh1 = 'Информация обо мне';
$year = '2021';
$titlepage = 'Главная страница - страница обо мне';
include "3zadanie/tmp1.php"
*/

// Третий способ
$nameh1 = 'Информация обо мне';
$year = '2021';
$titlepage = 'Главная страница - страница обо мне';

$content = file_get_contents("3zadanie/tmp2.php");
$content = str_replace("{{ YEAR }}", $year, $content);
$content = str_replace("{{ NAMEH1 }}", $nameh1, $content);
$content = str_replace("{{ TITLE }}", $titlepage, $content);
echo $content;

// Задание 5:
$first = 2;
$second = 5;
echo "Первое число {$first}, второе число {$second}. <br>";
$first = $first + $second;  // 2 + 5 = 7
$second = $first - $second; // 7 - 5 = 2
$first = $first - $second;  // 7 - 2 = 5
echo "После работы скрипта. Первое число {$first}, второе число {$second}."
?>