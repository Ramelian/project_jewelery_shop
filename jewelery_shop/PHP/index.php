<?php

//    $_SESSION['cart'] = array();
//    session_destroy();
    include('_header.php');

    shuffle($products_shuffle);
?>

<section class="section-outer section-banner">
    <div class="section-inner">
        <div class="owl-carousel owl-theme">
            <?php for($i=0; $i<4; $i++){ ?>
            <div class="section-banner__item">
                <img src="../scss/assets/main_page-banner.png" alt="product" class="section-banner__image">
                <div class="section-banner__text">
                    <h1 class="section-banner__text-title">Gold big hoops</h1>
                    <h2 class="section-banner__text-price">$ 68,00</h2>
                    <a href="product_description.php?id=1" class="section-banner__text-view-link">
                        <button class="section-banner__text-button">View Product</button>
                    </a>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>

<section class="section-outer section-catalog">
    <div class="section-inner">
        <div class="section-catalog__wrapper">
            <h1 class="section-catalog__title">Shop The Latest</h1>
            <a href="shop.php" class="section-catalog__subtitle">View All</a>
        </div>

        <!-- Catalog with items -->
        <div class="items">
            <?php foreach($products_shuffle as $item){ ?>
                <div class="wrapper">
                    <div class="item">
                        <?php
                        if(isset($_SESSION['cart'])) {
                            $addedItems = array_column($_SESSION['cart'], 'addingElementID');
                            if (in_array($item['id'], $addedItems)) {
                                $buttonText = "in the cart";
                                $disabled = true;
                            } else {
                                $buttonText = "Add to cart";
                                $disabled = false;
                            }
                        }
                        else {
                            $disabled = false;
                            $buttonText = "Add to cart";
                        }
                        ?>
                        <div class="item__image">
                            <img src=<?= $item['image']?> alt="item">
                            <div class="item__image-link">
                                <form method="post">
                                    <input type="hidden" class="addingElementID" name="addingElementID" value="<?= $item['id']?>">
                                    <input type="hidden" name="addingElementAmount" value="1">
                                    <button type="submit" <?php if($disabled){?> disabled <?php } ?>><?=$buttonText?></button>
                                </form>
                            </div>
                        </div>
                        <a href="product_description.php?id=<?= $item['id']?>" class="item__title"><?= $item['name'] ?></a>
                        <div class="item__price">$ <?= str_replace(',' ,'.', $item['price']) ?></div>
                    </div>
                </div>
            <?php }?>

        </div>
        <!-- !Catalog with items -->
    </div>
</section>


<?php
    include('_footer.php');
?>
<script src="../javascript_additional/main_page.js"></script>
</body>
</html>

