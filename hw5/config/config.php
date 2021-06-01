<?php
define('INDEX', $_SERVER['DOCUMENT_ROOT']);
define('ROOT', dirname(__DIR__));
define('TEMPLATES_DIR', ROOT . '/templates/');
define('LAYOUTS_DIR', 'layouts/');

define('DIR_IMGBIG', INDEX . '/gallery_img/big');
define('DIR_IMGSMALL', INDEX . '/gallery_img/small');

/* DB config */
define('HOST', 'localhost:3399');
define('USER', 'alex');
define('PASS', '123');
define('DB', 'homework');

//TODO попробуйте сделать эти пути абсолютными
include ROOT . "/engine/db.php";
include ROOT . "/engine/news.php";
include ROOT . "/engine/function.php";
include ROOT . "/engine/docs.php";
include ROOT . "/engine/gallery.php";
include ROOT . "/engine/catalog.php";
include ROOT . "/engine/log.php";
include ROOT . "/engine/classSimpleImage.php";