<div class="cart_main">
    <?php foreach($cart_list as $item):?>
        <div class="item_inCart">
            <div class="cartPrewImg">
                <a href="#"><img src="/imgs/<?=$item['img_filename']?>" alt="prew"></a>
            </div>
            <div class="main_infoCartItem">
                <h3>Название: <?=$item['name']?></h3>
                <p>Кол-во: <?=$item['count']?></p>
                <a href="/cart/?delete&id=<?=$item['catalog_item_id']?>&count=<?=$item['count']?>">Удалить из корзины</a>
            </div>
        </div>
    <?php endforeach?>
</div>