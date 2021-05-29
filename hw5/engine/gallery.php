<?php
$messages = [
    'OK' => 'Файл загружен!',
    'ERROR' => 'Ошибка.',
];


/*
function getGallery(){
    return array_splice(scandir(DIR_IMGBIG), 2);
}
*/

function getSQLGallery() {
    return getAssocResult("SELECT id, `name`, views FROM imgs ORDER BY views DESC"); // почему то вижуал студио подсвечивал нейм. поэтому экранировал чтоб не мешало
}

function getSQLGalleryImg($id) {
    return getOneResult("SELECT id, `name`, views FROM imgs WHERE id = {$id}"); 
}

function viewCountPlus($id){
    executeSql("UPDATE imgs SET views = views + 1 WHERE id = {$id}");
}

function addImgToGallery(){
    // проверка на загрузку изображений
    $imageinfo = getimagesize($_FILES['myfile']['tmp_name']); 
    if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
        echo "Sorry, we only accept GIF, JPEG and PNG images\n";
        exit;
    }
    // Черный список расширений
    $blacklist = array(".php", ".phtml", ".php3", ".php4"); 
    foreach ($blacklist as $item) {
        if (preg_match("/$item\$/i", $_FILES['myfile']['name'])) {
            echo "We do not allow uploading PHP files\n";
            exit;
        }
    }
    $path = DIR_IMGBIG . '/' . $_FILES['myfile']['name'];
    if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
        header ("Location: /?page=gallery&message=OK");
        $image = new SimpleImage();
        $image->load(DIR_IMGBIG . '/' . $_FILES['myfile']['name']);
        $image->resizeToWidth(250);
        $image->save(DIR_IMGSMALL . '/' . $_FILES['myfile']['name']);
        die();
    } else {
        header("Location: /?page=gallery&message=ERROR");
        die();
    }
}