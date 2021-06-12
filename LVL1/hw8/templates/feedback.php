<h2>Отзывы</h2>

<?php if($status): ?> <!-- Красное сообщение о состоянии запроса -->
    <p class="status_feedback"><?=$status?></p>
<?php endif?>


<?php if($user):?> <!-- Проверека вторизован ли пользователь -->
    <form class="feedback_form" action="/feedback/<?=$action_fb?>/" method="post">
        <h4><?=$fb_head_message?></h4>
        <input hidden type="text"  name="id" value="<?=$feedback_id?>">
    <?php if($fb_head_message == 'Режим редактирования:'):?>
        <?php if($admin_status):?><p class="feedback_admin_edit">Администратор</p><?php endif?>
        <span><?=$author_fb?>: </span>
    <?php else:?>
        <span><?=$user?>: </span>
    <?php endif?>
        <input type="text" name="message" placeholder="Ваш отзыв" value="<?=$feedbackText?>"><br>
        <input class ="submit_feedback" type="submit" value="<?=$buttonText?>">
    </form>
<?php else:?>
    <h4>Авторизуйтесь чтобы оставить отзыв.</h4>
<?php endif?>

<?foreach ($feedback as $value): ?>
    <div class="feedback">
        <div class="feedback_content">
            <strong><?=$value['login']?></strong>: 
            <p><?=$value['feedback']?></p>
            <!-- проверка на пользователя и права администратора -->
            <?php if($user == $value['login']):?>
                <a href="/feedback/edit/?user_id=<?=$value['user_id']?>&id=<?=$value['id']?>">edit</a>
                <a href="/feedback/delete/?id=<?=$value['id']?>">delete</a>
            <?php elseif($admin_status):?>
                <a href="/feedback/edit/?id=<?=$value['id']?>">edit</a>
                <a href="/feedback/delete/?id=<?=$value['id']?>">delete</a>
            <?php endif?>
        </div>
    </div>
<?endforeach;?>