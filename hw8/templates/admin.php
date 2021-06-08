<hr>
<h2 class="h2orders"></h2>
<div class="main_admin_orders">
    <div class="admin_orders_module">
        <h3>Заказы: Ждут подтверждения</h3>
        <div class="admin_ORDERS"> 
            <?php foreach($orders as $order): ?>
                <div class="admin_order">
                    <h4>Номер заказа: <?=$order['id']?></h4>
                    <p>Имя указаное заказчиком: <b><?=$order['name']?></b></p>
                    <p>Указаный номер телефона: <b><?=$order['phone']?></b></p>
                    <p>id сессии:<br>
                    <b><?=$order['session_id']?></b></p>
                    <br>
                    <a href="/admin_order_details/?order_id=<?=$order['id']?>">Детали заказа</a>
                </div>
            <?php endforeach?>
        </div>
    </div>
    <br>
    <div class="admin_orders_module_approved">
        <h3>Заказы: Подтвержденные</h3>
        <div class="admin_ORDERS">
            <?php foreach($orders_Approved as $order): ?>
                <div class="admin_order">
                    <h4>Номер заказа: <?=$order['id']?></h4>
                    <p>Имя указаное заказчиком: <b><?=$order['name']?></b></p>
                    <p>Указаный номер телефона: <b><?=$order['phone']?></b></p>
                    <p>id сессии:<br>
                    <b><?=$order['session_id']?></b></p>
                    <br>
                    <a href="/admin_order_details/?order_id=<?=$order['id']?>">Детали заказа</a>
                </div>
            <?php endforeach?>
        </div>
    </div>
    <div class="admin_users_module">
        <h3>Список пользователей</h3>
        <div class="admin_users_list">
            <?php foreach($user_list as $user): ?>
                <p>Login пользователя c id=<?=$user['id']?>: <span><?=$user['login']?></span></p>
            <?php endforeach?>
        </div>
    </div>
</div>
<hr>
<div class="admin_NEWS">
    НОВОСТИ
</div>