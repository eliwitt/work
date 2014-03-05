<?php $pageTitle = "Webkit Transitions LVL 2";?>
<?php include('_header.php');?>
<style type="text/css">
#btn1 a {
text-decoration:none;
background-color:green;
color:white;
padding:10px 30px;
-webkit-border-radius: 12px;
-webkit-transition-property: color, background-color;
-webkit-transition-duration: 0.3s, 0.3s;
-webkit-transition-timing-function: linear, linear;
}

#btn1 a:hover {
  background-color:black;
  color: red;
}	

#btn2 a {
	text-decoration:none;
  padding:10px 30px;
  -webkit-border-radius: 12px;
  background-color:green;
  color:white;
  -webkit-transition: all 0.3s linear;
}

#btn2 a:hover {
  background-color:black;
  color: red;
}
</style>

<div class="section clearfix">
	<h2>Transition All (The Long Way)</h2>
	
	<div class="explanation">
<code><pre>
a {
  /* button styling */
  text-decoration:none;
  background-color:green;
  color:white;
  padding:10px 30px;
  -webkit-border-radius: 12px;
  
  /* transitions */
  -webkit-transition-property: color, background-color;
  -webkit-transition-duration: 0.3s, 0.3s;
  -webkit-transition-timing-function: linear;
}

a {
  background-color:black;
  color: red;
}	
</pre></code>

	
	</div>
	<div id="btn1" class="example">
			<a href="">Launch Robot</a>
	</div>
</div>


<div class="section clearfix">
	<h2>Transition all (The Short Way)</h2>
	<div class="explanation">
<code><pre>
a {
  /* button styling */
  ...
	
  /* transitions */
  -webkit-transition: all 0.3s linear;
}

a:hover {
  background-color:black;
  color: red;
}
</pre></code>
	
	</div>
	<div id="btn2" class="example">
		<a href="">Launch Robot</a>
	</div>
</div>

<?php include('_footer.php');?>