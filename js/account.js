$('.my-account-icon, .desktop-my-account-text').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    if($('.user-account-container').hasClass('focus')){

        var classList = $('.focus').attr('class').split(' ');

        $('.'+classList).removeClass('focus');

    }else{

        $('.login-form-container').addClass('focus');

    }

    if($('.login-form-container').hasClass('focus')){

        $('body').css('overflow-y','hidden');

    }else{

        $('body').css('overflow-y','auto');

    }

});



$('.close-user-window').click(function(){

    if($('.user-account-container').hasClass('focus')){

        var classList = $('.focus').attr('class').split(' ');

        console.log(classList);

        $('.'+classList).removeClass('focus');

        $('body').css('overflow-y','auto');

    }

});



$('.forgot-password-button').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.user-account-container').removeClass('focus');

    $('.reset-password-form-container').toggleClass('focus');

    if($('.reset-password-form-container').hasClass('focus')){

        $('body').css('overflow-y','hidden');

    }else{

        $('body').css('overflow-y','auto');

    }

});



$('.register-button').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.user-account-container').animate({scrollTop: '0px'}, 800);

    $('.user-account-container').removeClass('focus');

    $('.register-form-container').toggleClass('focus');

    if($('.register-form-container').hasClass('focus')){

        $('body').css('overflow-y','hidden');

    }else{

        $('body').css('overflow-y','auto');

    }

});



$('.login-button').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.user-account-container').animate({scrollTop: '0px'}, 800);

    $('.user-account-container').removeClass('focus');

    $('.login-form-container').toggleClass('focus');

    if($('.login-form-container').hasClass('focus')){

        $('body').css('overflow-y','hidden');

    }else{

        $('body').css('overflow-y','auto');

    }

});



$('.user-avatar').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.user-account-welcome-screen').toggleClass('focus');

    if($('.user-account-welcome-screen').hasClass('focus')){

        $('body').css('overflow-y','hidden');

    }else{

        $('body').css('overflow-y','auto');

    }

});



$('.account-settings').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.user-account-dashboard').addClass('focus');

});



$('.favourite-listings').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.favourites-list').addClass('focus');

});



$('.go-back-welcome-screen').click(function(){

    $('html, body').animate({scrollTop: '0px'}, 300);

    $('.user-account-dashboard').removeClass('focus');

    $('.favourites-list').removeClass('focus');

});



$('.close-user-welcome-screen').click(function(){

    $('.user-account-welcome-screen').removeClass('focus');

    $('body').css('overflow-y','auto');

});



if($('.page-template-properties-template').length){

    $('.account-manage-section').click(function(){

        window.location.href = "/?account-settings=true";

    });

    $('.favourite-listings').click(function(){

        window.location.href = "/?favourite-listings=true";

    });

}



if (window.location.search.indexOf('account-settings=true') > -1) {

    $('.user-account-welcome-screen').addClass('focus');

    $('.user-account-dashboard').addClass('focus');
    $('body').css('overflow-y','hidden');
}

if (window.location.search.indexOf('favourite-listings=true') > -1) {

    $('.user-account-welcome-screen').addClass('focus');

    $('.favourites-list').addClass('focus');
    $('body').css('overflow-y','hidden');
}

$('.profilepress-login-status').appendTo('#masthead');

$('.profilepress-login-status').delay(4000).hide(400);



$('.profilepress-reg-status').appendTo('#masthead');

$('.profilepress-reg-status').delay(4000).hide(400);



$('.profilepress-reset-status').appendTo('#masthead');

$('.profilepress-reset-status').delay(4000).hide(400);



$('.account-settings-errors').appendTo('#masthead');

$('.account-settings-errors').delay(4000).hide(400);