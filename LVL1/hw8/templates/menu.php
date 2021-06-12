<div class="menu_header">
<?php if($admin_status): ?>
        <div class="head_admin_menu">
        <a href="/admin">Administrate</a>
        <a href="/files">Файлы</a>
        <a href="/calc/">Калькулятор</a>
        <a href="/about">О нас</a>
        </div>
    <?php endif?>
    <a href="/">Главная</a>
    <a href="/news">Новости</a>
    <a href="/feedback/">Отзывы</a>
    <a href="/catalog">Каталог</a>
    <a href="/cart">Корзина [ <span id="countCart"><?=$count_inCart?></span> ]</a>
</div>
