<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SESSION["critiqued"] == 0)
    {
        redirect("/home.php");
    }
    
    // if form was submitted
    $user_images = query("SELECT id, url, title FROM images WHERE user_id != ? ORDER BY RAND()", $_SESSION["id"]);
    $background_url = query("SELECT url FROM images WHERE user_id != ? ORDER BY RAND() LIMIT 1", $_SESSION["id"])[0]["url"];
    if (empty($user_images))
    {
        // if no images in query, pick a random one.
        $background_url = query("SELECT url FROM images ORDER BY RAND() LIMIT 1")[0]["url"];
        render("gallery_form.php", ["title" => "Welcome", "user_images" => [], "user_info" => $user_info, "background_url" => $background_url]);
        exit;
    }
    else
    {
        render("gallery_form.php", ["title" => "Welcome", "user_images" => $user_images, "background_url" => $background_url]);
        exit;
    }
?>
