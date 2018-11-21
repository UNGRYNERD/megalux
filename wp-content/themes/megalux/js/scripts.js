$(document).ready(function() {

    $('.box-loader').fadeIn(200);
    setTimeout(function(){
        $('.box-loader').fadeOut(400);
    },700);

    var height = $(window).height();
    var width = $(window).width();

    if(width > 767) {
        $('main').css('min-height' , height);

        $(window).resize(function(){
            var height = $(window).height();
            var width = $(window).width();

            $('main').css('min-height' , height);

        })
    }

    // MENU TOOGLE

    $('.menu-toggle').click(function(){
		$(this).toggleClass('open');
        $('body').toggleClass('no-scroll');
  	});

    if (width < 768) {
        $('.navbar-nav').height(height);
    }


})
