<?php
    include ("_header.php");
    shuffle($products_shuffle);
//    print_r($_SESSION['cart']);
?>

<div class="section-checkout section-outer">
    <div class="section-inner">
        <h1>Checkout</h1>

        <div class="section-checkout__wrapper">
            <div class="section-checkout__billing-details">
                <h2>Billing Details</h2>
                <form name="order_add-form" method="post" action="method__forOrders.php" class="addresses-add order_add-form">
                    <div class="name__block">
                        <div class="name__block-item">
                            <input type="text" name="first_name" placeholder="First name *" maxlength="30" class="first mandatory">
                            <div class="error error_text"></div>
                        </div>
                        <div class="name__block-item">
                            <input type="text" name="last_name" placeholder="last name *" maxlength="30" class="last mandatory">
                            <div class="error error_text"></div>
                        </div>
                    </div>
                    <input type="text" name="company_name" placeholder="Company Name" maxlength="30">
                    <div class="error error_text"></div>
                    <input type="text" name="country" class="mandatory" placeholder="Country *" maxlength="30">
                    <div class="error error_text"></div>
                    <input type="text" name="street" class="mandatory" placeholder="Street Address *" maxlength="30">
                    <div class="error error_text"></div>
                    <input type="text" name="postcode" class="mandatory" placeholder="Postcode / ZIP *" maxlength="30">
                    <div class="error error_text"></div>
                    <input type="text" name="city" class="mandatory" placeholder="Town / City *" maxlength="30">
                    <div class="error error_text"></div>
                    <input type="tel" name="phone" class="mandatory" placeholder="Phone *" maxlength="30">
                    <div class="error error_text"></div>
                    <input type="email" name="email" class="mandatory" placeholder="Email *"
                           maxlength="30" value="<?= $_SESSION['customer']['email'] ?>" readonly>
                    <div class="error error_text"></div>
                    <input type="text" name="order_notes" placeholder="Order Notes" maxlength="30">
                    <input type="hidden" name="payment" class="payment_method-value" value="cash">
                    <input type="hidden" name="action" value="addOrder">
                </form>
            </div>

            <div class="order-summary">
                <h2>Your Order</h2>
                <div class="order-summary-wrapper">
                    <ul class="order-summary-list">
                        <li class="item-product">
                            <span class="item-name">PRODUCT</span>
                            <span class="item-value">TOTAL</span>
                        </li>
                        <?php
                        $subtotal = 0;
                        foreach($_SESSION['cart'] as $session_item){
                        $item = $product->getProduct($session_item['addingElementID']);
                            $subtotal += $item['price']*$session_item['addingElementAmount']; ?>
                        <li class="item">
                            <span class="item-name"><?= $item['name'] ?></span>
                            <span class="item-value">
                                $ <?= str_replace(',' ,'.', $item['price']*$session_item['addingElementAmount']) ?>
                            </span>
                        </li>
                        <?php } ?>
                        <li class="item-subtotal">
                            <span class="item-name">SUBTOTAL</span>
                            <span class="item-value">
                                $ <?= str_replace(',' ,'.', $subtotal) ?>
                            </span>
                        </li>
                        <li class="item-shipping">
                            <span class="item-name">SHIPPING</span>
                            <span class="item-value">$5,00</span>
                        </li>
                        <li class="item-total">
                            <span class="item-name">TOTAL</span>
                            <span class="item-value">
                                $ <?= str_replace(',' ,'.', $subtotal+5) ?>
                            </span>
                        </li>

                    </ul>
                    <div class="payment">
                        <label class="container payment_method-cash">Cash on delivery
                            <input type="radio" checked="checked" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container payment_method-cart">Cart on delivery
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <button class="add_order-button">place order</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("_footer.php");
?>
<script src="../javascript_additional/checkout.js"></script>
</body>
</html>
