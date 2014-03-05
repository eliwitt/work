<?php $pageTitle = "LVL 5 Webkit Animations";?>
<?php include('_header.php');?>

<style type="text/css">
#robot img {
  opacity:1;
  -webkit-animation-name: hello-robot;
  -webkit-animation-duration: 4s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease-in;
}

@-webkit-keyframes hello-robot {
  0% {
    opacity:0;
  }
  20% {
    opacity:.4;
  }
  40% {
    opacity:.1;
  }
  60% {
    opacity:.6;
  }
  80% {
    opacity:.4;
  }
  100% {
    opacity:1;
  }
}

#robot:hover img {
  opacity:0;
  -webkit-animation-name: goodbye-robot;
  -webkit-animation-duration: 4s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease-in;
}


@-webkit-keyframes goodbye-robot {
  0% {
    opacity:1;
  }
  20% {
    opacity:.6;
  }
  40% {
    opacity:.9;
  }
  60% {
    opacity:.4;
  }
  80% {
    opacity:.6;
  }
  100% {
    opacity:0;
  }
}

</style>

<div class="section clearfix">
<h2>Robot Keyframe Animation</h2>
<div class="explanation">
<code><pre>
@-webkit-keyframes appear {
  from { opacity:0; }
  to   { opacity:1; }
}
</pre></code>

<code><pre>
#robot img {
  opacity:1;
  -webkit-animation-name: hello-robot;
  -webkit-animation-duration: 4s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease-in;
}

@-webkit-keyframes hello-robot {
  0% {
    opacity:0;
  }
  20% {
    opacity:.4;
  }
  40% {
    opacity:.1;
  }
  60% {
    opacity:.6;
  }
  80% {
    opacity:.4;
  }
  100% {
    opacity:1;
  }
}
</pre></code>



<strong>Make the Robot Disappear on Hover</strong>


<?php /*
<strong>Make the Robot Disappear on Hover</strong>
<code><pre>
#robot:hover img {
  opacity:0;
  -webkit-animation-name: goodbye-robot;
  -webkit-animation-duration: 4s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease-in;
}
*/?>
<code><pre>
@-webkit-keyframes goodbye-robot {
  0% {
    opacity:1;
  }
  20% {
    opacity:.6;
  }
  40% {
    opacity:.9;
  }
  60% {
    opacity:.4;
  }
  80% {
    opacity:.6;
  }
  100% {
    opacity:0;
  }
}
</pre></code>
</div>

	<div class="example">
		<a id="robot"><img src="img/robot.jpg" alt="paravel robot"/></a>
	</div>
</div>


<?php include('_footer.php');?>