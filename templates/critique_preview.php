<link rel="stylesheet" href="css/hint.css"></link>

<body>

<div id="container">
  <!-- === === === === === HEADER === === === === === -->
    <div id="header">
        <a href="home.php" title="Back to Home"><div class="logo-nav"></div></a>
        
        <div id="nav">
            <ul>
                <li><a href="home.php" title="Back to Home">HOME</a></li>
                <li><a href="browse.php" title="Browse other's work">BROWSE</a></li>
                <li><a href="about.php" title="About crtIQ">ABOUT</a></li>
            </ul>
        </div>

        <h1 class="pull-right" style="margin-right:4%">
            <a href="logout.php" title="Logout"><img src="img/logout.png" style="height:24px;" alt="Q" /></a>
        </h1>
        <h1 class="pull-right">
            <a href="profile.php" title="Profile Settings"><img src="img/settings.png" style="height:24px;" alt="Q" /></a>
        </h1>
    </div>

    <!-- === === === === === WELCOME === === === === === -->
    <div class="previewdisplay">
        <div class="preview_image_container">
            <?php
            print("<img src=\"{$image_data["url"]}\">");
            ?>
        </div>
        
        <div class="fixed_label">

            <h1><?=htmlspecialchars($image_data["title"])?></h1><h2>by <?=htmlspecialchars($artist_data["fullname"])?></h2><br>
            <h3><?=htmlspecialchars($image_data["date"])?></h3>

            <div class="detailsicon">
                <span class="hint--top" <?php print("data-hint=\"CAMERA&#10;{$image_data["camera"]}&#10;&#10;LENS&#10;{$image_data["lens"]}&#10;&#10;APERTURE&#10;{$image_data["aperture"]}&#10;&#10;SHUTTER&#10;{$image_data["shutter"]}&#10;&#10;ISO&#10;{$image_data["iso"]}\">")?><img src= "img/hovercamera.png" title=""></a></span>
            </div>

        </div>

    </div>
   

</div>
</body>

</html>