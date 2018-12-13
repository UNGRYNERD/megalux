$(document).ready(function() {

  $('.box-loader').fadeIn(200);
  setTimeout(function(){
      $('.box-loader').fadeOut(600);
  },800);

  var height = $(window).height();
  var width = $(window).width();
  
  
  setTimeout(function(){
    var anchoproducto = $('.page-product .col-project.col-archive').width();
    $('.page-product .col-project.col-archive').css('min-height', anchoproducto);
  },100);

  
  if(width > 767) {
    $('main').css('min-height' , height);
    
    $('.smooth-scroll').bind('click', function(e) {
      e.preventDefault(); 

      var target = $(this).attr("href"); 

      $('html, body').stop().animate({
          scrollTop: $(target).offset().top
      }, 1000, function() {
          location.hash = target;
      });

      return false;
    });


    $(window).resize(function(){
      var height = $(window).height();
      var width = $(window).width();

      $('main').css('min-height' , height);
      
      setTimeout(function(){
        var anchoproducto = $('.page-product .col-project.col-archive').width();
        $('.page-product .col-project.col-archive').css('min-height', anchoproducto);
      },100);
      
      $('.smooth-scroll').bind('click', function(e) {
        e.preventDefault(); 

        var target = $(this).attr("href"); 

        $('html, body').stop().animate({
            scrollTop: $(target).offset().top
        }, 1000, function() {
            location.hash = target;
        });

        return false;
      });

    });
  }

  // MENU TOOGLE

  $('.navbar-toggler').click(function(){
    $(this).toggleClass('open');
    $('#navbarResponsive').toggleClass('open');

    $('body').toggleClass('no-scroll');
    console.log('click');
  });

  if (width < 768) {
      $('.navbar-nav').height(height);
  }
  
  // EVENTOS EN SCROLL
  $(window).scroll(function() {
    
    var width = $(window).width();
    
    if(width > 767){
      if ($(this).scrollTop() > 200){  
        $('.smooth-scroll').addClass("visible");
      } else{
        $('.smooth-scroll').removeClass("visible");
      } 
    }
    
    if(width > 991) {
      // MENU FIXED CON SCROLL
      if ($(this).scrollTop() > 30){  
        $('header').addClass("sticky-header");
      } else{
        $('header').removeClass("sticky-header");
      } 
    }

  });

})