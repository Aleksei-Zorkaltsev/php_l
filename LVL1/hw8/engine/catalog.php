<?php
function getCatalog() {
    return getAssocResult("SELECT * FROM `catalog`");
}

function getItemCatalog($id) {
    return getOneResult("SELECT * FROM `catalog` WHERE id = {$id}");
}
function getReviewsCatalogItem($id){
    return getAssocResult(
        "SELECT id, name, textReview FROM review_item WHERE item_catalog_id={$id};"
    );
}
function addReviewToItem($id_item){
    $name = $_POST['author_name'];
    $review_text = $_POST['review_text'];
    $sql = "INSERT INTO `review_item`(name, textReview, item_catalog_id) VALUES ('{$name}','{$review_text}', {$id_item});";
    executeSql($sql);
}

function deleteReview($id_review){
    $sql = "DELETE FROM review_item WHERE id={$id_review}";
    executeSql($sql);
}

function catalogAddLike($id){
    $sql = "UPDATE `catalog` SET likes = likes+1 WHERE id = {$id}";
    executeSql($sql);
    $sql2 ="SELECT likes FROM `catalog` WHERE id={$id}";
    return getOneResult($sql2);
}
