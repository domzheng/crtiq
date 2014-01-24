<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            render("login_form.php", ["message" => "Please enter your username."]);
            exit;

        }
        else if (empty($_POST["password"]))
        {
            render("login_form.php", ["message" => "Please enter a password."]);
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
        render("login_form.php", ["message" => "Invalid username/password."]);
        exit;
    }
    else
    {
        // else render form
        render("login_form.php", ["title" => "Log In"]);
    }

?>
