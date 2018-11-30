$(document).ready(function() {

  $('.box-loader').fadeIn(200);
  setTimeout(function(){
      $('.box-loader').fadeOut(400);
  },700);

  var height = $(window).height();
  var width = $(window).width();

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

    parallaxIt(); 

    $(window).resize(function(){
      var height = $(window).height();
      var width = $(window).width();

      $('main').css('min-height' , height);

      parallaxIt(); 
      
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
    $('body').toggleClass('no-scroll');
    console.log('click');
  });

  if (width < 768) {
      $('.navbar-nav').height(height);
  }

  
  // PARALLAX
  function parallaxIt() {

    // create variables
    var $fwindow = $(window);
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // on window scroll event
    $(window).on('scroll resize', function() {
      scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    }); 

    // for each of content parallax element
    $('[data-type="content"]').each(function (index, e) {
      var $contentObj = $(this);
      var fgOffset = parseInt($contentObj.offset().top);
      var yPos;
      var speed = ($contentObj.data('speed') || 1 );

      $(window).on('scroll resize', function (){
        yPos = fgOffset - scrollTop / speed; 

        $contentObj.css('top', yPos);
      });
    });

    // for each of background parallax element
    $('[data-type="background-image"]').each(function(){
      var $backgroundObj = $(this);
      var bgOffset = parseInt($backgroundObj.offset().top);
      var yPos;
      var coords;
      var speed = ($backgroundObj.data('speed') || 0 );

      $fwindow.on('scroll resize', function() {
        yPos = - ((scrollTop - bgOffset) / speed); 
        coords = '40% '+ yPos + 'px';

        $backgroundObj.css({ backgroundPosition: coords });
      }); 
    }); 

    // triggers winodw scroll for refresh
    $fwindow.trigger('scroll');
  };
  
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
