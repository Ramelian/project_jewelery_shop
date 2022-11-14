<?php
include("functions.php");
session_start();
if($_POST['action'] == "restore") {
    $_SESSION['cart'] = array();
    exit;
}

else if($_POST['action'] == "add"){
    $_SESSION['cart'][] = ['addingElementID' => intval($_POST['addingElementID']),
        'addingElementAmount' => intval($_POST['addingElementAmount'])];
    exit;
}

else if($_POST['action'] == "deleteItem"){
    $new = array_filter($_SESSION['cart'], function ($var) {
        return ($var['addingElementID'] !== intval($_POST['deleteItemId']));
    });

    $_SESSION['cart'] = $new;
    exit;
}
