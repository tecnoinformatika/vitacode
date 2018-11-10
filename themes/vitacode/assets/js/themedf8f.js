$(document).ready(function() {  

  // Mobile Slideout Navigation  
  $.shifter({
    maxWidth: "740px"
  });    

  // Quantity values
  $('.up').click(function(e){
    e.preventDefault();
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($('input[name='+fieldName+']').val());
    // If is not undefined
    if (!isNaN(currentVal)) {
      // Increment
      $('input[name='+fieldName+']').val(currentVal + 1);
    } else {
      // Otherwise put a 0 there
      $('input[name='+fieldName+']').val(1);
    }
  });
  $(".downer").click(function(e) {
    e.preventDefault();
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($('input[name='+fieldName+']').val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > 1) {
      // Decrement one
      $('input[name='+fieldName+']').val(currentVal - 1);
    } else {
      // Otherwise put a 0 there
      $('input[name='+fieldName+']').val(1);
    }
  }); 

  if ( $(this).width() > 740 ) {
    $('.product-index-inner').hover(function(){ $(this).children('.product-modal').show(); }, function(){ $(this).children('.product-modal').hide(); })
    // Flipping Images
    $('.product-index-inner').each(function(){
      if($(this).find('img').length > 1) {
        $(this).find('.img2').hide().css('display', 'none');
        $(this).hover(function(){
          $(this).find('.img2').stop(true,true).fadeIn("3000");
          $(this).find('.img1').stop(true,true).fadeOut("3000").css("display", "none");
        }, function(){
          $(this).find('.img2').stop(true,true).fadeOut("3000").css("display", "none");
          $(this).find('.img1').stop(true,true).fadeIn("3000");
        });
      }
    });  
  }

  // Help old browsers with placeholders for inputs 
  $('input, textarea').placeholder();


  // Call Flexslider globally
  $('.flexslider').flexslider({
    animation: "fade",
    controlNav: false,
    slideshowSpeed: 7000,
    directionNav: true
  });  


  // Custom select dropdowns  
  $('.styled-select').selecter();  
  $('.coll-picker').selecter();  
  $('.coll-filter').selecter();  
  

  // Call Fancybox for product modal + stop scroll to top 
  $('.product-modal').fancybox({
    helpers: {
      overlay: {
        locked: false
      }
    }
  });


  // Call Fancybox globally on all elements with class fancybox
  $(".fancybox").fancybox({
    helpers: {
      overlay: {
        locked: false
      }
    }
  });  

});

