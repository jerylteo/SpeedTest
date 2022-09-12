<?php
  // GET ORIGINAL SOURCE IMAGE
  $img_r = imagecreatefromjpeg($_GET['img']);

  //Create a new true color image FOR A GIVE WDITH & HEIGHT
  $dst_r = ImageCreateTrueColor( $_GET['w'], $_GET['h'] );
 
  

 //imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h ) : bool
     
imagecopyresampled($dst_r, $img_r, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h'], $_GET['w'],$_GET['h']);

$crop_file = "uploaded_crop\crop_".basename($_GET['img']);


  header('Content-type: image/jpeg');
  imagejpeg($dst_r,$crop_file);
  echo $crop_file;
  exit;
?>