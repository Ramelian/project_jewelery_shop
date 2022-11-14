<?php
    session_start();
    include ("_header.php");
    global $product;
    global $products_shuffle;
    $item = $product->getProduct($_GET['id']);

    if(isset($_GET['confirmed'])){
?>

<div id="notification">
    <div class="section-inner">
        <i class="fa-solid fa-check"></i>
        <span class="notification-text">We’ve added this product to the cart</span>
    </div>
</div>

<?php }?>

    <div class="section-main_info section-outer">
    <div class="section-inner">

        <div class="section-main_info-grid">
            <div class="section-main_info-grid-small grid-small_hover">
                <img src="<?= $item['image'] ?>" alt="item" data-distance="0">
            </div>
            <div class="section-main_info-grid-small1 grid-small_hover">
                <img src="<?= $item['image'] ?>" alt="item" data-distance="25">
            </div>
            <div class="section-main_info-grid-small2 grid-small_hover">
                <img src="<?= $item['image'] ?>" alt="item" data-distance="50">
            </div>
            <div class="section-main_info-grid-small3 grid-small_hover">
                <img src="../assets_images/Plaine_Necklace.png" alt="item" data-distance="75">
            </div>
            <div class="section-main_info-grid-big">
                <img src="<?= $item['image'] ?>" alt="item" class = "big_image">
            </div>
        </div>

        <div class="section-main_info-details">
            <h2 class="section-main_info-details__title"><?= $item['name']?></h2>
            <div class="section-main_info-details__price">
                $ <?= str_replace(',' ,'.', $item['price']) ?>
            </div>
            <div class="section-main_info-details__raiting">
                <?php for($i=0; $i<5; $i++){
                    if ($i < ceil(floatval(($product->averageRaiting($item['id']))))){ ?>
                        <i class="fa fa-star"></i>
                    <?php }
                    else {?>
                        <i class="fa-regular fa-star"></i>
                    <?php }
                }?>
                <span><?= $product->countReviews($item['id']); ?> customer review</span>
            </div>
            <div class="section-main_info-details__general-information">
                <?= $item['description']?>
            </div>
            <div class="section-main_info-details__buttons">
                <div class="items">
                    <div class="change_amount">
                        <button class="btn-minus">-</button>
                        <input type="text" id="input_value-description" value="1" class="input_value" data-price ="20.00" disabled>
                        <button class="btn-plus">+</button>
                    </div>
                </div>

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
                <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $item['id'] ?>&confirmed=1" class="AddToCart" method="post">
                        <input type="hidden" class="addingElementID" name="addingElementID" value="<?= $item['id']?>">
                        <input type="hidden" id="addingElementAmount-description" name="addingElementAmount" value="1" data-amount="0">
                        <button class="AddToCart__button" id="addingElement-button" type="submit" <?php if($disabled){?> disabled <?php } ?>><?= $buttonText ?></button>
                </form>
            </div>

            <div class="section-main_info-details__size">
                <span class="name">SKU:</span>
                <span class="value">12</span>
            </div>

            <div class="section-main_info-details__category">
                <span class="name">Category:</span>
                <span class="value"><?= $item['category'] ?></span>
            </div>

        </div>
    </div>
</div>

