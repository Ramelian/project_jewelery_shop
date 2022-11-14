// === Title/content selector === //
let reviews = null;

// ---Parent of titles---
const parent_title = document.querySelector('.section-myAccount__titles');
//left length from viewport
const parent_title__left = parent_title.getBoundingClientRect().left;

// ---Children---

// Border For title
const dashboard = document.querySelector('.section-myAccount__titles-dashboard');
const orders = document.querySelector('.section-myAccount__titles-orders');
const addresses = document.querySelector('.section-myAccount__titles-addresses');
const account_details = document.querySelector('.section-myAccount__titles-account_details');
const titles = [dashboard, orders, addresses, account_details];


// Dislay blocks content
const content_dashboard = document.querySelector('.section-myAccount__content-dashboard');
const content_orders = document.querySelector('.section-myAccount__content-orders');
const content_addresses = document.querySelector('.section-myAccount__content-addresses');
const content_account_details = document.querySelector('.section-myAccount__content-account_details');
const content = [content_dashboard, content_orders, content_addresses, content_account_details];

const recent_orders = document.querySelector(".section-myAccount__content-dashboard__recent-orders");
const shipping_addresses = document.querySelector(".section-myAccount__content-dashboard__address");
const password = document.querySelector(".section-myAccount__content-dashboard__password");

dashboard__links_titles = [recent_orders, shipping_addresses, password];

dashboard__links_content = [content_orders, content_addresses,content_account_details]

show_content(titles, content, parent_title__left);

//if window resized
window.addEventListener('resize', function() {
    const parent_title__left = parent_title.getBoundingClientRect().left;
    show_content(titles, content, parent_title__left, true);
}, true);

// go to another blocks from the Dashboard
dashboard__links_titles.forEach((item, index) =>{
    
    item.onclick = function(){
        dashboard.style.color = "#707070";
        content_dashboard.style.display = "none";

        dashboard__links_content[index].style.display = "block";
        titles[index+1].style.color = "#000";
        const timeout = setTimeout(add_opacity, 0);
            function add_opacity(){
                dashboard__links_content[index].style.opacity = "1";
            }
        // Title`s border_bottom
        const title_border = document.querySelector(".title_border");

        // Measuring item's distance from the left
        rect_left = (titles[index+1].getBoundingClientRect().left - parent_title__left).toString() + "px";
        // Measuring item's distance width
        rect_width = (titles[index+1].getBoundingClientRect().width).toString() + "px";
        // Adding border bottom according to previous measures
        title_border.style.left = rect_left;
        title_border.style.width = rect_width;

    }
})

    // Mobile Version
    const dashboard_mobile = document.querySelector('.section-myAccount__titles-mobile-dashboard');
    const orders_mobile = document.querySelector('.section-myAccount__titles-mobile-orders');
    const addresses_mobile = document.querySelector('.section-myAccount__titles-mobile-addresses');
    const account_details_mobile = document.querySelector('.section-myAccount__titles-mobile-account_details');
    const titles_mobile = [dashboard_mobile, orders_mobile, addresses_mobile, account_details_mobile];

    titles_mobile.forEach(function (item, index) {
        item.onclick = function () {
            content.forEach((item, index) => {
                item.style.display = "none";
                item.style.opacity = "0";
                titles_mobile[index].querySelector(".title").style.color = "#707070";
            });
            item.querySelector(".title").style.color = "#000";
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
        }
        
    });
    // !Mobile Version
// !go to another blocks from the Dashboard

// ADD shipping address
shipping_addresses__hide = document.querySelectorAll(".addresses-list__hide");
addresses_list__add = document.querySelector(".addresses-list__add");

shipping_addresses__hide.forEach(function(item){
    addresses_list__add.addEventListener("click", ()=>{
        item.style.display = "none";
        document.querySelector(".addresses-add").style.display = "block";
        const timeout = setTimeout(add_opacity, 0);

              function add_opacity(){
                document.querySelector(".addresses-add").style.opacity = "1";
              }
    })
})
// !ADD shipping address

// Logout (unset Session[customer])

$('.section-myAccount__dashboard-logout').click(() => {logout()})

$('.section-myAccount__titles-logout').click(() => {logout();});

// !Logout (unset Session[customer])

// Validating account details
const accountDetailsForm = document.querySelector(".details__form");
function validateFormAccountDetails(){
    let submit = true;

    document.querySelectorAll(".error").forEach(function(e){
        e.textContent = "";
    });

    if(!validateName(document.forms["myAccount-details__form"]["first_name"]))
        submit = false;

    if(!validateName(document.forms["myAccount-details__form"]["last_name"]))
        submit = false;

    if(document.forms["myAccount-details__form"]["display_name"].value.length !==0){
        if(!validateName(document.forms["myAccount-details__form"]["display_name"]))
            submit = false;
    }

    if(!validateEmail(document.forms["myAccount-details__form"]["email"]))
        submit = false;

    if(document.forms["myAccount-details__form"]["new_password"].value.length !== 0){
        if(!validatePassword(document.forms["myAccount-details__form"]["new_password"]))
            submit = false;

        if(!validateNewPassword(document.forms["myAccount-details__form"]['new_password'], document.forms['myAccount-details__form']['new_password-confirm']))
            submit = false;        
    }

    if(!validateIfEmpty(accountDetailsForm))
        submit = false;    

    if(submit) return true;
    else return false;
};
//!Validating account details


// $(".details__form-button").click(() => {
// validateFormAccountDetails();});

//Update customer information

$(".details__form-button").click(() => {
    if(validateFormAccountDetails()){
        $(document).ready(function(){
        var data = {
            first_name: document.forms["myAccount-details__form"]["first_name"].value,
            last_name: document.forms["myAccount-details__form"]["last_name"].value,
            display_name: document.forms["myAccount-details__form"]["display_name"].value,
            email: document.forms["myAccount-details__form"]["email"].value,
            currentPassword: document.forms["myAccount-details__form"]["current_password"].value,
            newPassword: document.forms["myAccount-details__form"]["new_password"].value,
            action: "updateAccount",
        };

        $.ajax({
            url: 'method__updateInfo.php',
            type: 'post',
            data: data,
            success:function(response){
            
            window.location.reload();
            }
        });
        });
    }
  });

// !Update customer information

// Validating address
myAddressForm = document.querySelector(".addresses-add");
function validateMyAddressForm(){
    let submit = true;

    document.querySelectorAll(".error").forEach(function(e){
        e.textContent = "";
    });
    

    if(!validateIfEmpty(myAddressForm))
        submit = false;    

    if(submit) return true;
    else return false;
};

$(".addresses__form-button").click((e) => {
    e.preventDefault();
    if(validateMyAddressForm()){
        myAddressForm.submit();
    }
});
// !Validating address

// === Banner carousel ===
$(document).ready(function(){
    $(".section-myAccount__titles-mobile.owl-carousel").owlCarousel({
        items: 3,
        nav: false,
        dots: false,
        autoWidth: true,
    });
  });
  
// !=== Banner carousel ===