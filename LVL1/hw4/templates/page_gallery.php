<div id="main">
    <div class="form_toAddImg">
        <p>Status: <?=$message?></p>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="myfile">
            <input type="submit" value="Загрузить файл">
        </form>
    </div>
    <div class="post_title">
        <h2>Моя галерея</h2>
    </div>
    <div class="gallery">
        <?php foreach($imgsBig as $name):?>
            <a rel="gallery" class="photo" href="<?="./gallery_img/big/{$name}"?>"><img src="<?="./gallery_img/small/{$name}"?>" width="150" height="100"></a>
        <?php endforeach;?>
    </div>
</div>