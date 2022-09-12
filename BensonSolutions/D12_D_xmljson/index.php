<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        button {
            background-color: royalblue;
            color:white;
        }
    </style>    
</head>
<body>
    <?php
        $json ="";
            if(isset($_POST['xml'])) {
               $xml = simplexml_load_string($_POST['xml']); 
               $json = json_encode($xml);
            }
    ?>
<form action="" method="post">
    <textarea name="xml" id="xml" cols="100" rows="10">
        <CATALOG>
        <CD>
            <TITLE>Empire Burlesque</TITLE>
            <ARTIST>Bob Dylan</ARTIST>
            <COUNTRY>USA</COUNTRY>
            <COMPANY>Columbia</COMPANY>
            <PRICE>10.90</PRICE>
            <YEAR>1985</YEAR>
        </CD>
        <CD>
            <TITLE>Hide your heart</TITLE>
            <ARTIST>Bonnie Tyler</ARTIST>
            <COUNTRY>UK</COUNTRY>
            <COMPANY>CBS Records</COMPANY>
            <PRICE>9.90</PRICE>
            <YEAR>1988</YEAR>
        </CD>
        </CATALOG>
    </textarea>
    <textarea name="json" id="json" cols="100" rows="10"><?php echo  $json; ?></textarea>
    <br>
    <button>Convert</button>
</form>



<?php
    // $xml = simplexml_load_file("example.xml");
    // //$xml = simplexml_load_string($xml_string);
    // echo "<pre>";
    // $json = json_encode($xml);
    // $array = json_decode($json,TRUE);
    // print_r($array);

    
?>

    
</body>
</html>