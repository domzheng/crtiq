<?php 

    // configuration
    require("../includes/config.php");

    // if critique was posted, make it
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	$var = array("test","test1","test2","test3");
		$test = array_slice($var, 0, 1);
    	echo(json_encode($test));
    }
?>