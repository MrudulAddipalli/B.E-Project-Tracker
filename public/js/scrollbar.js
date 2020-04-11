(function($) {

if(jQuery('.mk-body-parallax').length > 0) {
    jQuery('body').parallax("50%",body_parallax_speed);
}

if(jQuery('.mk-page-parallax').length > 0) {
	jQuery('#page').parallax("50%",page_parallax_speed);
}

if(jQuery('.mk-nicescroll').length > 0 && jQuery('.mk-flexsldier-slideshow').length == 0) {
	jQuery('html').niceScroll({  "cursorwidth" : 8,
								 "cursorcolor" : "#464646",
								 "bouncescroll" : false
	});
}

jQuery('.mk-scroll-top').on('click', function() {
	jQuery('body').ScrollTo({
		duration: 3000,
		easing: 'easeOutQuart',
		durationMode: 'all'
	});
})
})(jQuery);