<?php

    // configuration
    require("../includes/config.php");

    if (empty($_SESSION["id"]))
    {
        if (isset($_GET["image_id"]))
        {
            $image_data_array = query("SELECT * FROM images WHERE id = ?", $_GET["image_id"]);
            if ($image_data_array == false)
            {
                redirect("/index.php");   
            }
            else
            {
                $image_data = $image_data_array[0];
            }

            // get artist's data
            $artist_data = query("SELECT * FROM users WHERE id = ?", $image_data["user_id"])[0];

            render("critique_preview.php", ["title" => "Preview", "image_data" => $image_data, 
            "artist_data" => $artist_data]);
            exit;
        }
    }
            
        

    // if critique was posted, make it
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        date_default_timezone_set('America/New_York');
        $date = date('F j, Y, g:i a', time());

        // validate everything has been submitted.
        if(empty($_POST["composition-text"]) || !isset($_POST["compositionslider"]) || empty($_POST["colors-text"]) ||
           !isset($_POST["colorsslider"]) || empty($_POST["editing-text"]) ||
           !isset($_POST["quality"]) || !isset($_POST["image_id"]))
        {
            // the form is empty, pass back error
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
                    "quality" => $_POST["quality"], "message" => "Please fill all required fields.", "critiques" => $critiques, "post" => $_POST]);
            exit;
        }

        // otherwise input the comment into sql
        $link = mysqli_connect("localhost", "root", "root", "crtiq");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $composition_text = $_POST["composition-text"];
        $compositionslider = mysqli_real_escape_string($link, $_POST["compositionslider"]);
        $colors_text = $_POST["colors-text"];
        $colorsslider = mysqli_real_escape_string($link, $_POST["colorsslider"]);
        $editing_text = $_POST["editing-text"];
        $editingslider = mysqli_real_escape_string($link, $_POST["editingslider"]);
        $critique_text = $_POST["critique-text"];
        $quality = mysqli_real_escape_string($link, $_POST["quality"]);
        $image_id = mysqli_real_escape_string($link, $_POST["image_id"]);     
        $insert = query("INSERT INTO critiques (compositionrating, compositioncomment, colorsrating, 
                                                colorscomment, editingrating, editingcomment, 
                                                text, quality, image_id, 
                                                writer_id, date) 
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                                $compositionslider, $composition_text, $colorsslider, 
                                $colors_text, $editingslider, $editing_text, 
                                $critique_text, $quality, $image_id, 
                                $_SESSION["id"], $date);
        $user_id = query("SELECT user_id FROM images WHERE id = ?", $image_id)[0]["user_id"];
        // increment like numbers if liked
        if ($_POST["quality"]==1)
        {
            $check1 = query("UPDATE images set likes = likes + 1 WHERE id = ?", $image_id);
            $check2 = query("UPDATE users set likes = likes + 1 WHERE id = ?", $user_id);
        }
        // increase dislike numbers if disliked
        else
        {
            $check1 = query("UPDATE images set dislikes = dislikes + 1 WHERE id = ?", $image_id);
            $check2 = query("UPDATE users set dislikes = dislikes + 1 WHERE id = ?", $user_id);
        }
        $_SESSION["critiqued"] = 1;
        redirect("/home.php");
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
        $critiques = query("SELECT * FROM critiques WHERE image_id = ?", $image_data["id"]);
        $counter = 0;
        foreach ($critiques as $critique)
        {
            $critiques[$counter]["writer"] = query("SELECT fullname FROM users WHERE id = ?", $critique["writer_id"])[0]["fullname"];
            $counter++;
        }
        $compositionsum = 0;
        $colorsum = 0;
        $editingsum = 0;
        foreach($critiques as $critique){
            $compositionsum += $critique["compositionrating"];
            $colorsum += $critique["colorsrating"];
            $editingsum += $critique["editingrating"];
        }
        $num = sizeof($critiques);
        $compositionavg = round(($compositionsum/$num),1);
        $coloravg = round(($colorsum/$num),1);
        $editingavg = round(($editingsum/$num),1);
        $overallavg = round((($compositionavg + $coloravg + $editingavg) / 3), 1);
        $average = [
            "compositionavg" => $compositionavg,
            "coloravg" => $coloravg,
            "editingavg" => $editingavg,
            "overallavg" => $overallavg
        ];

        render("critique_screen.php", ["title" => "Submit a Critique!", "image_data" => $image_data, 
               "artist_data" => $artist_data, "critiques" => $critiques, "average" => $average]);
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
