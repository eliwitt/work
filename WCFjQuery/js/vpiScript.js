$(document).ready(function(){

	var Servurl = 'http://localhost/VPIOrderService/OrderService.svc/';
	var SerTail = '';
	var timeout;

	$('#butOrder').click(function(){
		//alert('In event');
		if ($("#custno").val() == "")
		{
			var resultsField =  document.getElementById("inner-container");
			resultsField.innerHTML = "";
			$("#inner-container").append('<P>Customer is a required field for the service.</p>');
		}
		else
		{
			if($("#orderno").val() == "")
				SerTail = $("#custno").val();
			else
				SerTail = "Order/" + $("#custno").val() + "/" + $("#orderno").val();
			//alert('url ' + Servurl+SerTail);
			jQuery("body").css("cursor", "progress");
			$.ajax({
				type: "GET",
				url: Servurl+SerTail,
				dataType: "xml",
				success: callback,
				error: function(){ 
						alert("Error attempting to contact service.");
						jQuery("body").css("cursor", "default");
				}
			});
		}

	});

	/*
 	$('#ajax-loader')
        .ajaxStart(function(){
              $(this).fadeIn();
        })
        .ajaxStop(function(){
              $(this.fadeOut());
    });  */
	//$(document).ajaxStart($.blockUI({ message: '<h1>Just a moment...</h1>' })).ajaxStop($.unblockUI);
	//$('body').ajaxStart($(this).css({'cursor':'wait'})).ajaxStop($(this).css({'cursor':'default'}));

	$(document).on( 'mouseenter', 'article', function( event ) {

	    var $article = $(this);
	    var $container  = $('#inner-container'),
	    	$articles   = $container.children('article');
	    clearTimeout( timeout );
	    timeout = setTimeout( function() {
	 
	        if( $article.hasClass('active') ) return false;
	 
	        $articles.not($article).removeClass('active').addClass('blur');
	 
	        $article.removeClass('blur').addClass('active');
	 
	    }, 75 );
	 
	});
	 
	$(document).on( 'mouseleave', 'article', function( event ) {
	    clearTimeout( timeout );
	    $('article').removeClass('active blur');	 
	});
});

function callback(data, status)
{
	var custField =  document.getElementById("custno");
	var orderField =  document.getElementById("orderno");
	var resultsField =  document.getElementById("inner-container");
	resultsField.innerHTML = "";
	custField.value = "";
	orderField.value = "";
	jQuery("body").css("cursor", "default");
	//console.log(data);
	//alert('In callback ' + status);
	if (status == 'success')
	{
		var theOrders = data.getElementsByTagName("CustOrder");
		//console.log(theOrders);
    	listOrders(theOrders);
	} else {
		$("#inner-container").append('<h3>Error in calling service please contact support.</h3>');
	}

}

function listOrders (theOrders)
{
    var loopIndex;

    for (loopIndex = 0; loopIndex < theOrders.length; loopIndex++)
    {
    	var orNode = theOrders[loopIndex].getElementsByTagName("OrderNumber")[0];
    	var orLine = theOrders[loopIndex].getElementsByTagName("LineNumber")[0];
    	var po = theOrders[loopIndex].getElementsByTagName("PoNumber")[0];
    	var statusTxt = theOrders[loopIndex].getElementsByTagName("StatusText")[0];
    	$("#inner-container").append('<article><p>For order number ' + orNode.innerHTML + 
 			' the line nu is ' + orLine.innerHTML + ' with a po nu of ' + po.innerHTML +
            '</p><p class="client-name">' + statusTxt.innerHTML + '</p></article>');
    }
}