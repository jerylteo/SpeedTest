<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D6</title>
</head>
<body>

<?php

$image = imagecreatefromstring(file_get_contents('./img.png'));

$width = imagesx($image);
$height = imagesy($image);

$color_counts = [];

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $color = imagecolorat($image, $x, $y);
        $color_counts[$color] = ($color_counts[$color] ?? 0) + 1;
    }
}

asort($color_counts);

$count_color = 0;
foreach ($color_counts as $color => $count) {
    $r = ($color >> 16) & 0xFF;
    $g = ($color >> 8) & 0xFF;
    $b = $color & 0xFF;
    ?>
    <div style="display: flex; align-content: center; margin-top: 30px;">
        <div style="width: 40px; height: 40px; background-color: rgb(<?= $r ?>, <?= $g ?>, <?= $b ?>)"></div>
        <p style="margin-left: 15px;">R: <?= $r ?>, G: <?= $g ?>, B: <?= $b ?></p>
        <p style="margin-left: 15px;">Count: <?= $count; ?></p>
    </div>
    <?php
    if (2 < ++$count_color) {
        break;
    }
}
?>
</body>
</html>
