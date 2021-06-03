<?php //<button id="start">POST запрос ajax</button> ?>
<h2>Каталог</h2>
<hr>
<?php foreach ($catalog as $item):?>
    <div class="item_catalog">
        <h3><a href="/catalog_item/?id=<?=$item['id']?>"><?=$item['name']?></a></h3> 
        <img src="/imgs/<?=$item['img_filename']?>" alt="img">
        <div class="about_item">
            <p><b>Цена: </b><?=$item['price']?> руб.</p>
            <a class="catalog_addToCart" href="/add_item_toCart/?id=<?=$item['id']?>" id="start">Добавить в корзину</a>
        </div>
    </div>
<? endforeach;?>