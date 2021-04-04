$('.mobile-menu-icon').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 300);
    $('.mobile-menu').addClass('visible');
    $('body').css('overflow-y','hidden');
});

$('.close-mobile-menu-icon').click(function(){
    $('.mobile-menu').removeClass('visible');
    if($('.user-account-container, .user-account-welcome-screen, .user-account-dashboard').hasClass('focus')){
        $('body').css('overflow-y','hidden');
    }else{
        $('body').css('overflow-y','auto');
    }
});