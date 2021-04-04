$(document).ready(function () {
    $('.home-gallery-property-images').slick({
        slidesToShow: 1,
        speed: 400,
        infinite: true,
        autoplay: false,
        arrows: true,
        nextArrow: '<div class="arrow right-arrow"><img src="./wp-content/themes/stevesandco/resources/property-slick-arrow.svg"></div>',
        prevArrow: '<div class="arrow left-arrow"><img src="./wp-content/themes/stevesandco/resources/property-slick-arrow.svg"></div>',
    });

    $('.wpp_search_select_field_rent_or_buy option[value="Sale"]').attr('selected',true);

    $('.selection-button').click(function(){
        $(this).addClass('active');
        $('.selection-button').not(this).removeClass('active');
        
        var className = $(this).attr('class').split(' ');
        var preClassName = className[1].split('-');
        var toggleTaglineClass = '.'+preClassName[0]+'-section';

        $('.title-tagline-section').removeClass('visible');
        $(toggleTaglineClass).addClass('visible');

        var selectedOption = preClassName[0];
        selectedOption = selectedOption.toLowerCase().replace(/\b[a-z]/g, function(letter){
            return letter.toUpperCase();
        });

        var optionDropdownSelect = '.wpp_search_select_field_rent_or_buy option[value="'+selectedOption+'"]';

        $('.wpp_search_select_field_rent_or_buy option:selected').removeAttr('selected');
        $(optionDropdownSelect).attr('selected',true);
    });

    // LOCALITY

    // Initiliasing array for text replacement
    var localityTextArray = new Array();
    // Emptying area checkbox on load
    $('.localities .list-of-localities .select-area input:checkbox').prop('checked', false);
    // Emptying localities checkbox on load
    $('.localities .list-of-localities ul li input:checkbox').prop('checked', false);
    // Emptying WP-Property search checkboxes on load
    $('.wpp_selectors_locality ul.locality li input:checkbox').prop('checked', false);

    // Opening the side window with the locality checkboxes
    $('.home-container .wpp_search_label_locality').click(function(){
        $('.wpp_selectors_locality').addClass('visible');
        $('.wpp_selectors_property_types').removeClass('visible');
        var initialWindowWidth = $(window).width();
        if(initialWindowWidth < 992){
            $('body').css('overflow-y','hidden');
        }
    });

    $('.home-container .locality-header .close-section').click(function(){
        // To close window and reset all changes
        $('.wpp_selectors_locality').removeClass('visible');
        $('.localities .list-of-localities .select-area input:checkbox').prop('checked', false);
        $('.localities section ul li input:checkbox').prop('checked', false);
        $('ul.locality li input:checkbox').prop('checked', false);
        $('.localities .list-of-localities .select-area input').removeAttr('checked');
        $('.localities section ul li input').removeAttr('checked');
        $('ul.locality li input').removeAttr('checked');
        $('.locality-top-title .title').text('Locality');
        $('.seach_attribute_locality label .title').text('Locality');
        $('.seach_attribute_locality label .title').css('color','rgba(21,21,21,0.5)');
        localityTextArray = [];
        $('body').css('overflow-y','auto');
    });

    $('.home-container .locality-header .close-desktop-section').click(function(){
        $('.wpp_selectors_locality').removeClass('visible');
    });

    $('.home-container .locality-header .clear-desktop-filters').click(function(){
        $('.localities .list-of-localities .select-area input:checkbox').prop('checked', false);
        $('.localities section ul li input:checkbox').prop('checked', false);
        $('ul.locality li input:checkbox').prop('checked', false);
        $('.localities .list-of-localities .select-area input').removeAttr('checked');
        $('.localities section ul li input').removeAttr('checked');
        $('ul.locality li input').removeAttr('checked');
        $('.locality-top-title .title').text('Locality');
        $('.seach_attribute_locality label .title').text('Locality');
        $('.seach_attribute_locality label .title').css('color','rgba(21,21,21,0.5)');
        localityTextArray = [];
    });

    $('.home-container .locality-top-title .apply-filters').click(function(){
        // To apply changes/selections and exit
        $('.wpp_selectors_locality').removeClass('visible');
        $('body').css('overflow-y','auto');
    });

    $('.home-container .area-selectors .area').click(function(){
        // To toggle between columns
        $(this).addClass('enabled');
        $('.area').not(this).removeClass('enabled');
        var idName = '.' + $(this).attr('id') + '-localities';
        $('.list-of-localities').removeClass('visible');
        $(idName).addClass('visible');
    });

    // Area selector only (North/Central/South/Gozo)

    $('.localities section .select-area input').click(function(){
        // To unselect/select the proper selection from WP-Property search
        if($(this).attr('checked')){
            $(this).attr('checked',false);
            var inputValue = $(this).attr('value');
            var inputSelector = 'ul.locality li input[value='+inputValue+']';
            $(inputSelector).click();
            $(inputSelector).attr('checked', false);
            var removeName = $(this).next('label');
            // Go through array and remove the unchecked value
            localityTextArray = jQuery.grep(localityTextArray, function(value){
                return value != removeName[0].innerHTML;
            }); 
            $('.locality-top-title .title').text(localityTextArray);
            $('.seach_attribute_locality label .title').text(localityTextArray);
            if(localityTextArray.length === 0){
                $('.locality-top-title .title').text('Locality');
                $('.seach_attribute_locality label .title').text('Locality');
                $('.seach_attribute_locality label .title').css('color','rgba(21,21,21,0.5)');           
            }
        }else{
            // When selecting the checkbox positively
            $(this).attr('checked',true);
            // Obtain the name of the label after the input
            var inputValue = $(this).next('label');
            // Create a string value of the class we are going to target to select the WP-Property search checkboxes
            var inputSelector = 'ul.locality li input[value="'+inputValue[0].innerHTML+'"]';
            // Click on the selector, otherwise WP-Property wouldnt notice which is selected
            $(inputSelector).click();
            // Set the area of WP-Property search checkboxes as checked (seems like it is not visible)
            $(inputSelector).attr('checked', true);
            // Change the title of the bar at the top by pushing to array
            localityTextArray.push(inputValue[0].innerHTML);
            // Changing the text by the array values and showing them on front and at top bar and changing color too
            $('.locality-top-title .title').text(localityTextArray);
            $('.seach_attribute_locality label .title').text(localityTextArray);
            $('.seach_attribute_locality label .title').css('color','black');
        }
    });

    // City selector only

    $('.localities section ul li input').click(function(){
        if($(this).attr('checked')){
            $(this).attr('checked',false);
            var inputValue = $(this).next('label');
            var inputSelector = 'ul.locality li input[value="'+inputValue[0].innerHTML+'"]';
            $(inputSelector).click();
            $(inputSelector).attr('checked', false);
            var removeName = $(this).next('label');
            // Go through array and remove the unchecked value
            localityTextArray = jQuery.grep(localityTextArray, function(value){
                return value != removeName[0].innerHTML;
            });
            $('.locality-top-title .title').text(localityTextArray);
            $('.seach_attribute_locality label .title').text(localityTextArray);
        }else{
            // When selecting the checkbox positively
            $(this).attr('checked',true);
            var inputValue = $(this).next('label');
            var inputSelector = 'ul.locality li input[value="'+inputValue[0].innerHTML+'"]';
            $(inputSelector).click();
            $(inputSelector).attr('checked', true);
            localityTextArray.push(inputValue[0].innerHTML);
            $('.locality-top-title .title').text(localityTextArray);
            $('.seach_attribute_locality label .title').text(localityTextArray);
            $('.seach_attribute_locality label .title').css('color','black');
        }
    });

    // PROPERTY TYPES

    // Initialising of array to obtain a list of selected values
    var propertyTypeTextArray = new Array();
    $('.select-all-container input:checkbox').prop('checked', false);
    $('.property_types li input:checkbox').prop('checked', false);

    $('.property_types li input').click(function(){
        // If selected checkbox already selected, remove checked and check array for removal
        if($(this).attr('checked')){
            // Uncheck the attribute
            $(this).attr('checked',false);
            // Obtain the attribute name from label to remove from array
            var removeName = $(this).next('label');
            // Go through array and remove the unchecked value
            propertyTypeTextArray = jQuery.grep(propertyTypeTextArray, function(value){
                return value != removeName[0].innerHTML;
            });
            // Paste the new array in the span section
            $('.property_types-top-title .title').text(propertyTypeTextArray);
            $('.seach_attribute_property_types label .title').text(propertyTypeTextArray);
            if(propertyTypeTextArray.length === 0){
                $('.property_types-top-title .title').text('Type of Property');
                $('.seach_attribute_property_types label .title').text('Property Type');
                $('.seach_attribute_property_types label .title').css('color','rgba(21,21,21,0.5)');    
            }
        }else{
            $(this).attr('checked',true);
            var name = $(this).next('label');
            propertyTypeTextArray.push(name[0].innerHTML);
            $('.property_types-top-title .title').text(propertyTypeTextArray);
            $('.seach_attribute_property_types label .title').text(propertyTypeTextArray);
            $('.seach_attribute_property_types label .title').css('color','black');
        }
    });

    $('.select-all-container input').click(function(){
        if($(this).attr('checked')){
            $(this).attr('checked',false);
            $('.property_types li input:checkbox').prop('checked', false);
            $('.property_types li input').removeAttr('checked');
            $('.property_types li input').attr('disabled',false);
            $('.property_types-top-title .title').text('Type of Property');
            $('.seach_attribute_property_types label .title').text('Property Type');
            $('.seach_attribute_property_types label .title').css('color','rgba(21,21,21,0.5)');
        }else{
            $(this).attr('checked',true);
            $('.property_types li input:checkbox').prop('checked', true);
            $('.property_types li input').attr('checked',true);
            $('.property_types li input').attr('disabled',true);
            $('.property_types-top-title .title').text('All Selected');
            $('.seach_attribute_property_types label .title').text('All Property Types Selected');
            $('.seach_attribute_property_types label .title').css('color','black');
        }
    });

    $('.home-container .wpp_search_label_property_types').click(function(){
        $('.wpp_selectors_property_types').addClass('visible');
        $('.wpp_selectors_locality').removeClass('visible');
        var initialWindowWidth = $(window).width();
        if(initialWindowWidth < 992){
            $('body').css('overflow-y','hidden');
        }
    });

    $('.home-container .property_types-header .close-section').click(function(){
        $('.wpp_selectors_property_types').removeClass('visible');
        $('.property_types li input:checkbox').prop('checked', false);
        $('.select-all-container input:checkbox').prop('checked', false);
        $('.property_types li input').removeAttr('checked');
        $('.select-all-container input').removeAttr('checked');
        $('.property_types-top-title .title').text('Type of Property');
        $('.seach_attribute_property_types label .title').text('Property Type');
        $('.seach_attribute_property_types label .title').css('color','rgba(21,21,21,0.5)');
        $('.property_types li input').attr('disabled',false);
        propertyTypeTextArray = [];
        $('body').css('overflow-y','auto');
    });

    $('.home-container .property_types-header .close-desktop-section').click(function(){
        $('.wpp_selectors_property_types').removeClass('visible');
    });

    $('.home-container .property_types-header .clear-desktop-filters').click(function(){
        $('.property_types li input:checkbox').prop('checked', false);
        $('.select-all-container input:checkbox').prop('checked', false);
        $('.property_types li input').removeAttr('checked');
        $('.select-all-container input').removeAttr('checked');
        $('.property_types-top-title .title').text('Type of Property');
        $('.seach_attribute_property_types label .title').text('Property Type');
        $('.seach_attribute_property_types label .title').css('color','rgba(21,21,21,0.5)');
        $('.property_types li input').attr('disabled',false);
        propertyTypeTextArray = [];
    });

    $('.home-container .property_types-top-title .apply-filters').click(function(){
        $('.wpp_selectors_property_types').removeClass('visible');
        $('body').css('overflow-y','auto');
    });

    // if($(window).width() >= 992){

    //     var localityCounter = 0;

    //     $('body').click(function(e) {
    //         if(localityCounter > 0){
    //             if($(e.target).closest('.wpp_selectors_locality').length === 0) {
    //                 $('.wpp_selectors_locality').removeClass('visible');
    //                 localityCounter = -1;
    //             }
    //         }
    //         localityCounter++;
    //     });

    //     var propertyTypeCounter = 0;

    //     $('body').click(function(e) {
    //         if(propertyTypeCounter > 0){
    //             if($(e.target).closest('.wpp_selectors_property_types').length === 0) {
    //                 $('.wpp_selectors_property_types').removeClass('visible');
    //                 propertyTypeCounter = -1;
    //             }
    //         }
    //         propertyTypeCounter++;
    //     });

    // }

});