<?php
 /* Script name: displayGallery
  * Description: Displays all the image files that are 
  *              stored in a specified directory.
  */
 echo "<html><head><title>Image Gallery</title></head>
       <body>";
 $dir = "../test1/testdir/";                            	#8
 $dh = opendir($dir);	                                   #9
 while($filename = readdir($dh))	                       #10
 {
   $filepath = $dir.$filename; 	                        #12
   if(is_file($filepath) and ereg("\.jpg$",$filename))	 #13
   {
      $gallery[] = $filepath;
   }
 }
 sort($gallery);	                                       #16
 foreach($gallery as $image)	                           #17
 {
   echo "<hr />";
   echo "<img src='$image' /><br />";
 }
?>
</body></html>
