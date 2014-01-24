<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SESSION["critiqued"] == 0)
    {
    	redirect("/home.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	// prepare standard passback information
    	$user_images = query("SELECT id, url, title FROM images WHERE user_id = ? ORDER BY RAND()", $_SESSION["id"]);
        $background_url_array = query("SELECT url FROM images WHERE user_id = ? ORDER BY RAND() LIMIT 1", $_SESSION["id"]);
        if (!empty($background_url_array))
        {
            $background_url = $background_url_array[0]["url"];
        }
        $user_info = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"])[0];
        $user_info["splitname"] = explode(" ", $user_info["fullname"]);
        if (empty($user_images))
        {
            $background_url = query("SELECT url FROM images ORDER BY RAND() LIMIT 1")[0]["url"];
        }

    	// prepare to pass back variables in case of error
    	$feedback[] = [
        "fullname" => $_POST["fullname"],
        "hometown" => $_POST["hometown"],
        "email" => $_POST["email"],
        "aboutme" => $_POST["aboutme"],
    	];

    	// validate that all required forms have been submitted
	    if (empty($_POST["fullname"]) || empty($_POST["hometown"]) || empty($_POST["email"]))
	    {
	        render("profile_form.php", ["title" => "Profile", "user_images" => $user_images, "user_info" => $user_info, 
	        			"background_url" => $background_url, "message" => "Please fill required fields.", "feedback" => $feedback]);
	        exit;
	    }

        // validate email
	    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL ))
        {
            render("profile_form.php", ["title" => "Profile", "user_images" => $user_images, "user_info" => $user_info, 
            			"background_url" => $background_url, "message" => "Invalid email address. Please modify.", "feedback" => $feedback]);
            exit;
        }

        // if there is a new profile picture, upload it
	    if (           isset($_FILES["profilepic"]["type"])     && (($_FILES["profilepic"]["type"] == "image/jpeg") 
            || ($_FILES["profilepic"]["type"] == "image/jpg")   || ($_FILES["profilepic"]["type"] == "image/pjpeg") 
            || ($_FILES["profilepic"]["type"] == "image/x-png") || ($_FILES["profilepic"]["type"] == "image/png")))
	    {
	        // if user has no folder, make a folder
	        if (!file_exists('upload/' . strval($_SESSION["id"]))) 
            {
	            mkdir('upload/' . strval($_SESSION["id"]), 0777, true);
	        }
	        $uploaddir = '/upload/' . strval($_SESSION["id"] . "/");
	        $uploadfile = $uploaddir . basename($_FILES["profilepic"]['name']);
	        $uploadurl = "http://www.crtiq.com" . $uploadfile;

	        // check if image already exists
	        if (file_exists(dirname(__FILE__).$uploadfile))
	        {
	        	
	            render("profile_form.php", ["title" => "Profile", "user_images" => $user_images, "user_info" => $user_info, 
	            		"background_url" => $background_url, "message" => "An image of that name already exists."]);
	            exit;
	        }
	        // upload file
	        if (move_uploaded_file($_FILES['profilepic']['tmp_name'], dirname(__FILE__).$uploadfile)) 
	        {
	            $check = query("UPDATE users SET profile_url = ? WHERE id = ?", $uploadurl, $_SESSION["id"]);
		    }
	        else
	        {
	            render("profile_form.php", ["title" => "Profile", "user_images" => $user_images, "user_info" => $user_info, 
            			"background_url" => $background_url, "message" => "Bug detected. Please notify crtIQ developers.", "feedback" => $feedback]);
            	exit;
	        }
	    }
        // establish mysql connection
        $link = mysqli_connect("localhost", "root", "root", "crtiq");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $fullname = mysqli_real_escape_string($link, $_POST["fullname"]);
        $hometown = mysqli_real_escape_string($link, $_POST["hometown"]);
        $email = mysqli_real_escape_string($link, $_POST["email"]);
        $aboutme = mysqli_real_escape_string($link, $_POST["aboutme"]);

        // upload the rest of the information
        $check2 = query("UPDATE users 
                         SET fullname=?, hometown=?, email=?, description=? 
                         WHERE id = ?", 
                         $_POST["fullname"], $_POST["hometown"], $_POST["email"], $_POST["aboutme"], $_SESSION["id"]);
        // redirect to gallery
        redirect("/home.php");
	}
    else
    {
	    $user_images = query("SELECT id, url, title FROM images WHERE user_id = ? ORDER BY RAND()", $_SESSION["id"]);
        $background_url = query("SELECT url FROM images WHERE user_id = ? ORDER BY RAND() LIMIT 1", $_SESSION["id"])[0]["url"];
        $user_info = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"])[0];
        $user_info["splitname"] = explode(" ", $user_info["fullname"]);
        if (empty($user_images))
        {
            $background_url = query("SELECT url FROM images ORDER BY RAND() LIMIT 1")[0]["url"];
            render("profile_form.php", ["title" => "Profile", "user_images" => [], "user_info" => $user_info, "background_url" => $background_url]);
            exit;
        }
        else
        {
            render("profile_form.php", ["title" => "Profile", "user_images" => $user_images, "user_info" => $user_info, "background_url" => $background_url]);
            exit;
        }
    }
?>
