<?php if(!$allow):?>
<div class="login_block">
    <p>Здравствуйте!</p>
    <div class="reg_log">
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
    <?php else:?>
        <a href="/registration">Регистрация</a>
    <?php endif?>
    <?php if($logIn_form_show):?>
    <div class="authentification">
        <form class="authentification_form" action="/login" method="POST">
            <a href="/"><b>X</b></a>
            <h3>Авторизиция:</h3>
            <p>Login: </p>
            <input type="text" name="login"> 
            <p>Password: </p>
            <input type="text" name="pass">
            <div class="checkbox_log">
                <p>Оставаться в сети? -</p><input class="auth_checkbox" type="checkbox" name="save">
            </div>
            <input class="reg_log_submit" type="submit" name ="ok" value="Авторизоваться.">
        </form>
    </div>
    <?php else:?>
    <a href="/login">Авторизация</a>
    <?php endif?>
    </div>
    
</div>
<?php else: ?>
<div class="login_block">
    <p>Здравствуйте "<?=$user?>".</p>
    <a href="/logout"><b>ВЫЙТИ</b></a>
</div>
<?php endif?>