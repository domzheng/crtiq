<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SESSION["critiqued"] == 0)
    {
        redirect("/home.php");
    }
    
    // if form was submitted
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
