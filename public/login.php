<?php

    // configuration
    require("../includes/config.php"); 
    $backgroundimages = [
      // ["http://www.crtiq.com/img/background/DSC_5655_bracketed.jpg", "Loneliness and Sand", "Daniel Yue","img/harrypotterthumb.png"],
      // ["http://www.crtiq.com/img/background/wanderer_above_lake_powell_cropped.jpg","Wanderer Above Lake Powell", "Daniel Yue","img/harrypotterthumb.png"],
      // ["http://www.crtiq.com/img/background/dunster_sunrise_over_the_charles_cropped.jpg","Sunrise Over the Charles", "Daniel Yue","img/harrypotterthumb.png"],
      ["http://www.crtiq.com/img/background/sleeping_parents_cropped.jpg","Sleeping Parents", "Daniel Yue","img/harrypotterthumb.png", "4", "9"],
      ["http://www.crtiq.com/img/background/antelope_canyon_cropped.jpg","Antelope Canyon", "Daniel Yue","img/harrypotterthumb.png", "2", "9"],
      ["http://www.crtiq.com/img/background/blue_oz_bg.jpg", "Blue Oz", "Dominick Zheng", "img/usericon.png", "10", "10"],
      ["http://www.crtiq.com/img/background/cheers_bg.jpg", "Cheers", "Dominick Zheng", "img/usericon.png", "15", "10"],
      // ["http://www.crtiq.com/img/background/DSC_0091_cropped.jpg","Fading", "Daniel Yue","img/harrypotterthumb.png"]
          //NOTE: The last element has NO comma
      ];
    $backgroundimage = $backgroundimages[array_rand($backgroundimages, 1)];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            render("home_screen.php", ["title" => "Intelligent Photography", "message" => "Please enter your username.", "backgroundimage" => $backgroundimage]);
            exit;

        }
        else if (empty($_POST["password"]))
        {
            render("home_screen.php", ["title" => "Intelligent Photography", "message" => "Please enter a password.", "backgroundimage" => $backgroundimage]);
            exit;
        }

        $link = mysqli_connect("localhost", "root", "root", "crtiq");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $username = mysqli_real_escape_string($link, $_POST["username"]);
        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $username);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];
                $_SESSION["critiqued"] = 0;

                // redirect to portfolio
                redirect("/home.php");
            }
        }

        // else apologize
        render("home_screen.php", ["title" => "Intelligent Photography", "message" => "Invalid username/password.", "backgroundimage" => $backgroundimage]);
        exit;
    }
    else
    {
        // else render form
        render("home_screen.php", ["title" => "Log In", "backgroundimage" => $backgroundimage]);
    }

?>
