<?php
define('ROOT', substr($_SERVER['DOCUMENT_ROOT'], 0,-6)); // вырезаем public в конце.
include ROOT . "config/config.php";
$page = 'index';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
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

    case 'page_gallery':

        $messages = [
            'OK' => 'Файл загружен!',
            'ERROR' => 'Ошибка.',
        ];
        if (isset($_FILES['myfile'])){
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

            $path = ROOT . "public/gallery_img/big/" . $_FILES['myfile']['name'];
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
                header ("Location: /?page=page_gallery&message=OK");
                $image = new SimpleImage();
                $image->load(ROOT . "public/gallery_img/big/" . $_FILES['myfile']['name']);
                $image->resizeToWidth(250);
                $image->save(ROOT . "public/gallery_img/small/" . $_FILES['myfile']['name']);
                die();
            } else {
                header("Location: /?page=page_gallery&message=ERROR");
                die();
            }
        }

        $params['imgsBig'] = array_splice(scandir(ROOT . "public/gallery_img/big"), 2);
        $params['message'] = $messages[$_GET['message']];
        break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();

}

_log($params, 'params');
echo render($page, $params);