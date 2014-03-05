<?php $pageTitle = "Webkit Transitions LVL 1: Intro to Transitions";?>
<?php include('./_header.php');?>

<style type="text/css">
#ex1 a {
  color:green;
}

#ex1 a:hover {
  color: red;
}

	
#ex2 a{
  color:green;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -webkit-transition-timing-function: linear;
}

#ex2 a:hover {
  color: red;
}

#ex3 a {
  color:green;
  -webkit-transition: color 0.5s linear;
}

#ex3 a:hover {
  color: red;
}

</style>

<div class="section clearfix">
	<h2>Start with a Link</h2>
	<div class="explanation">
<code><pre>
a {
  color:green;
}

a:hover {
  color: red;
}
</pre></code>
	</div>
	<div id="ex1" class="example">
		<a href="">Normal Link</a>
	</div>
</div>


<div class="section clearfix">
	<h2>The Long Way</h2>
	<div class="explanation">

<code><pre>
a {
  color:green;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -webkit-transition-timing-function: linear;
}

a:hover {
  color: red;
}
</pre></code>

	</div>
	
	<div id="ex2" class="example">
			<a href="">The Long Way</a>
	</div>
</div>

<div class="section clearfix">
	<h2>The Short Way</h2>
	<div class="explanation">
<code><pre>
a {
  color:green;
  -webkit-transition: color 0.5s linear;
}

a:hover {
  color: red;
}
</pre></code>

	</div>
	
	<div id="ex3" class="example">
		<a href="">The Short Way</a>
	</div>
</div>

<?php include('_footer.php');?>