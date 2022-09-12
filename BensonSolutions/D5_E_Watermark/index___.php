<?php 
$image = imagecreatefrompng('flower.png');
$stamp = imagecreatefrompng('stamp2.png');
// Set the margins for the stamp and get the height/width of the stamp image
$right = 200;
$bottom = 150;
$sx = imagesx($stamp);
$sy = imagesy($stamp);
// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
imagecopy($image, $stamp, imagesx($image) - $sx - $right, imagesy($image) - $sy - $bottom, 0, 0, imagesx($stamp), imagesy($stamp));
// Output and free memory
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