<div class="section-main_info-mobile section-outer">
    <div class="section-inner">
        <div class="section-main_info-mobile__wrapper">
            <div class="owl-carousel owl-theme">
                <?php for($i=0; $i<4; $i++){ ?>
                <div class="section-main_info-mobile-item" >
                    <img src="<?= $item['image'] ?>" alt="product" class="section-main_info-mobile__image">
                </div>
                <?php } ?>
            </div>

            <div class="section-main_info-mobile__information">
                <div class="section-main_info-mobile__information-title"><?= $item['name'] ?></div>
                <div class="section-main_info-mobile__information-price">
                    $ <?= str_replace(',' ,'.', $item['price']) ?>
                </div>
                <div class="section-main_info-mobile__information-description">
                    <?= $item['description'] ?>
                </div>
                <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $item['id'] ?>&confirmed=1" class="AddToCart" method="post">
                    <input type="hidden" class="addingElementID" name="addingElementID" value="<?= $item['id']?>">
                    <input type="hidden" id="addingElementAmount-description-mobile" name="addingElementAmount" value="1" data-amount="1">
                    <button id="addingElement-button-mobile" type="submit" <?php if($disabled){?> disabled <?php } ?>><?= $buttonText ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="section-full_info section-outer">
    <div class="section-inner">
        <div class="section-full_info__wrapper">
            <div class="section-full_info__titles">
                <div class="section-full_info__titles-description">
                    <div class="title">
                        Description
                    </div>
                </div>
                <div class="section-full_info__titles-additional">
                    <div class="title">
                        Additional information
                    </div>
                </div>
                <div class="section-full_info__titles-reviews">
                    <div class="title">
                        Reviews(<?= $product->countReviews($item['id']); ?>)
                    </div>
                </div>
                <div class="title_border"></div>
            </div>
        </div>
        <div class="section-full_info__content">
            <div class="section-full_info__content-description">
                <?= $item['description'] ?>
            </div>

            <ul class="section-full_info__content-additional">
                <li class="item">
                    <span class="item__name">Weight:</span>
                    <span class="item__value"><?= $item['weight'] ?> g</span>
                </li>
                <li class="item">
                    <span class="item__name">Dimensions:</span>
                    <span class="item__value"><?= $item['dimensions'] ?></span>
                </li>
                <li class="item">
                    <span class="item__name">Colours:</span>
                    <span class="item__value"><?= $item['colour'] ?></span>
                </li>
                <li class="item">
                    <span class="item__name">Material:</span>
                    <span class="item__value"><?= $item['material'] ?></span>
                </li>
            </ul>
            <div class="section-full_info__content-reviews">
                <div class="reviews">
                    <div class="reviews__title">
                        <?= $product->countReviews($item['id']); ?> Reviews for lira earings
                    </div>

                    <?php
                    $item_reviews = $product->getReviews($item["id"]);
                    foreach ($item_reviews as $review){
                    ?>
                    <div class="reviews__item">
                        <div class="reviews__item-heading">
                                    <span class="reviews__item-heading__title">
                                        <?= $review["username"]?></span>
                        </div>

                        <div class="reviews__item-raiting">
                            <?php for($i=0; $i<5; $i++){
                                    if ($i < intval($review['raiting'])){?>
                                        <i class="fa fa-star"></i>
                                    <?php }
                                    else {?>
                                        <i class="fa-regular fa-star"></i>
                                    <?php }
                            }?>
                        </div>

                        <div class="reviews__item-text">
                            <?= $review['reviewText'] ?>
                        </div>
                    </div>
                        <?php }?>

                </div>

                <div class="AddReview">
                    <div class="AddReview__title">
                        Add a Review
                    </div>

                    <div class="AddReview__notification">
                        Your email address will not be published. Required fields are marked *
                    </div>

                    <form action="method__addReview.php" method="post" name="review_form" class="AddReview__form">
                        <label for="review-text">Your Review*</label>
                        <input type="text" class="text-input mandatory" id="review-text" name = "text">
                        <div class="error error_text"></div>
                        <input type="text" class="name-input mandatory" placeholder="Enter your name*" name="name">
                        <div class="error error_name"></div>
                        <input type="email" class="email-input mandatory" placeholder="Enter your Email*" name="email">
                        <div class="error error_email"></div>
                        <div class = "raiting-title">Your Raiting*
                        </div>
                        <div class="AddReview__form-raiting">
                            <input type="hidden" id="raiting_value" class="rating mandatory" value="" name="rating_value">
                            <i class="fa-regular fa-star review" data-index = "1"></i>
                            <i class="fa-regular fa-star review" data-index = "2"></i>
                            <i class="fa-regular fa-star review" data-index = "3"></i>
                            <i class="fa-regular fa-star review" data-index = "4"></i>
                            <i class="fa-regular fa-star review" data-index = "5"></i>
                        </div>
                        <div class="error error_rating"></div>
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="AddReview__form-submit">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="section-full_info-mobile section-outer">
    <div class="section-inner">
            <div class="section-full_info-mobile__description">
                    <div class="title description_title">
                        Description
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="content">
                        <?= $item['description'] ?>
                    </div>
            </div>
            <div class="section-full_info-mobile__additional">
                    <div class="title description_title">
                        Additional information
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="content">
                        <ul>
                            <li class="item">
                                <span class="item__name">Weight:</span>
                                <span class="item__value"><?= $item['weight'] ?> g</span>
                            </li>
                            <li class="item">
                                <span class="item__name">Dimensions:</span>
                                <span class="item__value"><?= $item['dimensions'] ?></span>
                            </li>
                            <li class="item">
                                <span class="item__name">Colours:</span>
                                <span class="item__value"><?= $item['colour'] ?></span>
                            </li>
                            <li class="item">
                                <span class="item__name">Material:</span>
                                <span class="item__value"><?= $item['material'] ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            <div class="section-full_info__content-reviews">
                <div class="title description_title">
                    Reviews (<?= $product->countReviews($item['id']); ?>)
                    <i class="fa-solid fa-angle-down"></i>
                </div>

                <div class="content">
                    <div class="reviews">

                        <?php
                        $item_reviews = $product->getReviews($item["id"]);
                        foreach ($item_reviews as $review){
                            ?>
                            <div class="reviews__item">
                                <div class="reviews__item-heading">
                                    <span class="reviews__item-heading__title">
                                        <?= $review["username"]?></span>
                                </div>

                                <div class="reviews__item-raiting">
                                    <?php for($i=0; $i<5; $i++){
                                        if ($i < intval($review['raiting'])){?>
                                            <i class="fa fa-star"></i>
                                        <?php }
                                        else {?>
                                            <i class="fa-regular fa-star"></i>
                                        <?php }
                                    }?>
                                </div>

                                <div class="reviews__item-text">
                                    <?= $review['reviewText'] ?>
                                </div>
                            </div>
                        <?php }?>

                    </div>
                </div>
        </div>
    </div>
</div>

<div class="section-similar_items section-outer">
    <div class="section-inner">
        <h2>Similar Items</h2>

        <div class="section-catalog">
            <div class="items">
            <?php
            $i =0;
            foreach($products_shuffle as $item){
             $i++;
             if($i == 4){
                 break;
             }
                ?>
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
        </div>
    </div>
</div>

<div class="section-similar_items-mobile section-outer">
    <div class="section-inner">
        <h2>Similar Items</h2>

            <div class="owl-carousel owl-theme items">
                <?php
                $i =0;
                foreach($products_shuffle as $item){
                    $i++;
                    if($i == 4){
                        break;
                    }
                    ?>
                    <div class="wrapper carousel-item" >
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
        </div>
    </div>
</div>

<?php
include("_footer.php");
?>
<script src="../javascript_additional/product_description.js"></script>
</body>
</html>
