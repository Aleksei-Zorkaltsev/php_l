<?php

function prepareVariables($page, $action = "")
{
    $params = [];

    switch ($page) {

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
            }

            if(isset($_GET['delete_id_review'])){
                $id_review = $_GET['delete_id_review'];
                deleteReview($id_review);
                header("Location: /catalog_item/?id={$id_item}");
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
            doFeedbackAction($params, $action);
            $params['feedback'] = getAllFeedback();
            break;

        case 'apicatalog':
            echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
            die();

        case 'calc':
            break;

    }
return $params;
}