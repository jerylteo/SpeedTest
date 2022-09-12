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
<?php 
    $file = file_get_contents('example.xml');
    echo $file;

?>
</textarea> 

<textarea rows = "20" cols = "50">
</textarea> <br>

<input type = "submit" value = "Convert">

</form>
</body>
</html>
