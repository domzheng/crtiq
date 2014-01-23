<?php

    // configuration
    require("../includes/config.php"); 
    
    // $stocks = query("SELECT symbol, shares FROM stock_data WHERE id = ?", $_SESSION["id"]);
    
    // prepare background images array

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

    // render home
    render("home_screen.php", ["title" => "Intelligent Photography", "backgroundimage" => $backgroundimage]);

?>