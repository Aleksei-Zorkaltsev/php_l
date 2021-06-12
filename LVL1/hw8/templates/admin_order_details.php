<div class="order_details_main">
        <a class="odm_a_backbutton" href="/admin">Вернуться.</a>
    <hr>
    <h3>НОМЕР ЗАКАЗА: <span><?=$order['id']?></span> </h3>
    <p>Указанное имя заказчика: <span><?=$order['name']?></span> </p>
    <p>Указанный номер телефона: <span><?=$order['phone']?></span> </p>
    <p>session_id: <span><?=$order['session_id']?></span> </p>
    <p>STATUS: <span><?=$order['status']?></span> </p>
    <?php if($order_Userlogin):?>
        <p>Авторизованный пользователь: user_id: <span><?=$order_Userlogin?></span> </p>
    <?php endif?>

    <?php if($order['status'] == 'approved'):?>
    <div class="order_statuschange_block">
        <p>ЗАКАЗ ПОДТВЕРЖДЕН</p>
        <a href="/admin_order_details/?del&order_id=<?=$order['id']?>">Удалить заказ</a>
    </div>  
    <?php else:?>
    <div class="order_statuschange_block">
        <a href="/admin_order_details/?order_id=<?=$order['id']?>&order_complete">Подтвердить заказ</a>
        <a href="/admin_order_details/?del&order_id=<?=$order['id']?>">Удалить заказ</a>
    </div>
    <?php endif?>

    <h4>Товары:</h4> 
    <div class="order_details_itemInOrder">
        <?php foreach($order_list as $item_list):?>
        <div class="order_details_item_block">      
            <img src="/imgs/<?=$item_list['img_filename']?>" alt="img">
            <div>
                <h4>Наименование товара: <span><?=$item_list['name']?></span> </h4>
                <p>id Товара: <span><?=$item_list['item_id']?></span></p>
                <p>Количество: <span><?=$item_list['counts_item']?></span></p>
                <p>Цена за одну еденицу товара: <span><?=$item_list['item_price']?></span> руб.</p>
            </div>
        </div>
        <?php endforeach?>
    </div>
</div>