<?php
function interceptAsync(){
    if(!isset($_GET['async_request'])){
        return;
    }

    $result = json_decode(trim(file_get_contents('php://input')), true);
    $asyncAction = $result['action'];
    $session_id = session_id();
    
    switch($asyncAction){

        case 'getDetails':
            $order_id = $result['order_id'];
            $order = getoneOrder($order_id);
            $orderlist = getOrderDetails($order_id);
            unset($order['session_id']);
            $responce['order'] = $order;
            $responce['orderlist'] = $orderlist;
            echo json_encode($responce , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            die();
            break;

        case 'addLike':
            $id = $result['id']; 
            $getLikes = catalogAddLike($id);
            $responce['status'] = 'ok';
            $responce['likes'] = $getLikes['likes'];
            echo json_encode($responce , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            die();
            break;

        case 'addToCart':{
            $item_id = $result['item_id'];
            $user_id = $result['user_id'];  
            addToCart($item_id, $session_id, $user_id);
            $responce['count'] = countInCart($session_id);

            echo json_encode($responce , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            die();
            break;
        }
        case 'cart_CountPlusOrMinus':
            $action = $result['sub_action'];
            $user_id = $result['user_id'];
            $item_id = $result['item_id'];
            $count = $result['count'];

            if ($action == 'countPlus'){
                $countItem = addToCart($item_id, $session_id, $user_id);
                $responce['count_item'] = $countItem;
                $responce['count'] = countInCart($session_id);
                $responce['sum_price'] = itemCartSumPrice($item_id, $session_id);

                echo json_encode($responce , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                die();
            } elseif ($action == 'countMinus'){
                $countItem = minusCount($item_id, $count, $session_id);
                $responce['count_item'] = $countItem;
                $responce['count'] = countInCart($session_id);

                $responce['sum_price'] = itemCartSumPrice($item_id, $session_id);
                echo json_encode($responce , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                die();
            }
            break;
    }
}

function prepareVariables($page, $action = ""){
    $params = [];
    $params['allow'] = false;
    $params['reg_form_show'] = false;
    $params['logIn_form_show'] = false;
    $session_id = session_id();

    if (is_auth()){
        $params['allow'] = true;
        $params['user'] = get_user();
        $params['admin_status'] = is_admin();
        $user_id = get_user_id($params['user']);
        $params['user_id'] = $user_id['id'];
    }

    $params['count_inCart'] = countInCart($session_id);

    switch ($page) {
        case 'admin':
            if(!(is_auth() && is_admin())){
                echo "нет доступа.";
                die();
            }
            $params['orders'] = getOrders();
            $params['orders_Approved'] = getOrdersApproved();
            $params['user_list'] = getUserList();
            break;

        case 'admin_order_details':
            if(!(is_auth() && is_admin())){
                echo "нет доступа.";
                die();
            }

            if(isset($_GET['del'])){
                $order_id = (int)$_GET['order_id'];
                admin_deleteOrder($order_id);
                header('Location: /admin');
                die();
            }

            $id = (int)$_GET['order_id'];

            if(isset($_GET['order_complete'])){
                orderAproved($id);
                header("Location: /admin");
                die();
            }

            $params['order'] = getoneOrder($id);
            $params['order_list'] = getOrderDetails($params['order']['id']);

            if($params['order']['user_id']){
                $params['order_Userlogin'] = getUserLogin($params['order']['user_id']);
            }
            break;


        case 'registration':
            $params['reg_form_show'] = true;
            if(isset($_POST['reg_ok'])){
                $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['reg_login'])));
                $pass = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['reg_pass']))); 
                $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
                registration($login, $hash_pass);
                header('Location: /');
                die();
            }
            break;
        case 'login':
            $params['logIn_form_show'] = true;

            if (isset($_POST['ok'])){
                $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['login'])));
                $pass = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['pass'])));
                if (auth($login, $pass)){
                    session_regenerate_id();
                    updateUserCart($_SESSION['id'], session_id());
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
                $id_review = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_GET['delete_id_review']))); // безопасность
                deleteReview($id_review);
                header("Location: /catalog_item/?id={$id_item}");
                die();
            }
            break;

        case 'cart': 
            $params['cart_list'] = get_CartList($session_id);
            if(isset($_GET['order'])){
                $name = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['name']))); // безопасность
                $phone = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['phone']))); // безопасность
                $add_status = addOrder($name, $phone, $session_id, $user_id['id'], $params['cart_list']);
                if($add_status){
                    session_regenerate_id(); 
                    header("Location: /cart/?orderStatus=access");
                    die();
                } else {
                    header("Location: /cart/?orderStatus=error");
                    die();
                }
            }
            if(isset($_GET['orderStatus'])){
                $status = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_GET['orderStatus']))); // безопасность
                if($status == 'access'){
                    $params['message_status'] = "Заказ успешно добавлен";
                } else {
                    $params['message_status'] = "Ошибка";
                }
            }
            if(isset($_GET['del'])){
                $order_id = (int)$_GET['order_id'];
                user_deleteOrder($order_id, $user_id['id']);
                header('Location: /cart');
                die();
            }
            if($params['allow']){
                $params['user_orders'] = getUserOrders($user_id['id']);
            }
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
            doFeedbackAction($params, $action, $user_id['id']);
            $params['feedback'] = getAllFeedback();
            break;

        case 'apicatalog':
            echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
            die();

        case 'calc':
            if(isset($_GET['arg1'])){
                $params['arg1'] = (int)$_GET['arg1'];
                $params['arg2'] = (int)$_GET['arg2'];
                $params['operation'] = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_GET['operation']))); // безопасность
                $params['mathResult'] = math_operation((float)$params['arg1'], (float)$params['arg2'], $params['operation']);
            }
            if(isset($_GET['number1'])){
                $params['number1'] = (int)$_GET['number1'];
                $params['number2'] = (int)$_GET['number2'];
                $params['operation'] = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_GET['operation']))); // безопасность
                $params['mathResult2'] = math_operation((float)$params['number1'], (float)$params['number2'], $params['operation']);
            }
            break;
    }
return $params;
}