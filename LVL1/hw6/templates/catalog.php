<h2>Каталог</h2>
<hr>
<?php foreach ($catalog as $item):?>
    <div class="item_catalog">
        <h3><a href="/catalog_item/?id=<?=$item['id']?>">Наименование товара: <?=$item['name']?></a></h3> 
        <img src="/imgs/<?=$item['img_filename']?>" alt="img" height="200px">
        <div class="about_item">
            <p><b>Цена: </b><?=$item['price']?> руб.</p>
        </div>
    </div>
<? endforeach;?>
