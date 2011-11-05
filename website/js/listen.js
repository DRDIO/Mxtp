$(function() 
{
	$('#mixFavorite').click(function (event) 
	{
		event.preventDefault();
		var el = $(this);
		
		$.post(el.attr('href'), null, function (data) {
			if (data.success == true) {
				if (el.find('.ui-icon-heart').is(':visible')) {
					el.find('.text').text('Add to Favorites');
				} else {
					el.find('.text').text('Remove from Favorites');
				}
				
				el.find('.ui-icon-heart').toggle();
			} else {
				alert('Unable to add to favorites, sorry!');
				// TODO: We need something more robust than post to handle on failure
			}
		}, 'json');		
	});
});