<?php

$values = array("Apple", "Apple", "Apple", "Apple", "Pear","Orange", "Lemon", "Lemon", "Orange");


echo "<b>Array values:</b><br>";
foreach ($values as $key => $value) {
    echo $value . "<br>";
}

echo "<br>";


echo "<b>Duplicates removed:</b><br>";
foreach (array_unique($values) as $key => $value) {
    echo $value . "<br>";
}

