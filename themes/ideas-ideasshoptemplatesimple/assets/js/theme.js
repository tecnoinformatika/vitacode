// When the user scrolls the page, execute addSticky()
window.onscroll = function() {addSticky()};
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
function addSticky() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            600:{
                items:3
            },
            1000:{
                items:1
            }
        }
    });
    $(".xzoom").xzoom({tint: '#333', Xoffset: 15});
//    $('#bxslider').bxSlider({
//        minSlides: 1,
//        slideWidth:90,
//        controls: false
//    });
    $('#city_id').select2();
    $('#use_same_address').click(function() {
        if ($(this).is(':checked')) {
            $('#div-address-shipping').hide();
        } else {
            $('#div-address-shipping').removeClass('class-hidden');
            $('#div-address-shipping').show();
        }
    });
    $('#star_rating').rating();

    //Search
    jQuery.searchForm = function(e) {
        e.preventDefault();//Enter key pressed
        var key = $('#search-input-top').val();
        if (key.length < 2) {
            $.notify('key word has to be at least 2');
        } else {
            $('#form-search-form').submit();//Trigger search button click event
        }
    };

    $('#search-input-top').keypress(function(e){
        if(e.which == 13){
            $.searchForm(e);
        }
    });

    $('#search-top-icon').click(function(e) {
        $.searchForm(e);
    });
});