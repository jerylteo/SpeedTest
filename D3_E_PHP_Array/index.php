<!DOCTYPE html>
<html>
<head>
	<title>PHP Array Comparing</title>
</head>
<body>

	<?php

    // return a new array containing the common elements of the given two arrays.
	function compareArrays($a1, $a2){
        //put your code here
        return array_intersect($a1,$a2);
	}

    print_r(compareArrays(['red', 'green', 'yellow'], ['red', 'green', 'black']));
    echo "<br>";
    print_r(compareArrays(['a', 'b', 'c', 'd', 'e'], ['a', 'b', 'c', 'd', 'e']));
    echo "<br>";
    
    print_r(compareArrays(['a'], ['a', 'b']));
    echo "<br>";
    
    print_r(compareArrays(['a'], ['a', 'c']));
    echo "<br>";
    
    print_r(compareArrays(['a', 'ac', 'eb'], ['a', 'ca', 'be']));
    echo "<br>";
    
	print_r(compareArrays(['a', 'b', 'c'], ['a', 'b', 'c']));

	?>

</body>
</html>
