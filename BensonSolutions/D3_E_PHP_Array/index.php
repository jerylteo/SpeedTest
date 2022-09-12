<?php 
$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$a2=array("e"=>"red","f"=>"black","g"=>"purple");


$result1=array_diff($a1,$a2);
$result2=array_diff($a2,$a1);
echo "<pre>";

print_r($a1);
print_r($a2);

$result = $result1+$result2;
echo "<br>Result array: <br>";
print_r($result1+$result2);

echo "<br>Result array (re-indexed): <br>";
print_r(array_values($result1+$result2));
?>