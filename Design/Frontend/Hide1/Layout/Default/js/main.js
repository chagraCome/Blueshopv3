(function ($) {
 "use strict";
 
/*---------------------
 jQuery MeanMenu
--------------------- */
	jQuery('nav#dropdown').meanmenu();

/*---------------------
 3. scrollUp
--------------------- */	
	$.scrollUp({
      scrollText: '<i class="fa fa-angle-up"></i>',
      easingType: 'linear',
      scrollSpeed: 900,
      animation: 'fade'
    });	


/*---------------------
Image Zoom
--------------------- */
  $('.simpleLens-big-image').simpleLens({
    loading_image: 'demo/images/loading.gif'
  }); 

/*---------------------
TOP Menu Stick
--------------------- */
	$(window).on('scroll', function() {
	  if ($(this).scrollTop() > 165) {
	    $('#fix-user-menu').addClass("fix-header");
	  } 
	  else {
	   	$('#fix-user-menu').removeClass("fix-header");
	  };
	  if ($(this).scrollTop() > 165) {
	    $('#fix-logo').addClass("fix-header");
	  } 
	  else {
	   	$('#fix-logo').removeClass("fix-header");
	  };
      if ($(this).scrollTop() > 165) {
        $('#sticker').addClass("fix-nav");
      } 
      else {
        $('#sticker').removeClass("fix-nav");
      };	
	  if ($(this).scrollTop() > 165) {
	    $('#menu-fix').addClass("fix-menu");
	  } 
	  else {
	   	$('#menu-fix').removeClass("fix-menu");
	  }	  
	 });




  $(".morecate").on('click', function(){
    $(".lesscate").css("display","block");
    $(this).hide();
    //$('.lesscate').slideToggle();
  });
  $(".lesscate").on('click', function(){
    $(".morecate").css("display","block");
    $(this).hide();
  });

/*---------------------
 1. product-category
--------------------- */
   $(".cate-toggler").on('click', function(){
    $(".product-category").toggle();
  });

/*---------------------
 1. owl-carousel
--------------------- */
	$(".product-carusul, .details-product-carusul").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    pagination :false,
    items : 5,
    itemsDesktop : [1199,4],
    itemsDesktopSmall : [979,3],
    itemsMobile : [767,1],
 
  });
/*---------------------
 2. owl-carousel
--------------------- */
$(".blog-carosul").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    pagination :false,
    items : 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,2],
    itemsMobile : [767,1],
 
  });
/*---------------------
 3. owl-carousel
--------------------- */
$(".logo-brand-carosul").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    pagination :false,
    items : 6,
    itemsDesktop : [1199,6],
    itemsDesktopSmall : [979,4],
    itemsMobile : [767,1]
 
  });
/*---------------------
 4. owl-carousel
--------------------- */
$(".product-carusul-9, .blog-carosul-9").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    pagination :false,
    items : 4,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3],
    itemsMobile : [767,1],
 
  });

/*---------------------
 5. owl-carousel
--------------------- */
$(".product-carusul-14").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    pagination :false,
    items : 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,2],
    itemsMobile : [767,1],
 
  })

/*---------------------
 5. owl-carousel
--------------------- */
$(".hot-product-carosul, .blog-carosul-14, .left-bar-blog-carusol").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    pagination :false,
    items : 1,
    itemsDesktop : [1199,1],
    itemsDesktopSmall : [979,1],
    itemsMobile : [767,1],
  });

 /*---------------------
 6. owl-carousel
--------------------- */
  $(".post-slider").owlCarousel({
  
    autoPlay: false, //Set AutoPlay to 3 seconds
    navigation : true,
    navigationText : ["<i class='fa fa-caret-left'></i>","<i class='fa fa-caret-right'></i>"],
    pagination :true,
    items : 1,
    itemsDesktop : [1199,1],
    itemsDesktopSmall : [979,1],
    itemsMobile : [767,1],
 
  });


/*---------------------
PRICE FILTER
--------------------- */

    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 200,
      values: [ 0, 200 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "" + ui.values[ 0 ] + " — " + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
      " — " + $( "#slider-range" ).slider( "values", 1 ) );

  
  
  
  
/*---------------------
 about-counter
--------------------- */	
    $('.about-counter').counterUp({
        delay: 50,
        time: 3000
    });	

/*---------------------
 countdown
--------------------- */
	$('[data-countdown]').each(function() {
	  var $this = $(this), finalDate = $(this).data('countdown');
	  $this.countdown(finalDate, function(event) {
		$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
	  });
	});	


})(jQuery);