<ul>
<?php 
//---- Задание 6.
$menuArr = [
    'name1' => ['url' => 'url/1',
                'color' => 'red'
],
    'name2' => ['url' => 'url/2',
                'color' => 'yellow'
],
    'name3' => ['url' => 'url/3',
                'color' => 'pink'
]];
foreach($menuArr as $nameli => $pountMenu):?>
<li><a style="color:<?=$pountMenu['color']?>" href="<?=$pountMenu['url']?>"><?=$nameli?></a></li>
<?php:endforeach;?>
</ul>