<?php
// 2:19:30 - движок

function renderTamplate($page, $content =""){
    ob_start();
    include 'tamplates/' . $page . '.php';
    return ob_get_clean();
};


$menu = renderTamplate('menu');
$content = renderTamplate('content');
$answers = renderTamplate('answers');

echo renderTamplate('layout', $menu . $content . $answers);