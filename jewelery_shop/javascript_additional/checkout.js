// Change payment method
$('.payment_method-cash').click(() => {
    $('.payment_method-value').val('cash');
});

$('.payment_method-cart').click(() =>{
    $('.payment_method-value').val('cart');
});
// !Change payment method

// Validation
function validateFormRegister(){
    let submit = true;
    const order_add_form = document.querySelector(".order_add-form");

    document.querySelectorAll(".error").forEach(function(e){
        e.textContent = "";
    }) 

    if(!validateEmail(document.forms["order_add-form"]["email"]))
        submit = false;

    if(!validateName(document.forms["order_add-form"]["first_name"]))
        submit = false;

    if(!validateName(document.forms["order_add-form"]["last_name"]))
        submit = false;

    if(!validatePhone(document.forms["order_add-form"]["phone"]))
        submit = false;

    if(!validateIfEmpty(order_add_form))
        submit = false;

    if(submit) return true;
    else return false;
};

$(".add_order-button").click(() => {
    if(validateFormRegister()){
        $(".order_add-form").submit();

        // $(document).ready(function(){
        // var data = {
        //     first_name: document.forms["order_add-form"]["first_name"].value,
        //     last_name: document.forms["order_add-form"]["last_name"].value,
        //     company_name: document.forms["order_add-form"]["company_name"].value,
        //     country: document.forms["order_add-form"]["country"].value,
        //     street: document.forms["order_add-form"]["street"].value,
        //     postcode: document.forms["order_add-form"]["postcode"].value,
        //     city: document.forms["order_add-form"]["city"].value,
        //     phone: document.forms["order_add-form"]["phone"].value,
        //     order_notes: document.forms["order_add-form"]["order_notes"].value,
        //     payment: document.forms["order_add-form"]["payment"].value,
        //     email: document.forms["order_add-form"]["email"].value,
        //     action: "addOrder"
        // };

        // $.ajax({
        //     url: 'method__updateInfo.php',
        //     type: 'post',
        //     data: data,
        //     success:function(response){
        //     alert(response);
        //     // window.location.reload();
        //     }
        // });
        // });
    }
  });
// !Validation
