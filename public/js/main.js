/*!
 * Start Bootstrap - Agnecy Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.menu-li').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
jQuery(document).ready(function(){
    jQuery("#dropdownMenu1").click(function(){
        jQuery(".dropdown-menu.container").toggle();
    });
});



$(window).scroll(function() {
	if ($(this).scrollTop() > 1){  
		$('header').addClass("sticky");
	}
	else{
		$('header').removeClass("sticky");
	}
});

$('.single-slider').carousel({
    pause: true,
    interval: false
});

// --------------------------------------------------
// css animation
// --------------------------------------------------
	var v_count = '0';

	jQuery(window).load(function() {
				
		jQuery('.animated').fadeTo(0,0);
		jQuery('.animated').each(function(){
		var imagePos = jQuery(this).offset().top;
		var timedelay = jQuery(this).attr('data-delay');
		
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+300) {
				jQuery(this).fadeTo(1,500);
				$anim = jQuery(this).attr('data-animation');
			}
		});
		

	});
		
	/*	
	jQuery(function () {
		jQuery('#datetimepicker1').datetimepicker();
	});
*/


$('#update-hours').click(function() {
	var saveHours = $('#save-hours');

	if (saveHours.is(':visible')) {
		return;
	}

	saveHours.show();

	$('.student-hours tbody tr.hours-row').each(function() {
		var userId = $(this).data('student-id');
		var credits = $(this).find('.credits');
		var currentCredits = $(this).find('.current-credits');
		var targetCredits = $(this).find('.target-credits');
		credits.html('<input type="text" value="' + credits.text() + '" name="students[' + userId + '][credits]"/>');
		currentCredits.html('<input type="text" value="' + currentCredits.text() + '" name="students[' + userId + '][current]"/>');
		targetCredits.html('<input type="text" value="' + targetCredits.text() + '" name="students[' + userId + '][target]"/>');
	});

	return false;
});


$('#save-hours').click(function() {
	$(this).attr('disabled', true);
	$(this).text('Saving...');

	$(this).parents('form').submit();
});
