<h2>Отзывы</h2>
<form class="feedback_form" action="/feedback/<?=$action_fb?>/" method="post">
    Оставьте отзыв: <br>
    <input hidden type="text"  name="id" value="<?=$author_id?>">
    <input type="text" name="name" placeholder="Ваше имя" value="<?=$author?>"><br>
    <input type="text" name="message" placeholder="Ваш отзыв" value="<?=$feedbackText?>"><br>
    <input type="submit" value="<?=$buttonText?>">
</form>
<br>
<?foreach ($feedback as $value): ?>
    <div class="feedback">
        <div class="feedback_content">
            <strong><?=$value['name']?></strong>: 
            <p><?=$value['feedback']?></p>
            <a href="/feedback/edit/?id=<?=$value['id']?>">edit</a>
            <a href="/feedback/delete/?id=<?=$value['id']?>">delete</a>
        </div>
    </div>
<?endforeach;?>