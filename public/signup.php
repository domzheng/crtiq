<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // prepare to pass back varibles in case of error
        $feedback[] = [
            "username" => $_POST["username"],
            "fullname" => $_POST["fullname"],
            "email" => $_POST["email"],
            "hometown" => $_POST["hometown"],
        ];
        // validate submission
        if (empty($_POST["username"]) || empty($_POST["fullname"]) || empty($_POST["email"]) || 
            empty($_POST["hometown"]) || empty($_POST["password"]) || empty($_POST["confirm_password"]))
        {
            render("signup_form.php", ["message" => "Please fill all fields.", "feedback" => $feedback]);
            exit;
        }

        else if ($_POST["confirm_password"] !== $_POST["password"])
        {
            render("signup_form.php", ["message" => "Password entries do not match.", "feedback" => $feedback]);
            exit;
        }

        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL ))
        {
            render("signup_form.php", ["message" => "Invalid email address. Please modify.", "feedback" => $feedback]);
            exit;
        }

        // insert new user
        $insert = query("INSERT INTO users (username, hash, hometown, fullname, email) VALUES(?, ?, ?, ?, ?)", 
                    $_POST["username"], crypt($_POST["password"]), $_POST["hometown"], $_POST["fullname"], $_POST["email"]);
                                     
        // error check new login
        if ($insert === false)
        {
            //dump($feedback[0]["username"]);
            $feedback[0]["username"] = "";
            render("signup_form.php", ["message" => "Username already taken. Please pick another.", "feedback" => $feedback]);
            exit;
        }
        else
        {
            // store value for new id
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            
            // login user
            $_SESSION["id"] = $id;
            $_SESSION["critiqued"] = 0;

            // redirect to portfolio
            redirect("/home.php");
        }
    }
    else
    {
        // else render form
        render("signup_form.php", ["title" => "Sign Up"]);
    }

?>
