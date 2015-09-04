 $(function(){

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