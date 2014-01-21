<?php

    // configuration
    require("../includes/config.php"); 

    // if critique was posted, make it
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (!empty($_POST["critique-text"]))
        {
            date_default_timezone_set('America/New_York');
            $date = date('F j, Y, g:i a', time());
            $insert = query("INSERT INTO critiques (text, quality, image_id, writer_id, date) VALUES(?, ?, ?, ?, ?)", 
                    $_POST["critique-text"], $_POST["quality"], $_POST["image_id"], $_SESSION["id"], $date);
            $user_id = query("SELECT user_id FROM images WHERE id = ?", $_POST["image_id"])[0]["user_id"];
            // increment like numbers if liked
            if ($_POST["quality"]==1)
            {
                $check1 = query("UPDATE images set likes = likes + 1 WHERE id = ?", $_POST["image_id"]);
                $check2 = query("UPDATE users set likes = likes + 1 WHERE id = ?", $user_id);
            }
            // increase dislike numbers if disliked
            else
            {
                $check1 = query("UPDATE images set dislikes = dislikes + 1 WHERE id = ?", $_POST["image_id"]);
                $check2 = query("UPDATE users set dislikes = dislikes + 1 WHERE id = ?", $user_id);
            }
            $_SESSION["critiqued"] = 1;
            redirect("/home.php");
        }
        else
        {
            // else the form is empty, pass back error
            // get data related to the image, copied from below with modifications
            $image_data_array = query("SELECT * FROM images WHERE id = ?", $_POST["image_id"]);
            if ($image_data_array == false)
            {
                // redirect to user's gallery if image does not exist
                redirect("/home.php");
            }
            else
            {
                $image_data = $image_data_array[0];
            }

            // get artist's data
            $artist_data = query("SELECT * FROM users WHERE id = ?", $image_data["user_id"])[0];

            // get critiques
            $critiques = query("SELECT * FROM critiques WHERE image_id = ?", $image_data["id"]);

            render("critique_screen.php", ["title" => "Submit a Critique!", "image_data" => $image_data, "artist_data" => $artist_data, 
                    "quality" => $_POST["quality"], "message" => "You must write you comments to finish submitting!", "critiques" => $critiques]);
            exit;
        }
    }

    // if image_id is set, which it should be, load form
    if (isset($_GET["image_id"]) && (empty($_GET["quality"])))
    { 
        // get data related to the image
        $image_data_array = query("SELECT * FROM images WHERE id = ?", $_GET["image_id"]);
        if ($image_data_array == false)
        {
            // redirect to user's gallery if image does not exist
            redirect("home.php");
        }
        else
        {
            $image_data = $image_data_array[0];
        }
        // get artist's data
        $artist_data = query("SELECT * FROM users WHERE id = ?", $image_data["user_id"])[0];

        // get critiques
        $critiques = query("SELECT * FROM critiques WHERE image_id = ? ORDER BY RAND() LIMIT 10", $image_data["id"]);
        $counter = 0;
        foreach ($critiques as $critique)
        {
            $critiques[$counter]["writer"] = query("SELECT fullname FROM users WHERE id = ?", $critique["writer_id"])[0]["fullname"];
            $counter++;
        }
        render("critique_screen.php", ["title" => "Submit a Critique!", "image_data" => $image_data, 
               "artist_data" => $artist_data, "critiques" => $critiques]);
        exit;
    }
    // if quality is also set, render form if valid or render the same as above if invalid
    else if (isset($_GET["image_id"]) && (!empty($_GET["quality"])))
    {
        // get data related to the image
        $image_data_array = query("SELECT * FROM images WHERE id = ?", $_GET["image_id"]);
        if ($image_data_array == false)
        {
            // redirect to user's gallery if image does not exist
            redirect("home.php");
        }
        else
        {
            $image_data = $image_data_array[0];
        }
        // get artist's data
        $artist_data = query("SELECT * FROM users WHERE id = ?", $image_data["user_id"])[0];

        // get critiques
        $critiques = query("SELECT * FROM critiques WHERE image_id = ?", $image_data["id"]);

        // if valid qualitites, pass next step on form
        if ($_GET["quality"] == 1 || $_GET["quality"] == 2)
        {
            render("critique_screen.php", ["title" => "Submit a Critique!", "image_data" => $image_data, 
                    "artist_data" => $artist_data, "critiques" => $critiques, "quality" => $_GET["quality"]]);
            exit;
        }
        // if invalid, pass first step of form
        else
        {
            render("critique_screen.php", ["title" => "Submit a Critique!", "image_data" => $image_data, 
                "artist_data" => $artist_data, "critiques" => $critiques]);
            exit;
        }
    }
    else
    {
        // else redirect to user's gallery
        redirect("home.php");
    }
?>
