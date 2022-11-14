<?php
require("functions.php");
    if(isset($_POST['product_id']) && isset($_POST['text']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['rating_value'])){
        if(!(($_POST['product_id'] == $_SESSION['review']['product_id']) && ($_POST['text'] == $_SESSION['review']['text']))){
            $_SESSION['review'] = array('product_id' => $_POST['product_id'], 'name' => $_POST['name'],'rating_value' => $_POST['rating_value'],'text'=> $_POST['text'],'email'=> $_POST['email']);
            $product->insertReview($_SESSION['review']['product_id'], $_SESSION['review']['name'], $_SESSION['review']['rating_value'], $_SESSION['review']['text'], $_SESSION['review']['email']);
        }
    }

    header("Location: product_description.php?id= {$_POST['product_id']}");
?>