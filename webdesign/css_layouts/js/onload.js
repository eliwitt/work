$(document).ready(function(){
	
	$('a.scrollto').scroller();
	
	var
	$viewport = $('meta[name=viewport]'),
	viewport_settings = $('meta[name=viewport]').attr('content').split(/\s*,\s*/),
	len = viewport_settings.length,
	w = $('#page').width(),
	if ( $viewport )
	{
	  
	}
	else
	{
	  $viewport = $('<meta name="viewport" content=""/>');
	  $viewport.appendTo('head');
	}
	
    
});



// FOOTER TO TOP SCROLL
$.fn.scroller = function()
{
	return this.each( function()
 		{
			$(this).click( function()
				{
					var scroll_target = $(this).attr('href');
					$.scrollTo(scroll_target,800); 
					return false;
				});
		});
}
