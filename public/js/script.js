//initiating jQuery
jQuery(function($) {
	$(document).ready( function() {
  		//enabling stickUp on the '.navbar-wrapper' class
  		if ($(".stuckMenu").length) {
  			$('.stuckMenu').stickUp();
  		}

  	// AJAX requests for creating a new match
	$('#course_id').on('change', function(e){
	    console.log(e);

	    var course_id = e.target.value;

	    //ajax
	    $.get('/match/gettees/' + course_id, function(data){
	    	//success data
	    	$('#scorecard').empty();
	    	$.each(data, function(index, scorecard) {
	    		$('#scorecard').append('<option value="'+scorecard.id+'">'+scorecard.teeColor+'</option>');
	    	});
	    });

	    $.get('/match/getholes/' + course_id, function(data){
	    	//success data
	    	$("#holes-list").empty();
	    	var i = 1;
	    	var holes = parseInt(data);

	    	while (i <= holes) {
	    		$('#holes-list').append('<div class="holes-list-checkbox checkbox"><label><input type="checkbox" name="course_holes[]" value="'+i+'" checked/>'+i+'</label></div>');
	    		i++;
	    	}
	    });
	});

	$('#btn-match').click(function(){		
        $('#frmAssignPoints').trigger("reset");
        $('#mpModal').modal('show');
	});

	$("#btn-match-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            player_id: $('#player_id').val(),
            value: $('#value').val(),
            match_id: $('#match_id').val()
        }

        var type = "POST"; //for creating new resource
        var my_url = "/match/assignpoints";

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
            	console.log(data);
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

	//display modal form for adding achievement
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            player_id: $('#achievement_player_id').val(),
            achievement_id: $('#achievement_id').val(),
            match_hole_id: $('#match_hole_id').val(),
            league_id: $('#league_id').val(),
            match_id: $('#match_id').val()
        }

        var type = "POST"; //for creating new resource
        var my_url = "/match/addachievement";

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
            	console.log(data);
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

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

	$('.scroll_link a').click( function(event) { 
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