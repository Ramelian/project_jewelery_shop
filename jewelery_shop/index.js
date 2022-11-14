window.onload = () => {
    const header = document.querySelector("header");
    const shop = document.getElementById("nav-shop");

    if (window.location.pathname == "/Jewelery_shop/PHP/shop.php") {
        header.setAttribute('id', 'header_with_border');
        shop.classList.add("active");
    }

    else if (window.location.pathname == "/Jewelery_shop/PHP/index.php") {
        header.removeAttribute('id');
        shop.classList.remove("active");
    }
    else{
        header.setAttribute('id', 'header_with_border');
        shop.classList.remove("active");
    }
}

// Show content of active title
    function show_content(titles, content, parent_title__left, setting = false) {
        // Title`s border_bottom
        const title_border = document.querySelector(".title_border");

        //Setting default border bottom and title text color
        if (setting != true) {
            title_border.style.width = titles[0].getBoundingClientRect().width + "px";
            titles[0].style.color = "#000";
        }


        titles.forEach(function (item, index) {

            item.onclick = function () {
                // Measuring item's distance from the left
                if (item == dashboard)
                    rect_left = "5px";
                else
                    rect_left = (item.getBoundingClientRect().left - parent_title__left).toString() + "px";
                // Measuring item's distance width
                rect_width = (item.getBoundingClientRect().width).toString() + "px";
                // Hide all titles' content
                content.forEach((item, index) => {
                    item.style.display = "none";
                    item.style.opacity = "0";
                    titles[index].style.color = "#707070";
                })
                //Adding black color to title
                item.style.color = "#000";
                //Show content of active title
                if (item != reviews) {
                    content[index].style.display = "block";
                    const timeout = setTimeout(add_opacity, 0);

                    function add_opacity() {
                        content[index].style.opacity = "1";
                    }
                } else {
                    content[index].style.display = "flex";
                    const timeout = setTimeout(add_opacity, 0);

                    function add_opacity() {
                        content[index].style.opacity = "1";
                    }
                }
                // Adding border bottom according to previous measures
                title_border.style.left = rect_left;
                title_border.style.width = rect_width;
            }
        })
    }

// !Show content of active title

// === Counter plus/minus ===

    function formatStrNumber(number) {
        replacedStr = number.toString().replace(".", ",");
        formattedNumber = `$ ${replacedStr}`;
        return formattedNumber;
    };

    const getItemSubtotalPrice = (input) => Number(input.value) * Number(input.dataset.price);

    const init = () => {
        [...document.querySelectorAll(".shoppingCartItems")].forEach((shoppingCartItem) => {
            let subtotal = shoppingCartItem.querySelector(".subtotal");

            if (subtotal) {
                let subtotalCost = 0;

                [...shoppingCartItem.querySelectorAll('.change_amount')].forEach((product_item) => {
                    subtotalCost += getItemSubtotalPrice(product_item.querySelector(".input_value"));
                });
                subtotal.textContent = formatStrNumber(subtotalCost);

                if (document.querySelectorAll(".items__amount")) {
                    [...document.querySelectorAll(".items__amount")].forEach((e) => {e.textContent =
                        [...shoppingCartItem.querySelectorAll(".change_amount")].length;
                });
             }

                if (shoppingCartItem.querySelector(".total-shoppingCart")) {
                    shippingPriceItem = shoppingCartItem.querySelector(".shippingPrice");
                    shippingPrice = shippingPriceItem.dataset.price;
                    let totalCost = Number(subtotalCost) + Number(shippingPrice);
                    shoppingCartItem.querySelector(".total-shoppingCart").textContent = formatStrNumber(totalCost);
                }
            }
        })
    };

    function calculateSeparateItem(product_item, action) {
        const input = product_item.querySelector(".input_value");

        switch (action) {
            case 'plus':
                if (input.value < 10){
                    input.value++;
                    input.dataset.amount++;
                }
                break;
            case 'minus':
                if (input.value > 0){
                    input.value--;
                    input.dataset.amount--;
                }
                break;
        }
        init();
    };

    [...document.querySelectorAll(".items")].forEach(element => element.addEventListener('click', (event) => {
            if (event.target.classList.contains('btn-minus')) {
                calculateSeparateItem(
                    event.target.closest('.change_amount'),
                    'minus'
                );
            } else if (event.target.classList.contains('btn-plus')) {
                calculateSeparateItem(
                    event.target.closest('.change_amount'),
                    'plus'
                );
            }
        })
    );

    init();

// === !Counter plus/minus ===

// Open/close shopping bag
    open_shopping_bag = document.querySelector(".fa-solid.fa-cart-shopping");
    shopping_bag = document.querySelector(".shopping-bag");

    open_shopping_bag.onclick = function () {
        shopping_bag.showModal();
    }

    shopping_bag.onclick = (e) => {
        if (e.target.nodeName == "DIALOG") {
            shopping_bag.setAttribute("closing", "");
            shopping_bag.addEventListener(
                "animationend",
                () => {
                    shopping_bag.removeAttribute("closing");
                    shopping_bag.close();
                }, {once: true});
        }
    }
