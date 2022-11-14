<?php
include ("_header.php");
shuffle($products_shuffle);
if(isset($_GET['confirmed'])){
?>

<div style="margin-top: 96px;" id="notification">
    <div class="section-inner">
        <i class="fa-solid fa-check"></i>
        <span class="notification-text">We’ve received your order</span>
    </div>
</div>

<?php }?>

<?php
    global $order;
    $order_id = intval($_GET['orderID']);
    $currentOrder = $order->getOrder($order_id, $_SESSION['customer']['email']);
//    print_r($currentOrder);
?>

<div class="section-order section-outer">
    <section class="section-inner">
        <div class="section-order__details">
            <h2>Order Details</h2>
            <div class="section-order__details-wrapper">
                <ul class="section-order__details-list">
                    <li class="item">
                        <div class="item-title">ORDER NUMBER</div>
                        <div class="item-content"><?= $currentOrder['id'] ?></div>
                    </li>
                    <li class="item">
                        <div class="item-title">EMAIL</div>
                        <div class="item-content"><?= $currentOrder['email'] ?></div>
                    </li>
                    <li class="item">
                        <div class="item-title">PAYMENT METHOD</div>
                        <div class="item-content"><?= $currentOrder['payment'] ?></div>
                    </li>
                    <li class="item">
                        <div class="item-title">ORDER DATE</div>
                        <div class="item-content"><?= $currentOrder['date_of_order'] ?></div>
                    </li>
                </ul>
                <ul class="section-order__details-list">
                    <li class="item">
                        <div class="item-title">DELIVERY OPTIONS</div>
                        <div class="item-content">Standard delivery</div>
                    </li>
                    <li class="item">
                        <div class="item-title">DELIVERY ADDRESS</div>
                        <div class="item-content"><?= $currentOrder['street'] ?><br>
                            <?= $currentOrder['postcode'] ?><br> <?= $currentOrder['city'] ?>
                            <br> <?= $currentOrder['country'] ?>
                        </div>
                    </li>
                    <li class="item">
                        <div class="item-title">CONTACT NUMBER</div>
                        <div class="item-content"><?= $currentOrder['phone'] ?></div>
                    </li>

                </ul>
            </div>
        </div>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <div class="order-summary-wrapper">
                <ul class="order-summary-list">
                    <li class="item-product">
                        <span class="item-name">PRODUCT</span>
                        <span class="item-value">TOTAL</span>
                    </li>
                    <?php
//                        print_r($order->getProducts($currentOrder['id']))
                        $products = $order->getProducts($currentOrder['id']);
                        $subtotal = 0;
                        foreach($products as $product){
                        $subtotal += $product['price']*$product['amount'];
                    ?>
                    <li class="item">
                        <span class="item-name"><?= $product['name'] ?> </span>
                        <span class="item-value">
                           $ <?= str_replace(',' ,'.', $product['price']*$product['amount']) ?>
                        </span>
                    </li>
                    <?php } ?>
                    </li>
                    <li class="item-subtotal">
                        <span class="item-name">SUBTOTAL</span>
                        <span class="item-value">$ <?= $subtotal ?></span>
                    </li>
                    <li class="item-shipping">
                        <span class="item-name">SHIPPING</span>
                        <span class="item-value">$ 5,00</span>
                    </li>
                    <li class="item-total">
                        <span class="item-name">TOTAL</span>
                        <span class="item-value">$ <?= $subtotal + 5 ?></span>
                    </li>

                </ul>
            </div>
        </div>
    </section>
</div>

<?php
include("_footer.php");
?>

</body>
</html>
