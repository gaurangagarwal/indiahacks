$(function() {

	$(".ripple").on('click', function(e) {

		if ($(this).find('span').length === 0) {

			$(this).append('<span></span>');

			var ripple = $(this).find('span'),
				w = $(this).innerWidth()*2,
				clickY = $(this).offset().top,
				clickX = $(this).offset().left,
				x = e.pageX - clickX,
				y = e.pageY - clickY;

			ripple.css({
				'top': y +'px',
				'left': x +'px',
			});

			ripple.animate({
				'width': w +'px',
				'height': w +'px',
				'margin-top': -w/2 +'px',
				'margin-left': -w/2 +'px',
				'opacity': 0,
			}, 600, function() {
				$(this).remove();
			});

		}
		
	});

});