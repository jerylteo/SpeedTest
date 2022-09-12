<?php
/// LOAD WATERMARK IMAGE
//$stamp = imagecreatefrompng('instagram.png');
//$stamp = imagecreatefrompng('hand.png');
$stamp = imagecreatefrompng('copy.png');

/// LOAD MASTER IMAGE
$image = imagecreatefromjpeg('person5.jpg');

// Set the margins for the stamp
$right = 0;
$bottom = 0;

// GET height/width OF THE STAMP IMAGE
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Merge the stamp onto our photo with an opacity of 20%
// using the margin offsets and the photo 
// width to calculate positioning of the stamp.
///imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct ) 
imagecopymerge($image, $stamp, imagesx($image) - $sx - $right, imagesy($image) - $sy - $bottom, 0, 0, imagesx($stamp), imagesy($stamp) , 20);

// Output and free memory
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>