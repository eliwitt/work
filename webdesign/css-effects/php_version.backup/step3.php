<?php $pageTitle = "Webkit Transitions LVL 3";?>
<?php include('_header.php');?>


<style type="text/css">
	#mover {
		width:100%;
		height: 298px;
		background: url(img/robot.jpg) no-repeat left;
		display: block;
		-webkit-transition: background-position 0.6s ease-out;
	}
	#mover:hover {
		background-position-x: right;
	}
</style>

<div class="section clearfix">
	<h2>Move the Robot.</h2>
	<div class="explanation">
<code><pre>
a#mover {
  display: block;
  width:100%;
  height: 298px;
  background-image: url(img/robot.jpg);
  background-repeat:no-repeat;
  background-position-x: left;
  -webkit-transition: background-position 0.6s ease-out;
}
a#mover:hover {
  background-position-x: right;
}
</pre></code>
	
	</div>
	
		<div class="example">
		<a id="mover"></a>
	</div>

</div>

<?php include('_footer.php');?>