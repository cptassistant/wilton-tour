//initiating jQuery
jQuery(function($) {
	$(document).ready( function() {
  		//enabling stickUp on the '.navbar-wrapper' class
  		if ($(".stuckMenu").length) {
  			$('.stuckMenu').stickUp();
  		}

	// Cache the Window object
	$window = $(window);
                
   	$('section[data-type="background"]').each(function(){
     	var $bgobj = $(this); // assigning the object
                    
      	$(window).scroll(function() {
                    
			// Scroll the background at var speed
			// the yPos is a negative value because we're scrolling it UP!								
			var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
			
			// Put together our final background position
			var coords = '50% '+ yPos + 'px';
	
			// Move the background
			$bgobj.css({ backgroundPosition: coords });
		
		}); // window scroll Ends

 	});

  		// Change the main-nav if scrolled past the hero element
	$(window).scroll(function(){
		if($(window).scrollTop() >= $('#hero').height()) {
			$('#main-nav').removeClass('navbar-white');
			$('#logo-color').removeClass('toback');
		}
		else {
			$('#main-nav').addClass('navbar-white');
			$('#logo-color').addClass('toback');
		}
	});
	});
});


$(document).ready(function(){
	
	
	
	$('.hero-sub a').click( function(event) { 
			$('html, body').scrollTo(this.hash, 1000, { easing:'easeInOutExpo' });
			event.preventDefault();				
	});

	$('#sub-nav a').click( function(event) { 
			$('html, body').scrollTo(this.hash, 1000, { easing:'easeInOutExpo' });
			event.preventDefault();				
	});


	$('#league-title').each(function(index, element) {
		var heading = $(element);
		var word_array, last_word, first_part;

		word_array = heading.html().split(/\s+/);
		last_word = word_array.pop();
		first_part = word_array.join(' ');

		heading.html([first_part, ' <span>', last_word, '</span>'].join(''));		
	});






	
	$('.wt-offset-anchor').each(function() {
        	
			$(this).waypoint( function( direction ) {
				
				if( direction === 'down' ) {
					
					var containerID = $(this).attr('id');
					
					/* update navigation */
					$('#navigation a').removeClass('selected');
					$('#navigation a[href*=#'+containerID+']').addClass('selected');
									
				}
							
			} , { offset: '80px' });
			  	  
        });
	
	$('.wt-scroll-up-waypoint').each(function() {
			$(this).waypoint( function( direction ) {
				
				if( direction === 'up' ) {
					console.log($(this));
					var containerID = $(this).data('section');
					
					/* update navigation */
					$('#navigation a').removeClass('selected');
					$('#navigation a[href*=#'+containerID+']').addClass('selected');
									
				}
							
			} , { offset: '80px' });
			  	  
        });
}); 
/* 
 * Create HTML5 elements for IE's sake
 */

document.createElement("article");
document.createElement("section");