<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelery shop</title>

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Allerta+Stencil&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- noUIslider -->
    <link rel="stylesheet" href="../noUIslider/nouislider.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="../scss/main.css">

</head>
<body>
<?php
require('functions.php');
?>
<header class="section-outer section-header header_with_border">
    <div class="section-inner">
        <div class="section-header__logo">
            <a href="index.php">
                <h1><span class="logo-coloured">s</span><span>hoppe</span></h1>
            </a>
        </div>

        <div class="section-header__navigation">
            <ul class="section-header__navigation1">
                <li class="section-header__navigation1-item active">
                    <a class="section-header__navigation1-item-link" href="#">Shop</a>
                </li>
                <li class="section-header__navigation1-item">
                    <a class="section-header__navigation1-item-link" href="#">Blog</a>
                </li>
                <li class="section-header__navigation1-item">
                    <a class="section-header__navigation1-item-link"
                       href="#">Our Story</a>
                </li>
            </ul>

            <ul class="section-header__navigation2">
                <li class="section-header__navigation2-item">
                    <div class="section-header__navigation2-item-link">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </li>
                <li class="section-header__navigation2-item">
                    <div class="shopping_cart-icon" href="#">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </li>
                <li class="section-header__navigation2-item">
                    <a class="section-header__navigation1-item-link" href="">
                        <i class="fa-regular fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <dialog class="shopping-bag">
        <div class="shopping-bag__wrapper shoppingCartItems">
            <div class="shopping-bag__content">
                <div class="shopping-bag__title">Shopping bag</div>
                <div class="shopping-bag__amount"><span class="items__amount">5</span> items</div>
                <div class="shopping-bag__items items">
                    <div class="item">
                        <img src="../scss/assets/necklace_image.png" alt="item image" class="item__image">
                        <div class="item__details">
                            <div class="item__details-title">Necklace gold</div>
                            <div class="item__details-options">Black / Medium</div>
                            <div class="item__details-price">$ 20,00</div>
                            <div class="change_amount">
                                <button class="btn-minus">-</button>
                                <input type="text" value="1" class="input_value" data-price ="20.00" disabled>
                                <button class="btn-plus">+</button>
                            </div>
                        </div>
                        <div class="item-cross">&#10006;</div>
                    </div>
                </div>
            </div>

            <div class="shopping-bag__footer">
                <div class="shopping-bag__footer-subtotal">
                    <span>Subtotal (5 items)</span>
                    <span class="subtotal">--</span>
                </div>
                <a href="#">
                    <button class="shopping-bag__footer-button">VIEW CART</button>
                </a>

            </div>
        </div>
    </dialog>
</header>