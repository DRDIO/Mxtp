$(function() 
{
	$(document).attr('overicons', '0');
	
	// Build sortable list
	$('.listcontainer').sortable({
		handle: '.ui-icon-arrowthick-2-n-s',
		cursor: 'row-resize',
		containment: 'parent',
		opacity: 0.5,
		tolerance: 'pointer',
		beforeStop: function(event, ui) 
		{
			var data = $('.listcontainer').sortable('serialize');
			$.post('/profile/reordermixes/', {order: data}, function(data) 
			{
				if (data.success == true) {
					// TODO: We need something more robust than post to handle on failure
				} else {
					$('.listcontainer').sortable('cancel');
				}
			}, 'json');
		}
	});
	
	// Declare Dialog Box for notices
	$('#dialog').dialog({
		autoOpen: false,
		resizable: false,
		draggable: false,
		modal: true,
		// Create the two buttons to use
		buttons: {
			'Delete Mix': function() {
				var id = $(this).attr('caller');
				// This will eventually do an AJAX call
				
				$.post('/profile/deletemix/' + id.slice(5), null, function (data) {
					if (data.success == true) {
						$(id).slideUp();
					} else {
						// TODO: We need something more robust than post to handle on failure
					}
				}, 'json');							
				
				$(this).dialog('close');
			},
			'Cancel': function() {
				$(this).dialog('close');
			}
		},
		// When the user first opens, we want to update the dialog title on the
		// delete
		open: function(event, ui) {
			var id    = $(this).attr('caller');
			var title = $(id).find('a .listtitle').html();
			
			$(this).find('.message').html(title);
		}
	});
	
	// Disable selections of text
	$('.listcontainer').disableSelection();
	
	// Set UI Hover
	$('.listcontainer li').hover(function() { $(this).css('cursor', 'pointer'); }, function() { $(this).css('cursor', 'none'); });
	$('.listcontainer div').hover(function() { $(this).addClass('ui-state-hover'); }, function() { $(this).removeClass('ui-state-hover'); });
	
	// Set the states of all titles to not being edited
	$('.listcontainer a .listtitle').each(function(i) {
		$(this).attr('inedit', '0');			
	});
	
	// Setup DELETE
	$('.listcontainer .ui-icon-trash').click(function() {
		// Append the dialog to the button calling it so we can affect data
		var id = $(this).parent().attr('id');
		
		$('#dialog').attr('caller', '#' + id);
		$('#dialog').dialog('open');
	});
	
	// Setup EDIT
	$('.listcontainer .ui-icon-comment').click(function() {
		// Get the current element
		var title = $(this).parent().find('a .listtitle');		
		
		if (title.attr('inedit') == '1') {
			var element = $(this).parent();
			editTitle(element);		
		} else {
			// First, make sure none other are in edit mode
			$('.listcontainer a .listtitle').each(function(i) {
				if ($(this).attr('inedit') == '1') {
					var element = $(this).parent().parent();
					editTitle(element);
				};
			});
				
			// Set to edit mode and focus
			title.attr('inedit', '1');
			title.html('<input type="text" value="' + title.html() + '" />');					
			title.children().focus().val(title.children().val());
		    
			// If the user hits enter, end edit mode
			title.children().keydown(function(event) {
				if (event.keyCode == 13) {
					var element = $(this).parent().parent().parent();
					editTitle(element);				
				}
			});
		}
	});
	
	// When over an icon, we don't want grey bar to be clickable
	$('.listcontainer div, .listcontainer input').mouseover(function() {
		$(document).attr('overicons', '1');
	});
	
	$('.listcontainer div, .listcontainer input').mouseout(function() {
		$(document).attr('overicons', '0');
	});	
	
	$('.listcontainer li').click(function(event) {
		if ($(document).attr('overicons') == '0') {
			$(location).attr('href', $(this).find('a').attr('href'));
		}
	});
});

function editTitle(element) {
	var id    = element.attr('id').slice(4);
	var title = element.find('input').val();	
	var href  = element.find('strong');
	
	href.attr('inedit', '0');
	href.html(title);
	
	$.post('/profile/editmixtitle/' + id, {title: title}, function (data) {		
		// TODO: We need something more robust than post to handle on failure
	}, 'json');
}
