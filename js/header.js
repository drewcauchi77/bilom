$('.desktop-nav-section').click(function(e){
    $(this).toggleClass('toggle');
    $('.desktop-nav-section').not(this).removeClass('toggle');
    e.stopPropagation();
});

$(document).on("click", function(e) {
    if ($(e.target).is(".desktop-nav-section") === false) {
      $(".desktop-nav-section").removeClass("toggle");
    }
});