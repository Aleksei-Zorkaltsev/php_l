<?php
function getAllFeedback() {
    $sql = "SELECT * FROM feedback ORDER BY id DESC";
    return getAssocResult($sql);
}

function addFeedBack($name, $feedbackText){
    $sql = "INSERT INTO feedback (`name`, feedback) VALUES ('{$name}','{$feedbackText}')";
    executeSql($sql);
}

function deleteFeedBack($id) {
    $sql = "DELETE FROM feedback WHERE id={$id}";
    executeSql($sql);
}

function editFeedBack($id){
    $sql = "SELECT * FROM feedback WHERE id={$id}";
    $data = getOneResult($sql);
    return $data;
}

function saveFeedBack($id, $name, $feedback){
    $sql = "UPDATE feedback SET `name` = '{$name}', `feedback` = '{$feedback}' WHERE id={$id}";
    executeSql($sql);
}

function doFeedbackAction(&$params, $action){
    $params['action_fb'] = 'add';
    $params['buttonText'] = 'Добавить';

    if ($action == "add"){
        $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
        $textFeedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));
        addFeedBack($name , $textFeedback);
        header("Location: /feedback/?status=add_OK");
    }
    if ($action == "edit"){
        $params['buttonText'] = 'Сохранить';
        $params['action_fb'] = 'save';
        $params['author_id'] = (int)$_GET['id'];

        $feedback = editFeedBack($params['author_id']);

        $params['author'] =  $feedback['name'];
        $params['feedbackText'] = $feedback['feedback'];
        
    }
    if ($action == "delete") {
        $id = (int)$_GET['id'];
        deleteFeedBack($id);
        header("Location: /feedback/?status=delete_OK");
    }
    if ($action == "save"){
        $id = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['id'])));
        $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
        $textFeedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));
        saveFeedBack($id, $name, $textFeedback);
        header("Location: /feedback/?status=edit_OK");
    }
}