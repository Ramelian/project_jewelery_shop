<?php

// require MySQL Connection
require ('../database/DBController.php');

// require Products functions
require ('../database/Product.php');

// require Customer functions
require ('../database/Customer.php');

// require Order functions
require ('../database/Order.php');

// DBController object
$db = new DBController();

// Product object
$product = new Product($db);
$customer = new Customer($db);
$order = new Order($db);

$products_shuffle = $product->getData();
