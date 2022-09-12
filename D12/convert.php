<?php

$xml = $_POST['xml'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action = "convert.php" method = "post">
<textarea rows = "20" cols = "50" name = "xml">
<?php echo $xml; ?>
</textarea> 

<textarea rows = "20" cols = "50">
<?php

$xml = simplexml_load_string($xml);
$json = json_encode($xml, JSON_PRETTY_PRINT);
echo $json;
?>
</textarea> <br>

<input type = "submit" value = "Convert">

</form>
</body>
</html>