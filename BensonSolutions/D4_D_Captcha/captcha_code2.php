<?php
session_start();

/// ******* CREATE RANDOM MD5 STRING
$random_alpha =  strtoupper(md5(rand()));

/// ******* GET THE FIRST 4 CHARS
$captcha_code = substr($random_alpha, 0, 4);

/// ******* STORE IN SESSION VARIABLE
$_SESSION["captcha"] = $captcha_code;

/// ******* SET CAPTCHA BOX SIZE
$width = 100;
$height = 100;
$target_layer = imagecreatetruecolor($width,$height);

/// ******* SET TEXT COLOUR TO WHITE
$captcha_text_color = imagecolorallocate($target_layer, 255, 255, 255);

//imagealphablending($target_layer, true);
$black = imagecolorallocatealpha($target_layer,0,0,0,0);

$rotated = imagecreatetruecolor (70, 70);
$x = 0;
for ($i = 0; $i < strlen($captcha_code); $i++){
    $buffer = imagecreatetruecolor (20, 20);
    $buffer2 = imagecreatetruecolor (40, 40);
	
	/// ******* Draw a character at x=0, y=0 font=5
	imagestring($buffer, 5, 0, 0, $captcha_code[$i], $captcha_text_color);

	/// ******* Resize character
	//imagecopyresized ($buffer2, $buffer, 0, 0, 0, 0, 25 + mt_rand(0,12), 25 + mt_rand(0,12), 20, 20);
    
// imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h ) : bool
	imagecopyresized ($buffer2, $buffer, 0, 0, 0, 0, 40, 40, 20, 20);

    
	/// *******  Rotate characters a little
    //imagerotate ( resource $image , float $angle , int $bgd_color [, int $ignore_transparent = 0 ] )
	$rotated = imagerotate($buffer2, mt_rand(-25, 25), $black); 
    //imagecolortransparent ($rotated, $black);
   
	/// ******* Move characters around a little
	$y = mt_rand(1, 50);
	$x += mt_rand(2, 6); 
	imagecopymerge ($target_layer, $rotated, $x, $y, 0, 0, 40, 40, 100);
	$x += 20;

	imagedestroy ($buffer); 
	imagedestroy ($buffer2); 

}

$contrast = 0.6 * 255 * 1.3;
$object_alpha = 75;
/// ******* Draw polygons
for ($i = 0; $i < 3; $i++) {
	$vertices = array (
		mt_rand(-0.25*$width,$width*1.25),mt_rand(-0.25*$width,$width*1.25),
		mt_rand(-0.25*$width,$width*1.25),mt_rand(-0.25*$width,$width*1.25),
		mt_rand(-0.25*$width,$width*1.25),mt_rand(-0.25*$width,$width*1.25)
	);
	$color = imagecolorallocatealpha ($target_layer, mt_rand(0,$contrast), mt_rand(0,$contrast), mt_rand(0,$contrast), $object_alpha);
	imagefilledpolygon($target_layer, $vertices, 3, $color);  
}

/// ******* Draw random lines
$min_thickness = 2;
$max_thickness = 8;
for ($i = 0; $i < 3; $i++) {
	// RANDOM LINE POSITION
	$x1 = mt_rand(-$width*0.25,$width*1.25);
	$y1 = mt_rand(-$height*0.25,$height*1.25);
	$x2 = mt_rand(-$width*0.25,$width*1.25);
	$y2 = mt_rand(-$height*0.25,$height*1.25);
	// RANDOM COLOR
	$color = imagecolorallocatealpha (
		$target_layer, 
		mt_rand(0,$contrast), 
		mt_rand(0,$contrast), 
		mt_rand(0,$contrast), 
		$object_alpha
	);
	imagesetthickness ($target_layer, mt_rand($min_thickness,$max_thickness));
	imageline($target_layer, $x1, $y1, $x2, $y2 , $color);  
}

/// ******* Draw random dots
$num_dots = 500;
for ($i = 0; $i < $num_dots; $i++) {
	// RANDOM POSITION
	$x1 = mt_rand(0,$width);
	$y1 = mt_rand(0,$height);
	// RANDOM COLOR
	$color = imagecolorallocatealpha ($target_layer, mt_rand(0,$contrast), mt_rand(0,$contrast), mt_rand(0,$contrast),$object_alpha);
	imagesetpixel($target_layer, $x1, $y1, $color);
}

/// ******* Draw random CIRCLES
$num_ellipses = 5;
$min_radius = 5;
$max_radius = 50;
for ($i = 0; $i < $num_ellipses; $i++) {
	// RANDOM POSITION
	$x1 = mt_rand(0,$width);
	$y1 = mt_rand(0,$height);
	// RANDOM COLOR
	$color = imagecolorallocatealpha ($target_layer, mt_rand(0,$contrast), mt_rand(0,$contrast), mt_rand(0,$contrast), $object_alpha);
	imagefilledellipse($target_layer, $x1, $y1, mt_rand($min_radius,$max_radius), mt_rand($min_radius,$max_radius), $color);  
}

//imagestring($target_layer, 5, 5, 5, $captcha_code, $captcha_text_color);
header("Content-type: image/jpeg");
imagejpeg($target_layer);
?>