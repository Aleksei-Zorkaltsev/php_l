<?php if(!$allow):?>
<div class="login_block">
    <div>
        <h1>ALEX'Z STORE</h1>
    </div>
    <div class="reg_log">
    <a href="/registration">Регистрация</a>
    <a href="/login">Авторизация</a>
    <?php if($reg_form_show):?>
    <div class="registration">
        <form class="registration_form" action="/registration" method="POST">
            <a href="/"><b>X</b></a>
            <h3>Регистрация:</h3>
            <p>Login: </p>
            <input type="text" name="reg_login"> 
            <p>Password: </p>
            <input type="text" name="reg_pass">
            <input class="reg_log_submit" type="submit" name ="reg_ok" value="Регистрация.">
        </form>
    </div>
    <?php endif?>
    <?php if($logIn_form_show):?>
    <div class="authentification">
        <form class="authentification_form" action="/login" method="POST">
            <a href="/"><b>X</b></a>
            <h3>Авторизиция:</h3>
            <p>Login: </p>
            <input type="text" name="login"> 
            <p>Password: </p>
            <input type="password" name="pass">
            <div class="checkbox_log">
                <p>Оставаться в сети? -</p><input class="auth_checkbox" type="checkbox" name="save">
            </div>
            <input class="reg_log_submit" type="submit" name ="ok" value="Авторизоваться.">
        </form>
    </div>
    <?php endif?>
    </div>
</div>
<?php else: ?>
<div class="login_block">
    <div>
        <h1>ALEX'Z STORE</h1>
    </div>
    <div>
        <p class="header_greatness" data-user_id="<?=$user_id?>">Здравствуйте "<?=$user?>" | <a href="/logout"><b>ВЫЙТИ</b></a></p>
    </div>
</div>
<?php endif?>