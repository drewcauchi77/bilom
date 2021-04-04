$(document).ready(function () {
    $('.single-property-gallery-property-images').slick({
        mobileFirst: true,
        slidesToShow: 1,
        speed: 400,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2500,
        arrows: true,
        nextArrow: '<div class="arrow right-arrow"><img src="../../wp-content/themes/stevesandco/resources/property-slick-arrow.svg"></div>',
        prevArrow: '<div class="arrow left-arrow"><img src="../../wp-content/themes/stevesandco/resources/property-slick-arrow.svg"></div>',
        responsive: [
            {
              breakpoint: 1199,
              settings: {
                arrows:true,
                centerMode: true,
                slidesToShow: 1,
                dots: true,
                customPaging : function(slider, i) {
                    return '<div class="slick-dot"><img src="../../wp-content/themes/stevesandco/resources/single-property-icons/slick-dot.svg"></div>';
                },
              }
            }
          ]
    });

    //On the single property page, padding needs to be added for centerMode to work for slick slider
    //For every pixel of width increased we are adding 0.5px plus a base 100px
    //This only applies for xl screens larger than 1200 
    function addPaddingToSlickTrack(){
        var initialWindowWidth = $(window).width();
        var slidesCount = $('.slick-track div').length;
    
        if(initialWindowWidth >= 1200 && slidesCount > 1){
            var widthDifference = initialWindowWidth - 1200;
            var slickPadding = 100 + (widthDifference * 0.5);
            $('.slick-track').css('padding-left',slickPadding);
        }else if(initialWindowWidth >= 1200 && slidesCount == 1){
            $('.property-image').css('height','500px');
            $('.property-image .image').css('width','100vw');
            $('.property-image .image').css('margin-left','-60px'); 
        }
    }

    //Checking if page is the single property page and applying function
    if($('.single-property-container')[0]){
        addPaddingToSlickTrack();

        $(window).on('resize', function(){
            addPaddingToSlickTrack();
        });
    }

});

$('.enquire-property').click(function(){
    $('.enquire-form').addClass('open');
    $('body').css('overflow-y','hidden');
});

$('.desktop-enquire').click(function(){
    $('.enquire-form').addClass('open');
    $('body').css('overflow-y','hidden');
});

$('.close-enquire-form-icon').click(function(){
    $('.enquire-form').removeClass('open');
    $('body').css('overflow-y','auto');
});

$('.enquire-container .form-container .wpcf7 .screen-reader-response').appendTo('#masthead');
$('.enquire-container .form-container .wpcf7 .screen-reader-response').delay(4000).hide(400);