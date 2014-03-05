jQuery(document).ready(function() {
//
//  the following examples I went through the jquery tutorials Getting started 
//

	// add a hover function on the last li entry in orderdlist
	$("#orderedlist li:last").hover(function() { 
		$(this).addClass("green"); 
		},function(){ 
			$(this).removeClass("green"); 
	}); 
	// add text to each li entry in orderedlist
	$("#orderedlist").find("li").each(function(i) { 
				$(this).append( " BAM! " + i );
	 });
	// any li entry in orderedlist2 that does not have a ul entry gets a black border
	$("#orderedlist2 li").not(":has(ul)").css("border", "1px solid black"); 
	// any anchor with a name attribute gets a background color
	$("a[name]").css("background", "#eee" ); 
	//  reset forms
	$("#reset").click(function() { 
		$("form").each(function() { 
			this.reset(); 
		}); 
	}); 
	// hide and then create a handler for faq entries to been shown when clicked
	// we have chained commands together
	$('#faq').find('dd').hide().end().find('dt').click(function() { 
		$(this).next().slideToggle(); 
	}); 
	// highlight p function for hovering
	$("a").hover(
		function(){ 
			$(this).parents("p").addClass("highlight"); 
		},function(){ 
			$(this).parents("p").removeClass("highlight"); 
	}); 

	// the functions that follow will process the table at the 
	// bottom of this document
	// use the plugin talesorter
	$("#large").tablesorter({widgets: ['zebra']});
	/* add color to each tr entry in mybody
	$("#mybody").find("tr").each(function(j) { 
				if (j%2 == 0) {
					$(this).addClass("even"); 
				} 
	 });
	*/

});