<?php
 /* Script name: downloadFiles
  * Description: Downloads all the files with a .txt
  *              extension in a directory via FTP. 
  */
  include("ftpstuff.inc");
 $dir_name = "data/";
 $connect = ftp_connect($servername)
     or die("Can't connect to FTP server");
 $login_result = ftp_login($connect,$userID,$passwd)
     or die("Can't log in");
 $filesArr = ftp_nlist($connect,$dir_name);
 foreach($filesArr as $value)
 {
    if(preg_match("#\.txt$#",$value))
    {
      if(!file_exists($value))
      {
         ftp_get($connect,$value,$dir_name.$value,FTP_ASCII);
      }
      else
      {
         echo "File $value already exists!\n";
      }
    }
 }
 ftp_close($connect);
?>
