<h2>Каталог</h2>
<hr>
<div class="catalog">
<?php foreach($catalog as $item):?>
    <div class="item_catalog">
        <h3><a href="/catalog_item/?id=<?=$item['id']?>"><?=$item['name']?></a></h3> 
        <img src="/imgs/<?=$item['img_filename']?>" alt="img">
        <div class="about_item">
            <p><b>Цена: </b><?=$item['price']?> руб.</p>
            <button class="catalog_addToCart" data-id="<?=$item['id']?>">Добавить в корзину</button>
            <div class="catalog_likes_area">
                <button class="catalog_like_button" data-id="<?=$item['id']?>"><i class="fas fa-heart"></i></button>
                <span id="<?=$item['id']?>"><?=$item['likes']?></span>
            </div>
        </div>
    </div>
<?endforeach;?>
</div>