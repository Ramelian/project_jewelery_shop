<?php
session_start();
require("functions.php");

// IF
if(isset($_POST["action"])){
    if($_POST["action"] == "register")
        register();

    else if($_POST["action"] == "login") {
        $_SESSION['cart'] = array();
        login();
    }

    else if($_POST["action"] == "logout")
        session_destroy();
}

// REGISTER
function register(){
    global $customer;
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $display_name = $_POST["display_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $checkEmail =  $customer->checkIfExist($email);
    if($checkEmail){
        echo "Email Has Already Taken";
        exit;
    }

    $customer->insertCustomer($first_name, $last_name, $display_name, $email, $password);
    echo "Registration Successful";
}

// LOGIN
function login(){
    global $customer;
    $email = $_POST["email"];
    $password = $_POST["password"];

    $checkEmail =  $customer->checkIfExist($email);
    if($checkEmail){
       $checkPassword = $customer->checkPassword($email, $password);

       if($checkPassword){
           $_SESSION['customer'] = $customer->getCustomer($email);
           echo "Successful login";
           exit;
       }

       else{
           echo "Incorrect password";
           exit;
       }
    }

    else{
        echo "Customer with this email doesn't exist";
        exit;
    }
}

?>