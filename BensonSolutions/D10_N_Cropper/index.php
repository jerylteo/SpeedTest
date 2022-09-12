<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="upload-and-crop-image-using-php-and-jquery-output.jpg" />
    <button type="button">Crop</button>
<?php
$im = imagecreatefrompng('example.png');
$size = min(imagesx($im), imagesy($im));
    
$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
if ($im2 !== FALSE) {
    imagepng($im2, 'example-cropped.png');
    imagedestroy($im2);
}
imagedestroy($im);
    
    
    
    
////// Equivalent function which works in both PHP pre 5.6.12 and 5.6.12+.
$cropped = imagecreatetruecolor( $width, $height );
imagecopyresampled( $cropped, $image, 0, 0, $x, $y, $width, $height, $width, $height );    

?></body>
</html>