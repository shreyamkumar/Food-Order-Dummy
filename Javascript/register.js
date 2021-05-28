$(".tab a").on("click", function (e) {
  e.preventDefault();
  
  $(this).parent().addClass("active");
  $(this).parent().siblings().removeClass("active");
  
  target = $(this).attr("href");
  
  $(".tab-content > div").not(target).hide();
  
  $(target).fadeIn(600);
});

// var getActives = function() {
  
//   var selectedRadioValue = $('#radio-switch input:checked').val();
  
// };

// $('#radio-switch input').change(getActives);

function customerTab(){
  
  $("#cus").addClass("active");
  $("#res").removeClass("active");
  target = "#customer";
  console.log("hello")
  $(".tab-content > div").not(target).hide();
  
  $(target).fadeIn(600);
  
}
function restaurantTab(){
  
  $("#res").addClass("active");
  $("#cus").removeClass("active");
  target = "#restaurant";
  
  $(".tab-content > div").not(target).hide();
  
  $(target).fadeIn(600);
  
}