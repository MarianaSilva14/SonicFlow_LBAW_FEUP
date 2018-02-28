var $star_rating = $('.star-rating .fas');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).addClass('star-golden');
    } else {
      return $(this).removeClass('star-golden');
    }
  });
};

$star_rating.on('mousedown', function() {
  console.log("mousedown");
  // THIS IS NOT WORKING, MOUSELEAVE IS THO
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

$(".star-rating").on('mouseleave', function(){
  //console.log("mouseleave");
  $star_rating.each(function(){
    $(this).removeClass('star-golden');
  });
});

SetRatingStar();
// $(document).ready(function() {
//
// });
