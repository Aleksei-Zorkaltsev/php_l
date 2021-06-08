<?php
function getAllFeedback() {
    $sql = "SELECT f.id, f.user_id, f.feedback, u.`login` 
    FROM feedback f
    JOIN users u ON f.user_id = u.id
    ORDER BY f.id DESC";
    return getAssocResult($sql);
}

function addFeedBack($feedbackText, $user_id){
    $sql = "INSERT INTO feedback (`user_id`, feedback) VALUES ({$user_id},'{$feedbackText}')";
    executeSql($sql);
}

function deleteFeedBack($id) {
    $sql = "DELETE FROM feedback WHERE id={$id}";
    executeSql($sql);
}

function editFeedBack($id){
    $sql = "SELECT u.login as `user_name`, f.feedback, f.id as fb_id
    FROM feedback f
    JOIN users u ON f.user_id = u.id
    WHERE f.id = {$id}";
    $data = getOneResult($sql);
    return $data;
}

function saveFeedBack($id, $feedback){
    $sql = "UPDATE feedback SET `feedback` = '{$feedback}' WHERE id={$id}";
    executeSql($sql);
}

function doFeedbackAction(&$params, $action, $user_id){
    $params['action_fb'] = 'add';
    $params['buttonText'] = 'Добавить';
    $params['fb_head_message'] = 'Оставьте ваш отзыв:';

    if ($action == "add"){
        $textFeedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));
        addFeedBack($textFeedback, $user_id);
        header("Location: /feedback/?status=add_OK");
    }
    if ($action == "edit"){
        $params['fb_head_message'] = 'Режим редактирования:';
        $params['buttonText'] = 'Сохранить';
        $params['action_fb'] = 'save';
        $params['feedback_id'] = (int)$_GET['id'];
        $user_id = (int)$_GET['user_id'];
        $feedback = editFeedBack($params['feedback_id']);
        $params['feedback_id'] = $feedback['fb_id'];
        $params['author_fb'] = $feedback['user_name'];
        $params['feedbackText'] = $feedback['feedback'];
    }
    if ($action == "delete") {
        $id = (int)$_GET['id'];
        deleteFeedBack($id);
        header("Location: /feedback/?status=delete_OK");
    }
    if ($action == "save"){
        $id = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['id'])));
        $textFeedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['message'])));
        saveFeedBack($id, $textFeedback);
        header("Location: /feedback/?status=edit_OK");
    }
}