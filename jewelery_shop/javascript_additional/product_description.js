// === Grid Choose image ===

const grid_area = document.querySelector(".section-main_info-grid");

grid_area.addEventListener("click", function(e){
    current_image_source = e.path[0].currentSrc;
    current_image_class = e.path[1].getAttribute('class');
    big_img = this.querySelector(".big_image");

    if(current_image_source){
        if(!(e.path[1].getAttribute('class') == 'section-main_info-grid-big')){
            big_img.setAttribute("src", current_image_source);
        }
    }
});

let clickedImages = document.querySelectorAll(".grid-small_hover");
let big_image = document.querySelector(".section-main_info-grid-big");

[...clickedImages].forEach((clickedImage) => {
    clickedImage.addEventListener('click', (e) => {
        let distance = e.target.dataset.distance + "%";
        big_image.style.setProperty('--afterDistance', distance);
    })
});
// === !Grid Choose image ===

// === Menu description/additional/reviews
let dashboard = null;
// ---Parent of titles---
const parent_title = document.querySelector('.section-full_info__titles');
//left length from viewport
parent_title__left = Math.round(parent_title.getBoundingClientRect().left) 

// ---Children---

// Border For title
const description = document.querySelector('.section-full_info__titles-description');
const additional = document.querySelector('.section-full_info__titles-additional');
const reviews = document.querySelector('.section-full_info__titles-reviews');
const titles = [description, additional, reviews];

// Dislay blocks content
const content_description = document.querySelector('.section-full_info__content-description');
const content_additional = document.querySelector('.section-full_info__content-additional');
const content_reviews = document.querySelector('.section-full_info__content-reviews');
const content = [content_description, content_additional, content_reviews];

show_content(titles, content, parent_title__left);

// if window is resized 
window.addEventListener('resize', function() {
    const parent_title__left = parent_title.getBoundingClientRect().left;
    show_content(titles, content, parent_title__left);
}, true);
// === !Menu description/additional/reviews

// Review
$(document).ready(function(){
    let ratedIndex = -1;

    $('.fa-regular.fa-star.review').on('click', function () {
        ratedIndex = parseInt($(this).data('index'));
        removeStars();
        setStars(ratedIndex);
        $("#raiting_value").val(ratedIndex);
    });

    $('.fa-regular.fa-star.review').mouseover(function () {
        let currentIndex = parseInt($(this).data('index'));
        setStars(currentIndex);
    });

    $('.fa-regular.fa-star.review').mouseleave(function () {
        removeStars();

        if (ratedIndex !== -1)
            setStars(ratedIndex);
    });

    function removeStars() {
        $(".fa.fa-star.review").each(function() {
                $(this).removeClass("fa");
                $(this).addClass("fa-regular");
        })
    }

    function setStars(max) {
        $(".fa-star.review").each(function( index ) {
                if(index<max) {
                    $(this).removeClass("fa-regular");
                    $(this).addClass("fa");
                }
        });

    }
})
// !Review

// Review form validation
const form = document.querySelector(".AddReview__form")

form.addEventListener('submit', (e) => {
    let submit = true;

    document.querySelectorAll(".error").forEach(function(e){
        e.textContent = "";
    })

    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["review_form"]["email"].value))){
        document.forms["review_form"]["email"].nextElementSibling.textContent = "Incorrect input. Enter valid email";
        submit = false;
    }

    if(!(/^[A-Za-z0-9]*$/.test(document.forms["review_form"]["text"].value))){
        document.forms["review_form"]["text"].nextElementSibling.textContent = "Incorrect input. Use only letters and numbers";
        submit = false;
    }
    
    if(!(/^[a-zA-Z]+$/.test(document.forms["review_form"]["name"].value))){
        document.forms["review_form"]["name"].nextElementSibling.textContent = "Incorrect input. Use only letters";
        submit = false;
    }

    document.querySelectorAll(".mandatory").forEach(function (element) {
        if ((element.value === "") || (element.value == null))   {
            e.preventDefault();
            let element_error = element.nextElementSibling;
            if(element_error.tagName === "I") {
                document.querySelector(".error_rating").textContent ="This field cannot be empty";
            }
            else{
                element_error.textContent = "This field cannot be empty";
            }
        }

        if(submit == false){
            e.preventDefault();
        }
    });
});

// !Review form validation

// Give current value and data-amount before submiting

$('#addingElement-button').click(() => {
    let current_value = $('#input_value-description').val();
    $('#addingElementAmount-description').val(current_value);
});



// !Give current value and data-amount before submiting

// === Main info images for mobile versions ===
$(document).ready(function(){
    $(".section-main_info-mobile .owl-carousel").owlCarousel({
        items: 1,
        dots: false
    });

    const owl = $(".section-main_info-mobile .owl-carousel");

    owl.on('changed.owl.carousel', function(event){
        const mobile_item = document.querySelector(".section-main_info-mobile");
        item_index = event['item']['index'];
        distance = (25 *item_index) + "%";
        mobile_item.style.setProperty('--afterDistance', distance);
    });
  });
  
// !=== Main info images for mobile versions ===

// Mobile version product description hide/open tabs
$(".description_title").click((event) => {
    $(event.target).next().toggle("active");
});
// !Mobile version product description hide/open tabs

// === Similar items carousel ===
$(document).ready(function(){
    $(".owl-carousel.owl-theme.items").owlCarousel({
        items: 1,
        autoWidth: true,
        margin: 10,
        nav: false,
        dots: false
    });
  });
  
// !=== Similar items carousel ===

