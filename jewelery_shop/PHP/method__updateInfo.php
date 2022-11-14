<?php
session_start();
require("functions.php");

if(isset($_POST["action"])){
    if($_POST["action"] == "updateAccount"){
        updateAccount();
    }
    if($_POST["action"] == "addAddress"){
        updateAddress();
        header("Location: myaccount.php");
        exit;
    }

    if($_POST['action'] == "addEmailAdvertisement"){
        addAdvertisementEmail();
        header('Location: ' .  $_SERVER['HTTP_REFERER']);
        exit;
    }
}

function updateAddress(){
    global $customer;
    $company_name = $_POST['company_name'] == "" ? "unknown" : $_POST['company_name'];
    $country = $_POST['country'];
    $street = $_POST['street'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $customer_id = $_SESSION['customer']['id'];

    $customer->insertAddress($customer_id, $company_name, $country, $street,$postcode, $city);
}

function updateAccount(){
    global $customer;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $display_name = $_POST['display_name'];
    $email = $_POST['email'];
    $current_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];

    if($customer->checkPassword($_SESSION['customer']['email'], $current_password)){
        $customer->updateDetails($first_name, $last_name, $display_name, $email, $new_password);
        $_SESSION['customer'] = array();
        $_SESSION['customer'] = $customer->getCustomer($email);
        echo "updated";
    }
    else{
        echo "password not working";
    }
}

function addAdvertisementEmail(){
    global $customer;
    $customer->insertEmail($_POST['email']);
}
