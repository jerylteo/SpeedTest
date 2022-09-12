<?php 
$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$a2=array("e"=>"red","f"=>"black","g"=>"purple");

echo "<pre>";

echo "<br>Original Arrays<br>";
print_r($a1);
print_r($a2);


//// TO FIND DIFFERING ELEMENTS OF 2 ARRAYS
$result1=array_diff($a1,$a2);
$result2=array_diff($a2,$a1);
$unique = $result1+$result2;

echo "<br>Differing Elements of arrays: <br>";
print_r(array_values($unique));

//// TO FIND COMMON ELEMENTS OF 2 ARRAYS
$common = array_intersect($a1,$a2);
// USE array_intersect_assoc IF INDEX NEED TO BE THE SAME TOO
echo "<br>Common Elements of arrays: <br>";
print_r($common);

?>