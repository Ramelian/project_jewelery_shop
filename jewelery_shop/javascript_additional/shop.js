// === Sorting Buttons ===

const ShopBy = document.getElementById("ShopBy");
const SortBy = document.getElementById("SortBy");
const sorting = [ShopBy, SortBy];

sorting.forEach((item) => {
const selected = item.querySelector(".selected");
const optionsContainer = item.querySelector(".options-container");

const optionsList = item.querySelectorAll(".option");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
  });
});
})

// !=== Sorting Buttons ===

// === Price range slider ===

const priceRange = document.getElementById('slider');

if(priceRange){
  noUiSlider.create(priceRange, {
    start: [0, 30],
    connect: true,
    step: 1,
    range: {
        'min': 0,
        'max': 30
    }
});

const priceMin = document.getElementById("price-min");
console.log(priceMin);
const priceMax = document.getElementById("price-max");
prices = [priceMin, priceMax];

priceRange.noUiSlider.on('update', (values, handle) => {
  prices[handle].textContent = Math.round(values[handle]);
 });
}

// !=== Price range slider ===

// === AJAX live search

let options_sortBy = $(".option.sortBy");
let options_shopBy = $(".option.shopBy");
var input = undefined
var sortByFilter = undefined;
var shopByFilter = undefined;

$("#live_search").keyup(function() {
  let input = $(this).val();
  $.ajax({

    url: "method__livesearch.php",
    method: "POST",
    data: {
           search_input: input,
           sortBy: sortByFilter,
           shopBy: shopByFilter,
           valueMin: $value_min,
           valueMax: $value_max
    },

    success: function (data) {
      if($.isEmptyObject(data)){
        $("#search_result").html("<h2 style='margin: 50px auto'> No Items Have Found");
      }
      else {
        $("#search_result").html(data);
      }
    },
  });

})

options_sortBy.map(function(id, element){
  element.onclick = function(){
    sortByFilter_input = $(this).find("input")[0];
    sortByFilter = sortByFilter_input.getAttribute("id");

      $.ajax({
        url: "method__livesearch.php",
        type: "POST",
        data: {
          search_input: input,
          sortBy: sortByFilter,
          shopBy: shopByFilter,
          valueMin: $value_min,
          valueMax: $value_max
        },
        success: function (data) {
          $("#search_result").html(data)
        }
      })

    }
  })

options_shopBy.map(function(id, element){
  element.onclick = function(){
    shopByFilter_input = $(this).find("input")[0];
    shopByFilter = shopByFilter_input.getAttribute("id");

      $.ajax({
        url: "method__livesearch.php",
        type: "POST",
        data: {
          search_input: input,
          sortBy: sortByFilter,
          shopBy: shopByFilter,
          valueMin: $value_min,
          valueMax: $value_max
        },
        success: function (data) {
          $("#search_result").html(data)
        }
      })
    }
})

priceRange.noUiSlider.on('update', function(values){
  $value_min = values[0];
  $value_max = values[1];


  $.ajax({
    url: "method__livesearch.php",
    type: "POST",
    data: {
      search_input: input,
      sortBy: sortByFilter,
      shopBy: shopByFilter,
      valueMin: $value_min,
      valueMax: $value_max
    },
    success: function (data) {
      $("#search_result").html(data)
    }
  })
});
// !=== AJAX live search

