<?php

    // configuration
    require("../includes/config.php"); 
    
    // $stocks = query("SELECT symbol, shares FROM stock_data WHERE id = ?", $_SESSION["id"]);
    

    // render home
    render("home_screen.php", ["title" => "Intelligent Photography"]);

?>
