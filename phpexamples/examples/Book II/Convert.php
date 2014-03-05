<?php
 /* Script name: Convert
  * Description: Reads in a CSV file and outputs a 
  * tab-delimited file. The CSV file must have a .
  * .CSV extension.
  */
  $myfile = "testing";	                              #7
  function convert($filename)                       	#8
  {
    if(@$fh_in = fopen("{$filename}.csv","r"))	      #10
    {
      $fh_out = fopen("{$filename}.tsv","a");	       #12
      while(!feof($fh_in))	                          #13
      {
        $line = fgetcsv($fh_in,1024);             	  #15
        if($line[0] == "")	                          #16
        {
          fwrite($fh_out,"\n");
        }
        else {	                                      #20
          fwrite($fh_out,implode($line,"\t")."\n");	 #21
        }
      }
      fclose($fh_in);
      fclose($fh_out);
    }
    else {	                                          #27
      echo "File doesn't exist\n";
      return false;
    }
    echo "Conversion completed!\n";
    return true;                                   	 #32
  }
  convert($myfile); 	                                #34
?>
