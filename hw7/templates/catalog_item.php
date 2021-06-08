<div class="main_item">
    <h2><?=$item_catalog['name']?></h2>
    <img src="/imgs/<?=$item_catalog['img_filename']?>" alt="img" height="350px">
    <p><b>Цена: <?=$item_catalog['price']?> руб.</b></p>
    <p style="width:500px"><?=$item_catalog['about_info']?></p>
    <button value="<?=$item_catalog['id']?>">Добавить в корзину</button>
    <hr>
    <h3>Отзывы</h3>
    <hr>

    <div class="review_form">
        <form method="POST">
            <div class="feedback_content">
                <b>Оставьте отзыв:</b>
                <input type="text" hidden name="id" value="<?=$item_catalog['id']?>"><br>
                <input type="text" name="author_name"> <br>
                <input type="text" name="review_text"> <br>
                <input type="submit">
            </div>
        </form>
    </div>
    <?php foreach($reviews as $review):?>
        <div class="review">
            <b><?=$review['name']?></b>
            <p><?=$review['textReview']?></p>
            <a href="/catalog_item/?id=<?=$item_catalog['id']?>&delete_id_review=<?=$review['id']?>">delete</a>
        </div>
    <?endforeach?>
</div>