<?php

    // took out "require config" to access portfolios even if not logged in

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("../includes/constants.php");
    require("../includes/functions.php");

    // enable sessions
    session_start();

    // ========================= end config stuff here =======================

    if (isset($_GET["user_id"]))
    { 
        // get data related to the user
        $user_data_array = query("SELECT * FROM users WHERE id = ?", $_GET["user_id"]);
        if ($user_data_array == false)
        {
            // redirect to others if user does not exist
            redirect("/others.php");
        }
        else
        {
            $user_images = query("SELECT id, url, title FROM images WHERE user_id = ? ORDER BY RAND()", $_GET["user_id"]);
            $background_url_array = query("SELECT url FROM images WHERE user_id = ? ORDER BY RAND() LIMIT 1", $_GET["user_id"]);
            if (!empty($background_url_array)){
                $background_url = $background_url_array[0]["url"];
            }
            
            $user_info = query("SELECT * FROM users WHERE id = ?", $_GET["user_id"])[0];
            $user_info["splitname"] = explode(" ", $user_info["fullname"]);

            if (empty($user_images))
            {
                $background_url = query("SELECT url FROM images ORDER BY RAND() LIMIT 1")[0]["url"];
                render("gallery_form.php", ["title" => "Welcome", "user_images" => [], "user_info" => $user_info, "background_url" => $background_url, "user_id" => $_GET["user_id"], "session_id" => $_SESSION["id"]]);
                exit;
            }
            else
            {
                render("gallery_form.php", ["title" => "Portfolio", "user_images" => $user_images, "user_info" => $user_info, "background_url" => $background_url, "user_id" => $_GET["user_id"], "session_id" => $_SESSION["id"]]);
                exit;
            }
        }
    }

    // require authentication for most pages
    if (!preg_match("{(?:login|index|signup)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("/index.php");
        }
    }

    if ($_SESSION["critiqued"] == 0)
    {
        redirect("/home.php");
    }

    $users = query("SELECT id, fullname, profile_url, likes FROM users WHERE id != ? ORDER BY RAND()", $_SESSION["id"]);

    $counter = 0;
    foreach($users as $user)
    {
        $users[$counter]["images"] = query("SELECT id, url, title FROM images WHERE user_id = ? ORDER BY RAND() LIMIT 3", $user["id"]);
        $counter++;
    }
    $activeusers= array();
    $counter = 0;
    foreach($users as $user)
    {
        if (!empty($user["images"]))
        {
            $activeusers[$counter] = $user;
            $counter++;
        }
    }

    $counter = 0;
    foreach($activeusers as $activeuser)
    {
        $activeusers[$counter]["backgroundimgurl"] = query("SELECT url FROM images WHERE user_id = ? ORDER BY RAND() LIMIT 1", $activeuser["id"])[0]["url"];
        $activeusers[$counter]["imgnum"] = sizeof(query("SELECT id FROM images WHERE user_id = ?", $activeuser["id"]));
        $counter++;
    }
    render("others_form.php", ["title" => "Browse Other's Work", "activeusers" => $activeusers]);
    exit;
?>
