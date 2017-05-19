var $j = jQuery.noConflict();
/* ---------------------------------------------------- */
/*	PARALLAX											*/
/* ---------------------------------------------------- */
jQuery.fn.parallax = function(xpos, speedFactor) {
	'use strict';
	var firstTop, methods = {};
	return this.each(function(idx, value) {
		var $this = jQuery(value), firstTop = $this.offset().top;
		if (arguments.length < 1 || xpos === null)
			xpos = "50%";
		if (arguments.length < 2 || speedFactor === null)
			speedFactor = 0.1;
		methods = {
			update: function() {
				var pos = jQuery(window).scrollTop();
				$this.each(function() {
					$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
				});
			},
			init: function() {
				this.update();
				jQuery(window).on('scroll', methods.update);
			}
		}
		return methods.init();
	});
};

/* ---------------------------------------------------- */
/*	MOBILE MENU 										*/
/* ---------------------------------------------------- */
jQuery(document).ready(function(){
	'use strict';
	jQuery('#menu-main').superfish();
	jQuery('#menu-main li.current-menu-item,#menu-main li.current_page_item,#menu-main li.current-menu-parent,#menu-main li.current-menu-ancestor,#menu-main li.current_page_ancestor').each(function(){
		jQuery(this).prepend('<span class="item_selected"></span>');
	});
});

(function( $ ) {
	'use strict';
	$.fn.sktmobilemenu = function( options ) { 
		var defaults = {
			'fwidth': 1025
		};
		//call in the default otions
		var options = $.extend(defaults, options);
		var obj = $(this);
		
		return this.each(function() {
			if($(window).width() < options.fwidth) {
				sktMobileRes();
			}
			
			$(window).resize(function() {
				if($(window).width() < options.fwidth) {
					sktMobileRes();
				}else{
					sktDeskRes();
				}
			});
			function sktMobileRes() {
				jQuery('#menu-main').superfish('destroy');
				obj.addClass('skt-mob-menu').hide();
				obj.parent().css('position','relative');
				if(obj.prev('.sktmenu-toggle').length === 0) {
					obj.before('<div class="sktmenu-toggle" id="responsive-nav-button"></div>');
				}
				obj.parent().find('.sktmenu-toggle').removeClass('active');
			}
			function sktDeskRes() {
				jQuery('#menu-main').superfish('init');
				obj.removeClass('skt-mob-menu').show();
				if(obj.prev('.sktmenu-toggle').length) {
					obj.prev('.sktmenu-toggle').remove();
				}
			}
			obj.parent().on('click','.sktmenu-toggle',function() {
				if(!$(this).hasClass('active')){
					$(this).addClass('active');
					$(this).next('ul').stop(true,true).slideDown();
				}
				else{
					$(this).removeClass('active');
					$(this).next('ul').stop(true,true).slideUp();
				}
			});
		});
	};
})( jQuery );

jQuery(window).load(function(){
	'use strict';
	jQuery('#full-division-box').parallax("center", 0.2);
	jQuery('#team-division-box').parallax("center", 0.2);

   jQuery('#menu-main.skt-mob-menu').on('click','li.menu-item-has-children',function() {
		if(jQuery(this).hasClass('active')){
			jQuery(this).removeClass('active');
			jQuery(this).next('ul:first').stop(true,true).slideUp();
		}
		else{
			jQuery(this).addClass('active');
			jQuery(this).next('ul:first').stop(true,true).slideDown();
		}
	});

});

jQuery(document).ready(function ($) {
	'use strict';
	document.getElementById('s') && document.getElementById('s').focus();
});
jQuery(document).ready(function(){
	'use strict';
	jQuery( ".sf-with-ul" ).append( '<span class="caret"></span>' );
});

jQuery(window).load(function(){ 
	if(jQuery('#skenav .skt-mob-menu').length > 0){		
		jQuery('#skenav .skt-mob-menu').css('width',jQuery('.row-fluid').width());
	}
});


