<?php

    // configuration
    require("../includes/config.php"); 

    // if image_id is set, which it should be, load form
    if (isset($_GET["image_id"]))
    { 
        $image_data_array = query("SELECT * FROM images WHERE id = ?", $_GET["image_id"]); // probably open to sql injection here. fix if time.
        if ($image_data_array == false)
        {
            // redirect to user's gallery if image does not exist
            redirect("home.php");
        }
        else
        {
            $image_data = $image_data_array[0];
        }
        $artist_data = query("SELECT * FROM users WHERE id = ?", $image_data["user_id"])[0];
        render("display_screen.php", ["title" => "Submit a Critique!", "image_data" => $image_data, "artist_data" => $artist_data]);
        exit;
    }
    else
    {
        // else redirect to user's gallery
        redirect("home.php");
    }
?>
