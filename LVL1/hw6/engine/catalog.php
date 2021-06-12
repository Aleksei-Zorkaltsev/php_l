<?php
function getCatalog() {
    return getAssocResult("SELECT * FROM `catalog`");
}

function getItemCatalog($id) {
    return getOneResult("SELECT * FROM `catalog` WHERE id = {$id}");
}
function getReviewsCatalogItem($id){
    return getAssocResult(
        "SELECT 
        ri.id,
        ri.name,
        ri.textReview
        FROM review_list rl
        join `catalog`c ON rl.item_id=c.id
        join review_item ri ON rl.rewiew_id=ri.id
        WHERE c.id={$id} ORDER BY ri.id DESC"
    );
}
function addReviewToItem($id_item){
    $name = $_POST['author_name'];
    $review_text = $_POST['review_text'];
    $sql = "INSERT INTO `review_item`(name, textReview) VALUES ('{$name}','{$review_text}');";
    executeSql($sql);
    $id_review = mysqli_insert_id(getDb());
    $sql2 = "INSERT INTO `review_list` (item_id, rewiew_id) VALUES({$id_item} , {$id_review});";
    executeSql($sql2);
}

function deleteReview($id_review){
    $sql = "DELETE FROM review_item WHERE id={$id_review}";
    executeSql($sql);
}