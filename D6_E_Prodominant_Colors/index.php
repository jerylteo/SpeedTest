<?php
// EXAMPLE PICTURE
//$url='https://www.nordoff-robbins.org.uk/sites/default/files/google.jpg';
//$url='http://localhost/wss/SpeedTest/D6_E_Prodominant_Colors/Heart_Rate_Monitor_31.jpg';
$url="Smart_Band_Heart_Rate_Monitor_29.jpg";

//var_dump(getColorPallet($url));
echo "<img src='{$url}' /><br>";
showColors(getColorPallet($url));

function showColors($colors){ // OUTPUT COLORSBAR
    $x = 1;
    foreach ($colors as $color=>$count) {
        if($x <=16 ) {  // DISPLAY TOP 16 COLORS
            echo '<div style="display:inline-block;width:50px;height:20px;background:'.$color.'"> </div>';
            $x++;
        }
        else {
            break;
        }
    }
}

function getColorPallet($imageURL, $palletSize=[16,8]){ // GET PALLET FROM IMAGE PLAY WITH INPUT PALLET SIZE
    // CREATE PALLET FROM JPG IMAGE
    $img = imagecreatefromjpeg($imageURL);

    // SCALE DOWN IMAGE
    $imgSizes=getimagesize($imageURL);

    //print_r($imgSizes); die();

    $scaleDownFactor = 8; 
    $reduced_w = ceil($imgSizes[0] / $scaleDownFactor);
    $reduced_h = ceil($imgSizes[1] / $scaleDownFactor);

    /// CREATE REDUCED SIZE IMAGE HOLDER
    $resizedImg=imagecreatetruecolor($reduced_w,$reduced_h);
    imagecopyresized($resizedImg, $img , 0, 0 , 0, 0, $reduced_w, $reduced_h, $imgSizes[0], $imgSizes[1]);


    //CHECK IMAGE
//     header("Content-type: image/png");
//     imagepng($img);
//     imagepng($resizedImg);
    // die();
    
    imagedestroy($img);

    //GET COLORS IN ARRAY
    $colors=[];

    for($i=0;$i<$reduced_h;$i++) {
        for($j=0;$j<$reduced_w;$j++) {

            /// GET COLOR AT $j,$i POINT OF THE REDUCED IMAGE
            $rgb = imagecolorat($resizedImg,$j,$i);

            /// REMOVE SIMILAR COLORS BY CONVERTINT INTO SINGLE DIGIT HEX
            $r = ($rgb >> 16) & 0xF0;   /// SHIFT 16bit AND "and" with F0 
            $g = ($rgb >> 8) & 0xF0;
            $b = $rgb & 0xF0;

            /// CONVERT DECMIMAL BACK TO HEX
            $r_hex = dechex($r);
            $g_hex = dechex($g);
            $b_hex = dechex($b);

            /// STORES THE COLORS
            $colors[]="#".$r_hex.$g_hex.$b_hex;
        }
    }

    imagedestroy($resizedImg);

    // USE array_count_values TO COUNT OCCURENCE OF EACH ARRAY VALUES
    $color_count = array_count_values($colors);
    arsort($color_count);   // ASSICIATIVE REVERSE SORT

    return $color_count;

}