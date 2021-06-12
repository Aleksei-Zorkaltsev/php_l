<?php
// $_SERVER['HTTP_REFERER']
//password_hash('$pass' , PASSWORD_DEFAULT) 
//password_veriufy('$pass', hash)
//setcookie('nameCoockie', 'value', time()+3600, '/') //-- time()-3600 удалить //--3600 секунд=час



//https://mintmanga.live/sun_ken_rock/vol20/127?mtr=true#page=3




/*
start_session()
session_id()
$_SESSION['name'] = ''somename
unset($_SESSION['name'])

session_destroy()
*/

// id -- item_id -- session_id -- count(default_1) -- user_id(default_NULL)

function prepareVariables($page, $action = ""){
    $params = [];
    $params['allow'] = false;
    $params['reg_form_show'] = false;
    $params['logIn_form_show'] = false;

    if (is_auth()){
        $params['allow'] = true;
        $params['user'] = get_user();
    }

    $user_id = get_user_id($params['user']);
    $params['count_inCart'] = countInCart($user_id['id']);

    switch ($page) {

        case 'registration':
            $params['reg_form_show'] = true;
            if(isset($_POST['reg_ok'])){
                $login = strip_tags($_POST['reg_login']);
                $pass = strip_tags($_POST['reg_pass']); 
                $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
                registration($login, $hash_pass);
                header('Location: /');
                die();
            }
            break;

        case 'login':
            $params['logIn_form_show'] = true;

            if (isset($_POST['ok'])){
                $login = $_POST['login'];
                $pass = $_POST['pass'];     
                if (auth($login, $pass)){
                    session_regenerate_id();
                    if (isset($_POST['save'])) {
                        $hash = uniqid(rand(), true);
                        $id = $_SESSION['id'];
                        $sql = "UPDATE users SET `hash` = '{$hash}' WHERE `users`.`id` = {$id}";
                        executeSql($sql);
                        setcookie('hash', $hash, time() + 3600, '/');
                    }
                    header('Location: /');
                    die();
                } else {
                    die("Не верно логин-пароль");
                }
            }
            break;

        case 'logout':
            setcookie('hash', '', time() - 3600, '/');
            session_regenerate_id();
            session_destroy();
            header('Location: /');
            die();
            break;

        case 'index':
            break;

        case 'catalog':
            $params['catalog'] = getCatalog();
            break;
        
        case 'catalog_item':
            $id_item = (int)$_GET['id'];
            $params['item_catalog'] = getItemCatalog($id_item);
            $params['reviews'] = getReviewsCatalogItem($id_item);

            if(isset($_POST['review_text'])){
                addReviewToItem($id_item);
                header("Location: /catalog_item/?id={$id_item}");
                die();
            }

            if(isset($_GET['delete_id_review'])){
                $id_review = $_GET['delete_id_review'];
                deleteReview($id_review);
                header("Location: /catalog_item/?id={$id_item}");
                die();
            }
            break;
            
            case 'add_item_toCart':
            if(isset($_GET['id'])){
                $item_id=$_GET['id'];
                $user_id = get_user_id($params['user']);
                addToCart($item_id, session_id(), $user_id['id']);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            break;

        case 'cart':

            if(isset($_GET['delete'])){
                $item_id = $_GET['id'];
                $count = $_GET['count'];
                deleteFromCart($item_id, $count);
                header('location: /cart');
                die();
            }

            $user_id = get_user_id($params['user']);
            $params['cart_list'] = get_CartList($user_id['id'], session_id());
            break;
        case 'files':
            $params['files'] = getFiles();
            break;

        case 'news':
            $params['news'] = getNews();
            break;

        case 'newsone':
            $id = (int)$_GET['id'];
            $params['news'] = getOneNews($id);
            break;

        case 'feedback':
            if($_GET['status']){
                switch($_GET['status']){
                    case 'add_OK':
                        $params['status'] = 'Отзыв добавлен.';
                        break;
                    case 'edit_OK':
                        $params['status'] = 'Отзыв Отредактирован.';
                        break;
                    case 'delete_OK':
                        $params['status'] = 'Отзыв удалён.';
                        break;
                }
            }
            doFeedbackAction($params, $action);
            $params['feedback'] = getAllFeedback();
            break;

        case 'apicatalog':
            echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
            die();

        case 'calc':
            if(isset($_GET['arg1'])){
                $params['arg1'] = $_GET['arg1'];
                $params['arg2'] = $_GET['arg2'];
                $params['operation'] = $_GET['operation'];
                $params['mathResult'] = math_operation((float)$params['arg1'], (float)$params['arg2'], $params['operation']);
            }
            if(isset($_GET['number1'])){
                $params['number1'] = $_GET['number1'];
                $params['number2'] = $_GET['number2'];
                $params['operation'] = $_GET['operation'];
                $params['mathResult2'] = math_operation((float)$params['number1'], (float)$params['number2'], $params['operation']);
            }
            break;
    }
return $params;
}