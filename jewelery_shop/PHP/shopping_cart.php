<?php
include ("_header.php");
shuffle($products_shuffle);
?>

    <section class="section-cart section-outer">
    <div class="section-inner">
        <h1>Shopping Cart</h1>

        <div class="section-cart__wrapper shoppingCartItems">
            <div class="section-cart__items items">
                <?php if(count($_SESSION['cart']) == 0){ ?>
                    <h2 style="text-align: center;">Your cart is empty!</h2>
                    <input type="hidden" id="session-cart_ifEmpty">
                <?php }
                foreach($_SESSION['cart'] as $session_item){
                $item = $product->getProduct($session_item['addingElementID'])?>
                <div class="item">
                    <input type="hidden" class="item_id" value= "<?= $item['id'] ?? null ?>">
                    <img src=<?= $item['image']?> alt="image" class="item__image">
                    <div class="item__details">
                        <div class="item__details-title"><?= $item['name']?></div>
                        <div class="item__details-options"><?= $item['colour'] ?></div>
                        <div class="item__details-price">$ <?= str_replace(',' ,'.', $item['price']) ?></div>
                    </div>
                    <div class="change_amount">
                        <button class="btn-minus">-</button>
                        <input type="text" value="<?= $session_item['addingElementAmount'] ?>" class="input_value"
                        data-amount="<?= $session_item['addingElementAmount'] ?>" data-price ="<?= $item['price'] ?>" disabled>
                        <button class="btn-plus">+</button>
                    </div>
                    <div class="item-cross">&#10006;</div>
                </div>
                <?php } ?>
            </div>

            <div class="section-cart__total">
                <div class="section-cart__total-wrapper">
                    <h2>Cart totals</h2>
                    <ul class="section-cart__total-list">
                        <li>
                            <span class="title">subtotal</span>
                            <span class="price subtotal">$ 65,00</span>
                        </li>
                        <li>
                            <span class="title">shipping</span>
                            <span class="price shippingPrice" data-price="5.00">$ 5,00</span>
                        </li>
                    </ul>
                    <div class="section-cart__total-sum">
                        <span class="title">total</span>
                        <span class="price total-shoppingCart">$ 87,00</span>
                    </div>

                    <button class="section-cart__total-button">proceed to checkout</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?php
include("_footer.php");
?>
<script src="../javascript_additional/shopping_cart.js"></script>
</body>
</html>