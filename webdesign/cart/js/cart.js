(function($){
		  
	//produce new items
	function itemFactory(id, productName, qty, price, thumb) {
		var product = $("<li>").addClass("ui-helper-clearfix").data("id", id),
			quantity = $("<p>").addClass("qty").text(qty).appendTo(product),
			image = $("<img>").attr("src", thumb).appendTo(product),
			title = $("<p>").text(productName).appendTo(product),
			price = $("<span>").html("&pound;" + price).appendTo(product),
			clear = $("<a>").attr({ href: "#", title: "Delete" }).text("x").addClass("clear").insertBefore(price),
			input = $("<input>").attr({ type: "hidden", name: "productId[]" }).val(id).appendTo(product);
			input = $("<input>").attr({ type: "hidden", name: "productQty[]" }).val(qty).appendTo(product);
		product.appendTo("#contents ul");
	};		
		
	
	//if cookie exists build cart
	if($.cookie("cart")){
		var cookieArray = $.cookie("cart").split("&"), total = 0, cost = 0;
		
		$.each(cookieArray, function(i, val) {
			var itemArray = val.split("=");
			
			//add new items
			itemFactory(itemArray[0], itemArray[1], itemArray[2], itemArray[3], "img/thumbs/" + itemArray[0] + ".png"); 
			
			total += parseInt(itemArray[2]);
			cost += parseFloat(itemArray[3]);
		});
		
		//update cart total items
		(total === 1) ? 
			$("#cartHeader p").html('Cart: <span id="items">1</span> item') :
			$("#cartHeader p").html('Cart: <span id="items">' + total + '</span> items');		
		
		//update cart total price
		$("#cost span").html("&pound;" + cost);
	}
	
	//save cart state
	function saveState(isEmpty) {
				
		//check whether empty
		if(isEmpty == "empty") {
			
			//delete cookie
			$.cookie("cart", null, { path: "/", expires: "" });
		} else {
			var state = "";
			
			//make serialized string of cart items
			$("#contents li").each(function(i){
				state += $(this).data("id") + "=" + $(this).find("p").eq(1).text() + "=" + $(this).find(".qty").text() + "=" + $(this).find("span").text().substr(1);
				if(i < $("#contents li").length - 1){
					state += "&";
				}
			});
			
			//write cookie
			$.cookie("cart", state, { path: "/", expires: "" });
		}	
	}
	
	//expand basket to view items
	$("#opener").click(function(e){
		
		//stop the event
		e.preventDefault();
		
		//only show if not empty
		if($("#contents ul").children().length > 0){
			$("#contents").slideToggle(function(){
				if($("#contents").is(":visible")){
					$("#opener").removeClass("ui-icon-circle-arrow-s").addClass("ui-icon-circle-arrow-n");
				} else {
					$("#opener").removeClass("ui-icon-circle-arrow-n").addClass("ui-icon-circle-arrow-s");
				}
			});
		}
	});
	
	//remove 1 item when delete clicked
	$(".clear").live("click", function() {
		
		var qty = $(this).parent().find(".qty"),
			span = $(this).parent().find("span"),
			singleAmount = parseFloat(span.text().substr(1)) / parseInt(qty.text()),
			newTotal = parseFloat(span.text().substr(1)) - singleAmount,
			roundTotal = Math.round(newTotal * 100) / 100;
				
		if(parseInt(qty.text()) > 1) {
			//update quantity and amount
			qty.text(parseInt(qty.text()) - 1);
			span.html("&pound;" + roundTotal);
			$(this).parent().find("input").eq(1).val(parseInt($(this).parent().find("input").eq(1).val()) - 1);
		} else {
			//remove item
			$(this).parent().remove();
			
			//hide list if empty
			if($("#contents ul").children().length === 0) {
				$("#opener").removeClass("ui-icon-circle-arrow-n").addClass("ui-icon-circle-arrow-s").closest("#cartHeader").next().hide();
			}
		}
		
		//update cart total items
		$("#items").text(parseInt($("#items").text()) - 1);
		
		//update cart total price
		var newCost = parseFloat($("#cost span").text().substr(1)) - singleAmount,
			roundCost = Math.round(newCost * 100) / 100;	
		$("#cost span").html("&pound;" + roundCost);
		
		//write cookie
		saveState();
	});
	
	//remove all items on clear all link click
	$("#clearAll").click(function(e){
		e.preventDefault();
		
		//remove all items and hide list
		$("#contents li").remove();
		
		//update cart total items
		$("#cartHeader p").html('Cart: <span id="items">0</span> items');
		
		//update cart total items
		$("#cost span").html("&pound;0.00");
		
		//reset opener icon
		$("#opener").removeClass("ui-icon-circle-arrow-n").addClass("ui-icon-circle-arrow-s").closest("#cartHeader").next().hide();
		
		//write cookie
		saveState("empty");
	});
	
	//make product images draggable
	$("#products img").draggable({
		revert: true,
		zIndex: 1000
	 });
	
	//make basket accept dropped images
	$("#cart").droppable({
		tolerance: "touch",
		drop: function(e, ui){
			
			//update cart total items
			var currentTotal = parseInt($("#items").text());
			(currentTotal === 0) ?
				$("#cartHeader p").html('Cart: <span id="items">1</span> item') :
				$("#cartHeader p").html('Cart: <span id="items">' + (currentTotal + 1) + '</span> items');
						
			//get product info
			var id = $(ui.draggable).parent().attr("id"),
				productName = $("#" + id).find("h2").text(),
				quantity = 1,
				price = parseFloat($("#" + id).find("dd").text().substr(1)),
				thumb = $("#" + id).find("img").attr("src").replace("large", "thumbs");			
			
			//add item
			if ($("#contents li").length === 0) {
				//if no items in cart add new item
				itemFactory(id, productName, quantity, price, thumb);
			} else {
				var exists = false;
				
				//check if item already in cart
				$("#contents li").each(function(){
					if($(this).data("id") === id) {
						//update quantity and amount
						var newTotal = parseFloat($(this).find("span").text().substr(1)) + parseFloat($(ui.draggable).parent().find("dd").text().substr(1));
						var roundTotal = Math.round(newTotal * 100) / 100;
						$(this).find(".qty").text(parseInt($(this).text()) + 1);
						$(this).find("input").eq(1).val(parseInt($(this).find("input").eq(1).val()) + 1);
						$(this).find("span").html("&pound;" + roundTotal);
						exists = true;
					}
				});
				
				if (exists === false) {
					//if item not already in cart add new item
					itemFactory(id, productName, quantity, price, thumb);
				}
			}
			
			//update cart total cost
			var currentCost = parseFloat($("#cost span").text().substr(1)),
				newCost = currentCost + price,
				roundCost = Math.round(newCost * 100) / 100;
			$("#cost span").html("&pound;" + roundCost);
				
			//write cookie
			saveState();
		}
	});
})(jQuery);