/* ---------------------------------------------------- */
/*	BACK TO TOP 										*/
/* ---------------------------------------------------- */
jQuery(document).ready( function() {
	'use strict';
	jQuery('#back-to-top,#backtop').hide();
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-to-top,#backtop').fadeIn();
		} else {
			jQuery('#back-to-top,#backtop').fadeOut();
		}
	});
	jQuery('#back-to-top,#backtop').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 'slow');
	});
});


/* ---------------------------------------------------- */
/*	FLEX SLIDER RESIZE SCRIPT						    */
/* ---------------------------------------------------- */
jQuery(window).load(function() {
	'use strict';
	var max = -1;
	jQuery(".flexslider .slides li").each(function() {
		var h = jQuery(this).height();
		max = h > max ? h : max;
		jQuery('.flexslider').css({'min-height': max});
	});
});

jQuery(window).resize(function() {
	'use strict';
	var max = -1;
	jQuery(".flexslider .slides li").each(function() {
		var h = jQuery(this).height();
		max = h > max ? h : max;
		jQuery('.flexslider').css({'min-height': max});
	});
});


/* ---------------------------------------------------- */
/*	WAYPOINTS MAGIC										*/
/* ---------------------------------------------------- */
if ( typeof window['vc_waypoints'] !== 'function' ) {
	function vc_waypoints() {
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			$j('.fade_in_hide').waypoint(function() {
				$j(this).addClass('skt_start_animation');
			}, { offset: '90%' });
			$j('.skt_animate_when_almost_visible').waypoint(function() {
				$j(this).addClass('skt_start_animation');
			}, { offset: '90%' });
		}
	}
}


jQuery(document).ready(function($) {
	'use strict';
	vc_waypoints();
	
	//SEARCH BOX
	jQuery('.search-strip, .hsearch .hsearch-close').on('click', function(){
		jQuery('.hsearch .row-fluid').fadeToggle( "fast", "linear" );
	});
	
	//HOEMPAGE GOOGLE MAP DIRECTION OVERLAY
	jQuery('.fdz-map-overlay').on('click', function(){
		jQuery('html, body').animate({scrollTop: jQuery("#full-map-box").offset().top}, 1000);
		jQuery('.fdz-map .map-hide').fadeIn(function(){jQuery('.fdz-map-overlay').fadeOut(function(){jQuery('.fdz-map .hsearch-close').delay(400).fadeIn(50);jQuery('.fdz-map-overlay').removeClass('active');});});
		if(jQuery('.location_map').length > 0) {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center);
		}
	});
	
	jQuery('.fdz-map .hsearch-close').on('click', function(){
		jQuery(this).fadeOut(50);
		jQuery('.fdz-map .map-hide').slideUp(1000);
		jQuery('.fdz-map-overlay').fadeIn(function(){jQuery('.fdz-map-overlay').addClass('active');});
	});

}); 

/* ---------------------------------------------------- */
/*	HOMEPAGE CAROUSEL								    */
/* ---------------------------------------------------- */
jQuery(document).ready(function() {
	jQuery("#our-menu-items").owlCarousel({
		items : 4,
		lazyLoad : true,
		navigation : true,
		autoPlay : true,
		pagination : false
	});
	
	jQuery("#skt-review-items").owlCarousel({
		items : 1,
		lazyLoad : true,
		navigation : true,
		autoPlay : true,
		pagination : false,
        transitionStyle : "fade"
	});
});

/* ---------------------------------------------------- */
/*	PRETTYPHOTO								            */
/* ---------------------------------------------------- */
jQuery(document).ready(function ($) {
	'use strict';
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		hook: 'data-rel',
		animation_speed:'normal',
		theme:'light_square',
		slideshow:3000,
		show_title:false,
		autoplay_slideshow: false,
		social_tools: false		
	});
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'normal',
		theme:'light_square',
		slideshow:3000,
		show_title:false,
		autoplay_slideshow: false,
		social_tools: false		
	});
});

//--------------------------------------------------------