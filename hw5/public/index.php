<?php
 // вырезаем public в конце.
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";

$url_array = explode('/', $_SERVER['REQUEST_URI']);

if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}

$params = [
    'name' => 'Админ'
];

switch ($page) {

    case 'index':
        break;

    case 'catalog':
        $params['catalog'] = getCatalog();
        break;

    case 'files':
        $params['files'] = getDocs();
        break;

    case 'gallery':

        if (isset($_FILES['myfile'])){
            addImgToGallery();
        }

        $params['imgsBig'] = getSQLGallery();
        $params['message'] = $messages[$_GET['message']];
        break;

    case 'galleryImg':
        $imgid = (int)$_GET['id'];
        viewCountPlus($imgid);
        $params['imgsBig'] = getSQLGalleryImg($imgid);
        break;

    case 'news':
        $params['news'] = getNews();
        break;
    
    case 'newsone':
        $id = (int)$_GET['id'];
        $params['news'] = getOneNews($id);
        break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();

}

_log($params, 'params');
echo render($page, $params);