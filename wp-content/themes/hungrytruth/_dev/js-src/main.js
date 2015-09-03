 $(function(){

	// close alert with session cookie
	if($.cookie('alert_closed') != 'theclosed'){
		console.log("cookie not set");
		$(".alert").slideDown();
	} else {
		$(".alert").hide();
	}

	$(".alert .close").click(function(){
		$(".alert").slideUp("slow");
		$.cookie('alert_closed', 'theclosed', { path: '/' });
		console.log("cookie set");
	});

 	// to check if is a mobile device
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};

	//Lazy load images
	if($(window).width() > 992)
		$(".desktop.unveil").unveil(0, function() {
		  $(this).load(function() {
		    this.style.opacity = 1;
		  });
		});
	else
		$(".mobile.unveil").unveil(0, function() {
		  $(this).load(function() {
		    this.style.opacity = 1;
		  });
		});
	

	// FastClick
	if(isMobile.any()) {
		FastClick.attach(document.body);
	}

 	// Search Toggle
 	$('.search-btn').click(function(){
 		$('.large-search #searchform, .search-btn').toggleClass('on');
 	});

 	// Mobile Nav
 	$('.mobile-nav-btn').click(function(){
 		$('#main-nav').toggleClass('on');
 		$('.mobile-nav-btn.fd-stack').toggle();
 		$('body').toggleClass('slide-left');
 	});

 	//tile hover interactions: I WISH I COULD HAVE DONE THIS IN CSS!!!!
 	$('.tile .media').hover(function(){
 		$(this).next().find('h4 a').toggleClass('on');
 	});

 	$('.tile-content > h4 a').hover(function(){
 		$(this).closest(".tile").toggleClass('on');
 	});


 	// Sticky Items
 	$(".sidebar-container, .social_toolbar, .juicer-feed-container").stick_in_parent();

 	// p tags with strong for Article pages
 	$("p:has(strong)").css({
 		"margin-top" : 10,
 		"margin-bottom" : 15
 	});

 	// Overflow container Table for Article pages
 	$(".content-container table").wrap("<div class='overflow-wrap'/>");


 	//wrap in responsive wrapper
 	$("iframe").wrap("<div class='frame-wrap'/>");

 	//prevent sidescroll for full width dropdown menu
 	$('#fdl-mininav-expand').hover(function(){
 		$('body').css("overflow-x", "hidden");
 	});


 	//Masonry for ajax load more
	var $container = $('#masonry-grid'); // our container
	$container.masonry({
      itemSelector: '.tile',
      gutter: '.gutter-sizer',
      transitionDuration: 0
    });	
	$.fn.almComplete = function(alm){ // Ajax Load More callback function
		if($('#masonry-grid').length){	  
		  $container.masonry('reloadItems'); // Reload masonry items oafter callback	  
		  $container.imagesLoaded( function() { // When images are loaded, fire masonry again.
		    $container.masonry();
		  });	  
		}
		$("img.unveil").unveil(0, function() {
			  $(this).load(function() {
			    this.style.opacity = 1;
			  });
		});
	};


//header mobile 
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('#header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('#header').addClass('nav-up');
        $('.mobile-footer').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#header').removeClass('nav-up');
            $('.mobile-footer').removeClass('nav-up');
        }
    }
    
    lastScrollTop = st;
}


 	
 });