function xZoomGallery() {
    $(".xzoom").xzoom({tint: '#333', Xoffset: 15});
    $('#bxslider').bxSlider({
        minSlides: 1,
        slideWidth:90,
        controls: false
    });
}
$(document).ready(function() {
    var msgJsJson = $('#msg_js').text();
    var msgJs = JSON.parse(msgJsJson);
    /**
     * Product detail
     */
    //handle last option: change price, name, gallery
    jQuery.handleLastOption = function() {
        var activeOption = [];
        $('.filter-option-detail').each(function() {
            if ($(this).hasClass('active')) {
                activeOption.push($(this).attr('attr-option-id'));
            }
        });
        var activeOptionString = activeOption.join(',');
        var configurableData = $('#configurable-data').text();
        var configurableObject = JSON.parse(configurableData);
        var childProduct = configurableObject[activeOptionString];
        //assign product child data: name, price, gallery
        $('.detail-name').text(childProduct.name);
        $('#product-price').text(childProduct.price);

        //use ajax to reload gallery
        $.request('onReloadGallery', {
            data: childProduct,
            update: { 'Product::ajaxGallery' : '#product-gallery'},
            evalSuccess: 'xZoomGallery()' //call function when success /modules/system/assets/js/framework.js
        });
        //end reload gallery

        $('#qty-detail-div').removeClass('class-hidden');

        var buttonBuyNowDetail = $('#buy-now-detail-span');
        buttonBuyNowDetail.attr('attr-name', childProduct.name);
        buttonBuyNowDetail.attr('attr-qty', childProduct.qty);
        buttonBuyNowDetail.attr('attr-qty-order', childProduct.qty_order);
        buttonBuyNowDetail.attr('attr-image', childProduct.featured_image);
        buttonBuyNowDetail.attr('attr-price', childProduct.final_price);
        buttonBuyNowDetail.attr('attr-product-id', childProduct.id);
    };

    //display option next level
    jQuery.displayOptionNextLevel = function(optionNext, currentLevel) {
        var arrayOptionNext = optionNext.split(',');
        var nextLevel = parseInt(currentLevel) + 1;
        $('.level-'+ nextLevel).hide();
        $.each(arrayOptionNext, function(index, value) {
            $('#filter-option-'+value).show();
        })
    };

    //initial option
    if (document.getElementById('configurable-data') !== null) {
        var firstOption = $('.level-1').eq(0);
        var optionNext = firstOption.attr('attr-next');
        var currentLevel = firstOption.attr('attr-level');
        $('.level-1').removeClass('active');
        firstOption.addClass('active');
        $.displayOptionNextLevel(optionNext, currentLevel);
    }

    //configurable
    $('.filter-option-detail').click(function() {
        var optionNext = $(this).attr('attr-next');
        var currentLevel = $(this).attr('attr-level');
        $('.level-'+currentLevel).removeClass('active');
        $(this).addClass('active');
        if (optionNext != '') {
            $.displayOptionNextLevel(optionNext, currentLevel);
        } else {//last option
            $.handleLastOption();
        }
    });

    //display modal review
    $('.modal-review').click(function() {
        $.request('onCaptcha', {
            data: {},
            success: function(res) {
                var imagePath = '/storage/app/media/captcha/'+res.image;
                $('#captcha-image').attr('src', imagePath);
                sessionStorage.setItem('captcha_code', res.code);
                $('#modalReview').modal();
            }
        });
    });

    //submit review
    $('#submit-review').click(function() {
        var captcha = $('#captcha').val();
        var captchaSession = sessionStorage.getItem('captcha_code');
        if (captcha == captchaSession) {
            var formReview = $('#form-review-product').serializeArray();
            $.request('onSubmitReview', {
                data: formReview,
                success: function(res) {
                    $('#modalReview').modal('hide');
                    //$.notify(msgJs.add_review_success, 'success');
                    location.reload();
                }
            });
        } else {
            $.notify(msgJs.captcha_is_not_correct);
        }
    });

    /**
     * End product detail
     */
});