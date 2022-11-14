<?php
session_start();
if(!isset($_SESSION['customer'])){
    header("Location: login_register.php");
}
include ("_header.php");
?>
<div class="section-myAccount section-outer">
    <div class="section-inner">

        <h1>My Account</h1>
        <div class="section-myAccount__titles__wrapper">
            <div class="section-myAccount__titles">
                <div class="section-myAccount__titles-dashboard">
                    <div class="title">
                        Dashboard
                    </div>
                </div>
                <div class="section-myAccount__titles-orders">
                    <div class="title">
                        Orders
                    </div>
                </div>
                <div class="section-myAccount__titles-addresses">
                    <div class="title">
                        Addresses
                    </div>
                </div>
                <div class="section-myAccount__titles-account_details">
                    <div class="title">
                        Account details
                    </div>
                </div>
                <div class="section-myAccount__titles-logout">
                    <div class="title">
                        Logout
                    </div>
                </div>
                <div class="title_border"></div>
            </div>
            <div class="section-myAccount__titles-mobile__wrapper">
                <div class="section-myAccount__titles-mobile owl-carousel owl-theme">
                    <div class="section-myAccount__titles-mobile-dashboard">
                        <div class="title">
                            Dashboard
                        </div>
                    </div>
                    <div class="section-myAccount__titles-mobile-orders">
                        <div class="title">
                            Orders
                        </div>
                    </div>
                    <div class="section-myAccount__titles-mobile-addresses">
                        <div class="title">
                            Addresses
                        </div>
                    </div>
                    <div class="section-myAccount__titles-mobile-account_details">
                        <div class="title">
                            Account details
                        </div>
                    </div>
                    <div class="section-myAccount__titles-mobile-logout">
                        <div class="title">
                            Logout
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-myAccount__content">
            <div class="section-myAccount__content-dashboard">
                <p>
                    Hello <?= $_SESSION['customer']['display_name'] ?> (not <?= $_SESSION['customer']['display_name'] ?>? <span class="section-myAccount__dashboard-logout">Log out</span>)<br>
                    From your account dashboard you can view your <span class="section-myAccount__content-dashboard__recent-orders">recent orders</span>, manage your <span class="section-myAccount__content-dashboard__address">shipping addresses</span>, and edit your <span class="section-myAccount__content-dashboard__password">password and account details.</span>
                </p>
            </div>
            <div class="section-myAccount__content-orders">
                <table class="orders__table">
                    <tr class="orders__table-titles">
                        <th class="orders__table-title">ORDER NUMBER</th>
                        <th class="orders__table-title">DATE</th>
                        <th class="orders__table-title">STATUS</th>
                        <th class="orders__table-title">TOTAL</th>
                        <th class="orders__table-title">ACTIONS</th>
                    </tr>
                    <?php
                        global $order;
                        $myOrders = $order->getOrders($_SESSION['customer']['email']);
                        foreach ($myOrders as $currentOrder){
                    ?>
                    <tr class="orders__table-items">
                        <td class="orders__table-item"><?= $currentOrder['id'] ?></td>
                        <td class="orders__table-item"><?= $currentOrder['date_of_order'] ?></td>
                        <td class="orders__table-item"><?= $currentOrder['status'] ?></td>
                        <?php
                        $products = $order->getProducts($currentOrder['id']);
                        $subtotal = 0;
                            foreach($products as $product){
                        $subtotal += $product['price']*$product['amount'];}
                        ?>
                        <td class="orders__table-item">$ <?= $subtotal ?></td>
                        <td class="orders__table-item">
                            <a href="order_details.php?orderID=<?= $currentOrder['id'] ?>">View Order</a>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <div class="orders__list">
                <?php
                global $order;
                $myOrders = $order->getOrders($_SESSION['customer']['email']);
                foreach ($myOrders as $currentOrder){
                ?>
                <ul>
                    <li>
                        <span class="title">ORDER NUMBER</span>
                        <span class="content"><?= $currentOrder['id'] ?></span>
                    </li>
                    <li>
                        <span class="title">DATE</span>
                        <span class="content"><?= $currentOrder['date_of_order'] ?></span>
                    </li>
                    <li>
                        <span class="title">STATUS</span>
                        <span class="content"><?= $currentOrder['status'] ?></span>
                    </li>
                    <?php
                    $products = $order->getProducts($currentOrder['id']);
                    $subtotal = 0;
                    foreach($products as $product){
                        $subtotal += $product['price']*$product['amount'];}
                    ?>
                    <li>
                        <span class="title">TOTAL</span>
                        <span class="content">$ <?= $subtotal ?></span>
                    </li>
                    <li>
                        <span class="title">ACTIONS</span>
                        <a href="order_details.php?orderID=<?= $currentOrder['id'] ?>">View Order</a>
                    </li>
                </ul>
                <?php }?>
                </div>
            </div>
            <div class="section-myAccount__content-addresses">
                <div class="addresses-list">
                    <div class="addresses-list__default addresses-list__hide">The following address will be used on the checkout page by default.</div>
                    <div class="addresses-list__title">
                        Billing address
                    </div>
                    <?php
                        global $customer;
                        if($customer->checkIfExistAddress($_SESSION['customer']['id'])){
                    ?>
                    <div class="addresses-list__add addresses-list__hide">ADD</div>
                    <div class="addresses-list__notSet addresses-list__hide">
                        You have not set up this type of address yet.
                    </div>
                    <?php }
                        else{
                            $currentAddress = $customer->getAddress($_SESSION['customer']['id']);
                            ?>
                    <ul class="section-order__details-list">
                        <li class="item">
                            <div class="item-title">COMPANY NAME</div>
                            <div class="item-content"><?= $currentAddress['company_name'] ?></div>
                        </li>
                        <li class="item">
                            <div class="item-title">YOUR COUNTRY</div>
                            <div class="item-content"><?= $currentAddress['country'] ?></div>
                        </li>
                        <li class="item">
                            <div class="item-title">YOUR STREET</div>
                            <div class="item-content"><?= $currentAddress['street'] ?></div>
                        </li>
                        <li class="item">
                            <div class="item-title">YOUR POSTCODE</div>
                            <div class="item-content"><?= $currentAddress['postcode'] ?></div>
                        </li>
                        <li class="item">
                            <div class="item-title">YOUR CITY</div>
                            <div class="item-content"><?= $currentAddress['city'] ?></div>
                        </li>
                    </ul>
                    <div class="addresses-list__add addresses-list__hide">UPDATE</div>
                    <?php } ?>
                </div>

                <form action="method__updateInfo.php" method="post" name="addresses__form" class="addresses-add">
                    <input type="text" maxlength="30" name="company_name" placeholder="Company Name" >
                    <div class="error error_text"></div>
                    <input type="text" maxlength="30" name="country" placeholder="Country *" class="mandatory">
                    <div class="error error_text"></div>
                    <input type="text" maxlength="30" name="street" placeholder="Street Address *" class="mandatory">
                    <div class="error error_text"></div>
                    <input type="text" maxlength="30" name="postcode" placeholder="Postcode / ZIP *" class="mandatory">
                    <div class="error error_text"></div>
                    <input type="text" maxlength="30" name="city" placeholder="Town / City *" class="mandatory">
                    <div class="error error_text"></div>
                    <input type="hidden" name="action" value="addAddress">
                    <button type="submit" class="addresses__form-button">Save Address</button>
                </form>

            </div>
            <div class="section-myAccount__content-account_details">
                <h1>Account details</h1>
                <form name="myAccount-details__form" class="details__form">
                    <input class="mandatory" name="first_name" type="text" maxlength="30" placeholder="First name*">
                    <div class="error error_text"></div>
                    <input class="mandatory" name="last_name" type="text" maxlength="30" placeholder="Last name*">
                    <div class="error error_text"></div>
                    <input type="text" name="display_name" maxlength="30" placeholder="Display name">
                    <div class="error error_text"></div>
                    <input class="mandatory" name="email" maxlength="30" type="email" placeholder="Email address*">
                    <div class="error error_text"></div>
                    <div class="details__form-title">
                        Password change
                    </div>
                    <input type="password" class="mandatory" name="current_password" maxlength="17" placeholder="Current password*">
                    <div class="error error_text"></div>
                    <input type="password" name="new_password" maxlength="17" placeholder="New password (leave blank to leave unchanged)">
                    <div class="error error_text"></div>
                    <input type="password" name="new_password-confirm" maxlength="17" placeholder="Confirm new password">
                    <div class="error error_text"></div>
                    <button type="button" class="details__form-button">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("_footer.php");
?>
<script src="../javascript_additional/myAccount.js"></script>
</body>
</html>
