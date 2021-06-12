<?php
define('INDEX', $_SERVER['DOCUMENT_ROOT']);
define('ROOT', dirname(__DIR__));
define('TEMPLATES_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');

/* DB config */
define('HOST', 'localhost:3399');
define('USER', 'alex');
define('PASS', '123');
define('DB', 'homework');

include ROOT . "/engine/db.php";
include ROOT . "/engine/auth.php";
include ROOT . "/engine/registration.php";
include ROOT . "/engine/order.php";
include ROOT . "/engine/feedback.php";
include ROOT . "/engine/news.php";
include ROOT . "/engine/render.php";
include ROOT . "/engine/files.php";
include ROOT . "/engine/catalog.php";
include ROOT . "/engine/cart.php";
include ROOT . "/engine/mathCalc.php";
include ROOT . "/engine/log.php";
include ROOT . "/engine/controller.php";