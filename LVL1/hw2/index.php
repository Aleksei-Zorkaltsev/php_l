<?php

// ----------------------------------------------------------Задание 5.
function renderTamplate($page, $content =''){
    ob_start();
    include 'tamplates/' . $page . '.php';
    return ob_get_clean();
};

$menu = renderTamplate('menu');
$content = renderTamplate('content');
$answers = renderTamplate('answers'); // решение заданий 1.2.3.4.6

echo renderTamplate('layout', $menu . $content . $answers);