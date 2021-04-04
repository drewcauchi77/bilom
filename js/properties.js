function enableSlickAfterAjaxCall(){

    $('.properties-gallery-property-images').slick({

        slidesToShow: 1,

        speed: 400,

        infinite: true,

        autoplay: false,

        arrows: true,

        nextArrow: '<div class="arrow right-arrow"><img src="../wp-content/themes/stevesandco/resources/property-slick-arrow.svg"></div>',

        prevArrow: '<div class="arrow left-arrow"><img src="../wp-content/themes/stevesandco/resources/property-slick-arrow.svg"></div>',

    });

}



$('.toggle-properties-search-text').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.properties-search').addClass('visible');

    $('body').css('overflow-y', 'hidden');

});



$('.close-properties-search-icon').click(function(){

    $('.properties-search').removeClass('visible');

    $('body').css('overflow-y', 'auto');

});



$('.wpp_search_label').click(function(){

    $(this).next('.wpp_search_attribute_wrap').toggleClass('open');

    $('.wpp_search_label').not(this).next('.wpp_search_attribute_wrap').removeClass('open');

    $('.seach_attribute_bathrooms').removeClass('open');

    $('.seach_attribute_no_of_bedrooms').removeClass('open');

    $('.seach_attribute_listing_amenities').removeClass('open');

});



$('.toggle-additional-filters').click(function(){

    var filtersWidth = $('.toggle-additional-filters').width() + 30;

    var filtersText = $('.filters-title').text();

    

    if(filtersText == 'Filters'){

        $('.filters-title').html('Close');

    }else{

        $('.filters-title').html('Filters');

    }



    $('.wpp_search_attribute_wrap').removeClass('open');



    $('.seach_attribute_no_of_bedrooms').css('width', filtersWidth);

    $('.seach_attribute_no_of_bedrooms').toggleClass('open');

    $('.seach_attribute_no_of_bedrooms').css('top', '60px');

    var bedroomsHeight = $('.seach_attribute_no_of_bedrooms').outerHeight();

    bedroomsHeight += 58;



    $('.seach_attribute_bathrooms').css('width', filtersWidth);

    $('.seach_attribute_bathrooms').toggleClass('open');

    $('.seach_attribute_bathrooms').css('top', bedroomsHeight);

    var bathroomsHeight = $('.seach_attribute_bathrooms').outerHeight();

    bathroomsHeight += bedroomsHeight;



    $('.seach_attribute_listing_amenities').css('width', filtersWidth);

    $('.seach_attribute_listing_amenities').toggleClass('open');

    $('.seach_attribute_listing_amenities').css('top', bathroomsHeight);



});



function setIdsToProperties(){



    var coordArray = [];

    i = 0;



    $('.map-details').each(function(index) {

        var longitude = $( this ).find('.longitude').text();

        var latitude = $( this ).find('.latitude').text();

        var coordinates = longitude + ' ' + latitude;



        coordArray[i++] = coordinates;

    });



    var unique = [];



    $.each(coordArray, function(i, e) {

        if ($.inArray(e, unique) == -1) unique.push(e);

    });



    console.log(unique);

}



setIdsToProperties();

var getUrlParameter = function getUrlParameter(sParam) {
    var url = window.location.href;
    var dec = decodeURI(url);

    var sPageURL = dec.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

$(document).ready(function () {
    if (window.location.href.indexOf('properties') > -1) {
        var saleOrRent = getUrlParameter('wpp_search[rent_or_buy]');
        if(saleOrRent == 'Rent'){
            $('.wpp_search_select_field_rent_or_buy option[value=Rent]').attr('selected', 'selected');
            $('.wpp_search_select_field_rent_or_buy option[value=Sale]').remove();
            $('.wpp_search_select_field_rent_or_buy option[value=-1]').remove();
        }else if(saleOrRent == 'Sale'){
            $('.wpp_search_select_field_rent_or_buy option[value=Sale]').attr('selected', 'selected');
            $('.wpp_search_select_field_rent_or_buy option[value=Rent]').remove();
            $('.wpp_search_select_field_rent_or_buy option[value=-1]').remove();
        }else{
            $('.wpp_search_select_field_rent_or_buy option[value=-1]').attr('selected', 'selected');
            $('.wpp_search_select_field_rent_or_buy option[value=Sale]').remove();
            $('.wpp_search_select_field_rent_or_buy option[value=Rent]').remove();
        }
    }
});