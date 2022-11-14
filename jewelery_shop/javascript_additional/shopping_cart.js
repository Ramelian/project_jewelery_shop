$('.section-cart__total-button').click(()=>{
    if(!($("#session-cart_ifEmpty").length > 0))
        window.location.href = "checkout.php";
});