// !Open/close shopping bag

// Check item's ids and amount -> update the session['cart]

$(".shopping-bag__footer-button").click(function(){
    $.ajax({
        url: "method__changeSession.php",
        type: "POST",
        async: false,
        cache: false,
        timeout: 30000,
        data: {
            action: "restore",
        }
    })
    

    $(".shopping-bag__items .item").each(function(){
        let id = parseInt($(this).find(".item_id").val());
        let amount = parseInt($(this).find(".input_value").val());

        $.ajax({
            url: "method__changeSession.php",
            type: "POST",
            async: false,
            cache: false,
            timeout: 30000,
            data: {
                action: "add",
                addingElementID: id,
                addingElementAmount: amount
            },
        });
    })    
    window.location.href = 'shopping_cart.php';
});


// !Check item's ids and amount -> update the session['cart]


//Delete item from cart
deleteShoppingCartItem = (item_id) =>{
    [...document.querySelectorAll(".section-cart__items .item")].forEach(e => {
        if(parseInt(e.querySelector(".item_id").value) == item_id)
            e.remove();
    });

    [...document.querySelectorAll(".shopping-bag__items .item")].forEach(e => {
        if(parseInt(e.querySelector(".item_id").value) == item_id)
            e.remove();
    });

    let check = document.querySelectorAll(".section-cart__items .item");
    if( check.length == 0)
        document.querySelector(".section-cart__items.items").innerHTML = '<h2 style="text-align: center;">Your cart is empty!</h2> <input type="hidden" id="session-cart_ifEmpty">';
}

$(".item-cross").click((e) => {
    let item =$(e.target).closest(".item");
    let item_id = item.find(".item_id").val();
    
    $.ajax({
        url: "method__changeSession.php",
        type: "POST",
        data: {
            action: "deleteItem",
            deleteItemId: item_id
        }
    })

    deleteShoppingCartItem(item_id);
    item.remove();
    init();
    
});

//!Delete item from cart

// Login if you are not or redirect to account
$(".user-icon").click(() => {
    window.location.href = "myaccount.php";
});
// !Login if you are not or redirect to account

// Validation functions

function validateEmail(email){
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))){
        email.nextElementSibling.textContent = "Incorrect input. Enter valid email";
        return false;
    }
    else return true;
}

function validatePhone(phone){
    if (!(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(phone.value))){
        phone.nextElementSibling.textContent = "Incorrect input. Enter valid phone";
        return false;
    }
    else return true;
}

function validateAddress(address){
    if (!(/\w+(\s\w+){2,}/.test(address.value))){
        address.nextElementSibling.textContent = "Incorrect input. Enter valid address (use only letters and numbers";
        return false;
    }
    else return true;
}

function validatePassword(password){
    if(!/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(password.value)){
        password.nextElementSibling.textContent = "Password must be 6 to 16 valid characters, has at least a number, and at least a special character";
        return false;
    }
    else return true;
}

function validateName(name){
    if(!(/^[a-zA-Z]+$/.test(name.value))){
        name.nextElementSibling.textContent = "Incorrect input. Use only letters";
        return false;
    }
    else return true;
}   

function validateIfEmpty(form){
    let condition = true;
    form.querySelectorAll(".mandatory").forEach(function (element) {
        if ((element.value === "") || (element.value == null))   {
            let element_error = element.nextElementSibling;
            if(element_error.tagName === "I") {
                document.querySelector(".error_rating").textContent ="This field cannot be empty";
            }
            else{
                element_error.textContent = "This field cannot be empty";
            }
            condition = false;
        }
    });
    return condition;
}

function validateNewPassword(newPassword, newPasswordConfirm){
    if(!(newPassword.value === newPasswordConfirm.value)){
        newPasswordConfirm.nextElementSibling.textContent = "Passwords don't match";
        return false;
    }
    else return true;
};

// !Validation functions

// Logout (unset Session[customer])

logout = () => {
    $.ajax({
        url: 'method__login-register.php',
        type: 'post',
        data:{
            action: 'logout'
        },
        success: function(){
            window.location.href = "login_register.php"
        }
    });
}

$("#popup-logout").click(() => {
    logout();
});
// Logout (unset Session[customer])

// Open popup menu mobile
$("#burger").click(() => {
    $("#burger").toggleClass("active");
    $("#popup").toggleClass("active");
    $("body").toggleClass("noscroll");
});
// !Open popup menu

// Open shopping bag mobile
$("#shopping-cart__mobile").click(() => {
    $(".shopping-bag").addClass("active");
    $("body").addClass("noscroll");
});

$("#shopping-bag__back").click(() => {
    $(".shopping-bag").removeClass("active");
    $("body").removeClass("noscroll");
});
// Open shopping bag mobile