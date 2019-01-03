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
  
  // ICONO DROPDOWN MENU
  $('.nav-link.dropdown-toggle').after('<i class="fas fa-chevron-down"></i>');
  
  if(width < 991) {
    $('.menu-item-has-children .fa-chevron-down').on('click', function(){
      $(this).next().toggleClass('show');
      console.log('click');
    });  
  }  

  // MENU TOOGLE

  $('.navbar-toggler').click(function(){
    $(this).toggleClass('open');
    $('#navbarResponsive').toggleClass('open');

    $('body').toggleClass('no-scroll');
  });

  if (width < 768) {
      $('.navbar-nav').height(height);
  }
  
  // FUNCION VISIBLE PARA ANIMACIONES
  $.fn.visible = function(partial) {

  var $t            = $(this),
      $w            = $(window),
      viewTop       = $w.scrollTop(),
      viewBottom    = viewTop + $w.height(),
      _top          = $t.offset().top,
      _bottom       = _top + $t.height(),
      compareTop    = partial === true ? _bottom : _top,
      compareBottom = partial === true ? _top : _bottom;

  return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
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
    
    // AGREGAR ANIMACIONES 
    if(width > 767){
      $(".animate").each(function(i, el) {
        var el = $(el);
        if (el.visible(true)) {
          el.addClass("animated"); 
        }
      });
    }
    
  });

})