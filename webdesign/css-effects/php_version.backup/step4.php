<?php $pageTitle = "LVL 4 Webkit Transform";?>
<?php include('_header.php');?>

<style type="text/css">
#scaler img { 
  -webkit-transition: all 1s linear;
  -webkit-transform: scale(1); 
}
#scaler img:hover { 
  -webkit-transform: scale(1.2); 
}
#rotator { 
	-webkit-transition: all 1s linear;
}
#rotator:hover { 
	-webkit-transform: rotate(90deg); 
}
#text-rotator { 
	-webkit-transform: rotate(5deg); 
}
#skewer img { 
  -webkit-transition: all 1s linear;
  -webkit-transform: skew(0deg); 
}
#skewer img:hover { 
  -webkit-transform: skew(10deg, 20deg); 
}
#translator img { 
  -webkit-transition: all 1s linear;
  -webkit-transform: translate(0px); 
}
#translator img:hover { 
  -webkit-transform: translate(50px,-20%); 
}
</style>

<div class="section clearfix">
	<h2>Transform</h2>
</div>

<div class="section clearfix">
	<h2>Scale</h2>
	<div class="explanation">
<code><pre>
#scaler img { 
  -webkit-transition: all 1s linear;
  -webkit-transform: scale(1); 
}
#scaler img:hover { 
  -webkit-transform: scale(1.2); 
}</pre></code>
	</div>

	<div class="example">
		<div id="scaler"><img src="img/robot.jpg" alt="robot"/></div>
	</div>
</div>

<div class="section clearfix">
	<h2>Rotate</h2>
	<div class="explanation">
<code><pre>
#rotator { 
	-webkit-transition: all 1s linear;
}
#rotator:hover { 
	-webkit-transform: rotate(90deg); 
}
</pre></code>
	<h3 id="text-rotator">You can rotate block text too!</h3>
	</div>
	
	<div class="example">
		<img id="rotator" src="img/robot.jpg" alt="robot"/>
	</div>

</div>

<div class="section clearfix">
	<h2>Skew</h2>
	<div class="explanation">
<code><pre>
#skewer img { 
  -webkit-transition: all 1s linear;
  -webkit-transform: skew(0deg); 
}
#skewer img:hover { 
  -webkit-transform: skew(10deg, 20deg); 
}
</pre></code>
	</div>
	<div class="example">
			<div id="skewer"><img src="img/robot.jpg" alt="robot"/></div>
	</div>

</div>

<div class="section clearfix">
	<h2>Translate</h2>
	<div class="explanation">
<code><pre>
#translator img { 
  -webkit-transition: all 1s linear;
  -webkit-transform: translate(0px); 
}
#translator img:hover { 
  -webkit-transform: translate(50px,-20%); 
}
</pre></code>
	</div>

	<div class="example">
			<div id="translator"><img src="img/robot.jpg" alt="robot"/></div>
	</div>

</div>



<?php include('_footer.php');?>