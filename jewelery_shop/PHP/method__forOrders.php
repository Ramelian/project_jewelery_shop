<?php
session_start();
include("functions.php");

if($_POST['action'] == "addOrder"){
    global $order;
    $company_name = htmlspecialchars($_POST['company_name']);
    $country = htmlspecialchars($_POST['country']);
    $street = htmlspecialchars($_POST['street']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $city = htmlspecialchars($_POST['city']);
    $order_notes = htmlspecialchars($_POST['order_notes']);

    $result_id = $order->insertOrder($_POST['first_name'], $_POST['last_name'],
        $company_name, $country, $street, $postcode, $city,
        $_POST['phone'], $_POST['email'], $order_notes, $_POST['payment']);

    foreach($_SESSION['cart'] as $addingItem) {
        $order->insertOrderProduct($addingItem['addingElementID'], $result_id, $addingItem['addingElementAmount']);
    }

    $_SESSION['cart'] = array();

    header("Location: order_details.php?confirmed=1&orderID={$result_id}");
    exit;
}
