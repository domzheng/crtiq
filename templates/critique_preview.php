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

            <h1><?=htmlspecialchars($image_data["title"])?></h1>
            <?php print("<a href=\"others.php?user_id={$image_data["user_id"]}\">");?> 
            
            <h2>by <?=htmlspecialchars($artist_data["fullname"])?></h2></a><br>
            <h3><?=htmlspecialchars($image_data["date"])?></h3>

            <div class="predetailsicon">
                <span class="hint--top" data-hint="CAMERA&#10;<?php if (!empty($image_data["camera"])): print("&nbsp;&nbsp;&nbsp;{$image_data["camera"]}"); else: print("unspecified"); endif?>&#10;&#10;LENS&#10;<?php if (!empty($image_data["lens"])): print("&nbsp;&nbsp;&nbsp;{$image_data["lens"]}"); else: print("unspecified"); endif?>&#10;&#10;APERTURE&#10;<?php if (!empty($image_data["aperture"])): print("&nbsp;&nbsp;&nbsp;{$image_data["aperture"]}"); else: print("unspecified"); endif?>&#10;&#10;SHUTTER&#10;<?php if (!empty($image_data["shutter"])): print("&nbsp;&nbsp;&nbsp;{$image_data["shutter"]}"); else: print("unspecified"); endif?>&#10;&#10;ISO&#10;<?php if (!empty($image_data["iso"])): print("&nbsp;&nbsp;&nbsp;{$image_data["iso"]}"); else: print("unspecified"); endif?>"><img src= "img/hovercamera.png" title=""></a></span>
            </div>

        </div>

    </div>
   

</div>
</body>

</html>