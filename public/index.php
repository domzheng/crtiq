<?php

    // configuration
    require("../includes/config.php"); 
    
    // $stocks = query("SELECT symbol, shares FROM stock_data WHERE id = ?", $_SESSION["id"]);
    
    // prepare background images array

    $backgroundimages = [
      "http://www.crtiq.com/img/background/DSC_5655_bracketed.jpg",
      "http://www.crtiq.com/img/background/wanderer_above_lake_powell_cropped.jpg",
      "http://www.crtiq.com/img/background/dunster_sunrise_over_the_charles_cropped.jpg",
      "http://www.crtiq.com/img/background/sleeping_parents_cropped.jpg",
      "http://www.crtiq.com/img/background/antelope_canyon_cropped.jpg",
      "http://www.crtiq.com/img/background/DSC_0091_cropped.jpg"
          //NOTE: The last element has NO comma
      ];
    $backgroundimage = $backgroundimages[array_rand($backgroundimages, 1)];

    // render home
    render("home_screen.php", ["title" => "Intelligent Photography", "backgroundimage" => $backgroundimage]);

?>