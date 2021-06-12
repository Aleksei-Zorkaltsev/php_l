<div class="cart_main">
    <?php if($message_status):?>
        <h2><?=$message_status?></h2>
    <?php endif?>
    <?php foreach($cart_list as $item):?>
        <div class="item_inCart" id="cart_item_<?=$item['catalog_item_id']?>" data-cart_item_id="<?=$item['catalog_item_id']?>">
            <div class="cartPrewImg">
                <a href="#"><img src="/imgs/<?=$item['img_filename']?>" alt="prew"></a>
            </div>
            <div class="main_infoCartItem">
                <h3>Название: <?=$item['name']?></h3>
                <p>Цена за 1 еденицу товара: <?=$item['price']?> руб.</p>
                <div>
                    Кол-во: <span id="<?=$item['catalog_item_id']?>"><?=$item['count']?></span>
                    <button 
                        class="cart_PlusMinus" 
                        data-id="<?=$item['catalog_item_id']?>" 
                        data-action="countPlus">Добавить</button>
                    <button 
                        class="cart_PlusMinus" 
                        data-id="<?=$item['catalog_item_id']?>" 
                        data-action="countMinus">Удалить</button>
                </div>
                <?php $sumPrice = multiply($item['count'], $item['price']);// понимаю что нарушение принципа, но не придумал как подругому?> 
                <p>Общая стоимость: <span class="full_price_span_cart" id="price_id_<?=$item['catalog_item_id']?>"><?=$sumPrice?></span> руб.</p>
            </div>
        </div>
    <?php endforeach?>
    <div class="cart_full_price">
        Общая стоимость товаров в корзине: <span id="fullprice_cart">0</span> руб.
    </div>
</div>
<div class="after_totalPriceCart">
    <div class="take_order">
        <form action="/cart/?order=add" method="post">
            <h3>Оформление заказа:</h3>
            <div><span>Ваше имя:</span> <input type="text" name="name"></div>
            <div><span>Номер телефона:</span> <input type="text" name="phone"></div>
            <input class="order_submit_button" type="submit" value="Отправить">
        </form>
    </div>
    <?php if($allow):?>
        <div class="cart_user_orders">
            <div class="user_orders_module">
                <h2>Ваши заказы:</h2>
                <div class="user_ORDERS">
                    <?php if(!$user_orders): ?>
                    <p style="color: white">Ваш список заказов пуст.</p>
                    <?php endif?>
                    <?php foreach($user_orders as $order): ?>
                        <div class="cart_user_order">
                            <h4>Номер заказа: <?=$order['id']?></h4>
                            <p>Вы сделали заказ на имя: <br><b><?=$order['name']?></b></p>
                            <hr>
                            <p>Вы указали номер телефона: <br><b><?=$order['phone']?></b></p>
                            <hr>
                            <input type="submit" data-order_id="<?=$order['id']?>" class="cart_getDetailUserOrder" value="Показать детали заказа">
                        </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    <?php else:?>
        <div class="cart_user_orders">
            <div class="user_orders_module">
                <h2>Ваши заказы.</h2>
                <div class="user_ORDERS">
                <div class="cart_user_order">
                    <h4>Вы не авторизованы.</h4>
                </div>
                </div>
            </div>
        </div>
    <?php endif?>
    <div class="cart_UserOrderDetail">
    <?php if($allow):?>
        <h3>Детали заказа:</h3>
        <p>Выберете заказ в списке ваших заказов.</p>
    <?php else:?>
        <h3>Детали заказа:</h3>
        <h3>Вы не авторизованы.</h3>
    <?php endif?>
        <div class="cart_Order_details" id="cart_order_detail">
        </div>
    </div>
</div>
