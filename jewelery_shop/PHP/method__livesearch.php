<?php
session_start();
include("functions.php");

function where_add($str, $adding_array, $adding_array_additional = null) {
    // Split the string, find WHERE statement, add info after it, make string from array
    // if you click on rating - JOIN clause before WHERE clause and ORDER/GROUP clause after WHERE
    $splited = explode(" ", $str);
    $element_position = array_search("product", $splited);
    $element_join_position = array_search("product.id=review.product_id", $adding_array);

    if((!isset($splited[$element_position+1])) or ($splited[$element_position+1] != "WHERE")){
            array_unshift($adding_array, "WHERE");
            array_pop($adding_array);
            array_splice($splited, $element_position + 2, 0, $adding_array);
            $ready_string = implode(" ", $splited);
    }
    else {
        if($element_join_position){
            array_splice($splited, $element_position + 1, 0, $adding_array);
            $final_splited = array_merge($splited, $adding_array_additional);
            $ready_string = implode(" ", $final_splited);
            }
        else{
            array_splice($splited, $element_position + 2, 0, $adding_array);
            $ready_string = implode(" ", $splited);
        }
    }
    return $ready_string;
};

    $query = "SELECT product.* FROM product";

if(isset($_POST['search_input'])){
    $input = $_POST['search_input'];
    $query = where_add($query, ["name", "LIKE", "'%{$input}%'", "AND"]);
}

if(isset($_POST['shopBy'])){
    $input = $_POST['shopBy'];
    $query = where_add($query, ["category=", "'{$input}'", "AND"]);
}

if(isset($_POST['valueMin']) and isset($_POST['valueMax'])){
    $input_min = $_POST['valueMin'];
    $input_max = $_POST['valueMax'];
    $query = where_add($query, ["price" , "BETWEEN", $input_min, "AND", $input_max, "AND"]);
}

if(isset($_POST['sortBy'])){
    $input = $_POST['sortBy'];
    if($input == "raiting"){
        $query_str1 = explode(" " ,"LEFT JOIN review on product.id=review.product_id");
        $query_str2 = explode(" ", "GROUP BY product.id ORDER BY AVG(review.raiting) DESC");
        $query= where_add($query, $query_str1, $query_str2);
    }
    else {
        $query .= " ORDER BY {$input}";
    }
}



$result = $product->getVariousData($query);
foreach($result as $item){ ?>
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