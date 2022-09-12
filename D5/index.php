<?php 

$stamp = imagecreatefrompng('logo.png');
$image = imagecreatefromjpeg("image.jpg");

$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

imagecopy($image, $stamp, imagesx($image) - $sx - $marge_right, imagesy($image) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);




?>