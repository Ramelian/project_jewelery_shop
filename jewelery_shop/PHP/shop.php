<?php
    include ("_header.php");
    shuffle($products_shuffle);
?>

<section class="section-outer section-filter">
    <div class="section-inner">
        <div class="section-filter__bar">
            <h1>Shop The Latest</h1>
            <div class="section-filter__bar-search">
                <input type="search" id="live_search" autocomplete="off" placeholder="Search...">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <div class="section-filter__bar-sorting">
                <div id="SortBy" class="select-box">
                    <div class="options-container">
                        <div class="option sortBy">
                            <input type="radio" class="radio" id="raiting" name="category"/>
                            <label for="raiting">
                                Raiting</label>
                        </div>

                        <div class="option sortBy">
                            <input type="radio" class="radio" id="price ASC" name="category"/>
                            <label for="price ASC">
                                from Lower to Higher</label>
                        </div>

                        <div class="option sortBy">
                            <input type="radio" class="radio" id="price DESC" name="category"/>
                            <label for="price DESC">
                                from Higher to Lower</label>
                        </div>

                    </div>

                    <div class="selected">
                        Sort By
                    </div>
                </div>

                <div id="ShopBy" class="select-box">
                    <div class="options-container options-shopBy">
                        <div class="option shopBy">
                            <input type="radio" class="radio" id="necklace" name="category"/>
                            <label for="necklace">
                                Necklaces</label>
                        </div>

                        <div class="option shopBy">
                            <input type="radio" class="radio" id="earrings" name="category"/>
                            <label for="earrings">
                                Earrings</label>
                        </div>

                        <div class="option shopBy">
                            <input type="radio" class="radio" id="set" name="category"/>
                            <label for="set">
                                Set</label>
                        </div>
                    </div>

                    <div class="selected">
                        Shop By
                    </div>
                </div>
            </div>

            <div class="section-filter__bar-price_range">
                <div id="slider">
                </div>

                <div class="price">
                    Price: $<span id="price-min">40</span> - $<span id="price-max">180</span>
                </div>

            </div>
        </div>

        <div class="section-catalog section-filter__catalog">
            <!-- Catalog with items -->
            <div id="search_result" class="items">
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
    </div>
</section>

<?php
    include("_footer.php");
?>
<script src="../javascript_additional/shop.js"></script>
</body>
</html>
