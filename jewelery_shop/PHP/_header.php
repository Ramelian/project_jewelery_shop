<?php
if(!isset($_SESSION))
session_start();

require('functions.php');
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!$_SESSION['customer']){
        header('Location: login_register.php');
        exit;
    }

    if (isset($_POST['addingElementID'])) {
        //        $productsInCart = array_column($_SESSION['cart'], $_POST['addingElementID']);
        $_SESSION['cart'][] = ['addingElementID' => intval($_POST['addingElementID']),
            'addingElementAmount' => intval($_POST['addingElementAmount'])];
    } else {
        $disabled = false;
        $buttonText = "Add to cart";
    }
    header ('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}
?>

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
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="../scss/main.css">
    <!-- noUIslider -->
    <link rel="stylesheet" href="../noUIslider/nouislider.min.css">

</head>
<body>

<header class="section-outer section-header">
    <div class="section-inner">
        <div class="section-header__logo">
            <a href="index.php">
                <h1><span class="logo-coloured">s</span><span>hoppe</span></h1>
            </a>
        </div>
        
        <div class="section-header__navigation">
            <ul class="section-header__navigation1">
                <li class="section-header__navigation1-item" id="nav-shop">
                    <a class="section-header__navigation1-item-link" href="shop.php">Shop</a>
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
                    <a href="shop.php" class="section-header__navigation2-item-link">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </li>
                <li class="section-header__navigation2-item">
                    <div class="shopping_cart-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </li>
                <li class="section-header__navigation2-item">
                    <div class="user-icon">
                        <i class="fa-regular fa-user"></i>
                        <input type="hidden" class="user-icon__value" value=<?php if(isset($_SESSION['customer'])) echo "true"; else echo "false" ?> >
                    </div>
                </li>
            </ul>
        </div>

        <div class="section-header__navigation-mobile">
            <div id="shopping-cart__mobile" class="section-header__navigation-mobile__shopping-cart">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div id="burger" class="section-header__navigation-mobile__burger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar bar-small"></span>
            </div>
        </div>


    </div>

    <dialog class="shopping-bag">
        <div class="shopping-bag__wrapper shoppingCartItems">

            <div class="shopping-bag__content">
                <i id="shopping-bag__back" class="fa-solid fa-angle-left"></i>
                <div class="shopping-bag__title">Shopping bag</div>
                <div class="shopping-bag__amount"><span class="items__amount">5</span> items</div>
                <div class="shopping-bag__items items">
                    <?php foreach($_SESSION['cart'] as $session_item){
                        $item = $product->getProduct($session_item['addingElementID'])?>
                    <div class="item">
                        <input type="hidden" class="item_id" value= "<?= $item['id'] ?? null ?>">
                        <img src=<?= $item['image']?> alt="image" class="item__image">
                        <div class="item__details">
                            <div class="item__details-title"><?= $item['name']?></div>
                            <div class="item__details-options"><?= $item['colour'] ?></div>
                            <div class="item__details-price">$ <?= str_replace(',' ,'.', $item['price']) ?></div>
                            <div class="change_amount">
                                <button class="btn-minus">-</button>
                                <input type="text" value="<?= $session_item['addingElementAmount'] ?>"
                                       class="input_value" data-price ="<?= $item['price'] ?>"
                                       data-amount="<?= $session_item['addingElementAmount']?>" disabled>
                                <button class="btn-plus">+</button>
                            </div>
                        </div>
                        <div class="item-cross">&#10006;</div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="shopping-bag__footer">
                <div class="shopping-bag__footer-subtotal">
                    <span>Subtotal (<span class="items__amount">5</span> items)</span>
                    <span class="subtotal">--</span>
                </div>
                    <button class="shopping-bag__footer-button">VIEW CART</button>
            </div>

        </div>
    </dialog>


</header>

<div id="popup" class="section-popup">
    <ul class="section-popup__list1">
        <li class="item"><a href="index.php">Home</a></li>
        <li class="item"><a href="shop.php">Shop</a></li>
        <li class="item"><a href="#">About</a></li>
        <li class="item"><a href="#">Blog</a></li>
        <li class="item"><a href="#">Help</a></li>
        <li class="item"><a href="#">Contact</a></li>
        <li class="item"><a href="shop.php">Search</a></li>
    </ul>
    <ul class="section-popup__list2">
        <li class="item"><a href="myaccount.php">
                <i class="fa-regular fa-user"></i>
                <span>My account</span>
            </a></li>
        <li class="item" id="popup-logout"><a href="">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
            </a></li>
    </ul>
</div>