<?php

    // configuration
    require("../includes/config.php"); 

    if ($_SESSION["critiqued"] == 0)
    {
        redirect("/home.php");
    }
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // prepare to pass back variables in case of error
        $feedback[] = [
            "title" => $_POST["title"],
            "date" => $_POST["date"],
            "location" => $_POST["location"],
            "description" => $_POST["description"],
            "camera" => $_POST["camera"],
            "lens" => $_POST["lens"],
            "shutter" => $_POST["shutter"],
            "aperture" => $_POST["aperture"],
            "iso" => $_POST["iso"],
        ];
        // validate that all required forms have been submitted
        if (empty($_POST["title"]) || empty($_POST["date"]) || empty($_POST["location"]) || 
            empty($_POST["description"]))
        {
            render("upload_form.php", ["message" => "Please fill required fields.", "feedback" => $feedback]);
            exit;
        }

        if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") 
            || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") 
            || ($_FILES["file"]["type"] == "image/png"))
        {
            // if user has no folder, make a folder
            if (!file_exists('upload/' . strval($_SESSION["id"]))) {
                mkdir('upload/' . strval($_SESSION["id"]), 0777, true);
            }

            $uploaddir = '/upload/' . strval($_SESSION["id"] . "/");
            $uploadfile = $uploaddir . basename($_FILES['file']['name']);
            $uploadurl = "http://www.crtiq.com" . $uploadfile;
            //dump(dirname(__FILE__).$uploadfile);
            if (file_exists(dirname(__FILE__).$uploadfile))
            {
                render("upload_form.php", ["title" => "Upload", "message" => "An image of that name already exists."]);
                exit;
            }
            if (move_uploaded_file($_FILES['file']['tmp_name'], dirname(__FILE__).$uploadfile)) 
            {
                $insert = query("INSERT INTO images (title, camera, lens, date, location, shutter, aperture, iso, 
                    description, user_id, url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $_POST["title"], 
                    $_POST["camera"], $_POST["lens"], $_POST["date"], $_POST["location"], $_POST["shutter"],
                    $_POST["aperture"], $_POST["iso"], $_POST["description"], $_SESSION["id"], $uploadurl); 
                // redirect to gallery
                redirect("/home.php");
            }
            else
            {
                render("upload_form.php", ["title" => "Upload", "message" => "Bug detected. Please notify crtIQ developers."]);
                exit;
            }
        }
        else
        {
            render("upload_form.php", ["title" => "Upload", "message" => "You can only upload JPEGs or PNGs."]);
            exit;
        }
    }
    else
    {
        // else render form
        render("upload_form.php", ["title" => "Upload"]);
    }

?>
