<?php 

    // configuration
    require("../includes/config.php");

    // if critique was posted, make it
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	$iterations = strval($_POST["iterationnum"]);
    	$numload = 6;
    	$imagenum = 9 + ($numload * $iterations);
    	$user_images = query("SELECT id, url, title FROM images WHERE user_id != ? ORDER BY id DESC LIMIT ?", $_SESSION["id"], $imagenum);
    	$totalimagenum = count(query("SELECT id, url, title FROM images WHERE user_id != ? ORDER BY id DESC", $_SESSION["id"]));
    	$imagesread = count($user_images);
    	$array = array_slice($user_images, $imagenum - $numload, $numload);
    	if($totalimagenum == $imagesread){
    		$array["done"] = "done";
    	}
    	echo(json_encode($array));
    }
?>