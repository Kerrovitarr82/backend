$(document).ready(function($) {
	$('.popup-open').click(function() {
		$(this).next('.popup-fade').fadeIn();
		return false;
	});	
	
	$('.popup-close').click(function() {
		$(this).parents('.popup-fade').fadeOut();
		return false;
	});		
 
	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			$('.popup-fade').fadeOut();
		}
	});
	
	$('.popup-fade').click(function(e) {
		if ($(e.target).closest('.popup').length === 0) {
			$(this).fadeOut();					
		}
	});

	$(".burg").on("click",".bar",function() {
		$(".menu1").slideToggle();
		$(".bar").toggleClass('change');
	   });
});
