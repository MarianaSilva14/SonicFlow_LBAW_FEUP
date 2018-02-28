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

var SetRatingStar2 = function(x) {
  return x.each(function() {
    if (parseInt(x.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).addClass('star-golden');
    } else {
      return $(this).removeClass('star-golden');
    }
  });
};

// console.log($star_rating);

// $star_rating.on('mouseover', function() {
//   console.log("mouseover");
//   // THIS IS NOT WORKING, MOUSELEAVE IS THO
//   $star_rating.siblings('input.rating-value').val($(this).data('rating'));
//   return SetRatingStar();
// });
//
// $(".star-rating").on('mouseleave', function(){
//   console.log("mouseleave");
//   $star_rating.each(function(){
//     $(this).removeClass('star-golden');
//   });
// });

SetRatingStar();
$(document).ready(function() {
  var $svgs = $('.star-rating svg');
  console.log($svgs);

  $svgs.on('mouseover', function() {
    console.log("mouseover");
    // THIS IS NOT WORKING, MOUSELEAVE IS THO
    $svgs.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar2($svgs);
  });

  $(".star-rating").on('mouseleave', function(){
    console.log("mouseleave");
    $svgs.each(function(){
      //console.log($(this));
      $(this)[0].firstChild.fill='black';
      //$(this).removeClass('star-golden');
    });
  });
});
