<body>
<div id="container">
  <!-- === === === === === HEADER === === === === === -->
    <div id="header">
        <h1>
            <a href="home.php" title="Back to Home"><img src="img/crtiq_logo.png" alt="CrtIQ" /></a>
        </h1>
        
        <div id="nav">
            <ul>
                <li><a href="home.php" title="Back to your profile">YOU</a></li>
                <li><a href="others.php" title="Browse other users">OTHERS</a></li>
                <li><a href="browse.php" title="Browse other users' work">BROWSE</a></li>
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

    <!-- === === === === === GALLERY === === === === === -->

    <div class="others_gallery_container">
    <?php
      foreach($activeusers as $activeuser)
      { 
        print("<div class=\"others-users-block\" style=\"background-image: url('{$activeuser['backgroundimgurl']}');\">");
          print("<div class=\"others-elements-block\">");
            print("<div class=\"others-gallery-user\">");
              print("<span class=\"others-users-name\">{$activeuser['fullname']}</span>");
              if (!empty($activeuser['profile_url'])){
                print("<div class=\"others-users-icon\" style=\"background-image:url('{$activeuser['profile_url']}')\"></div>");
              }
              else{
                print("<div class=\"others-users-icon\" style=\"background-image:url('img/man-silhouette-svg-med-copy.png')\"></div>");
              }
              if ($activeuser['imgnum']==1){
                print("<span class=\"others-users-info\"> {$activeuser['imgnum']} image | {$activeuser['likes']} likes</span>");
              }
              else{
                print("<span class=\"others-users-info\"> {$activeuser['imgnum']} images | {$activeuser['likes']} likes</span>");
              }
            print("</div>");
            print("<a href=\"critique.php?image_id={$activeuser['images'][0]['id']}\" class=\"others-gallery-img\" style=\"background-image:url('{$activeuser['images'][0]['url']}')\"><span class=\"others-message\">{$activeuser['images'][0]['title']}</span></a>");
            if (!empty($activeuser['images'][1])){
              print("<a href=\"critique.php?image_id={$activeuser['images'][1]['id']}\" class=\"others-gallery-img\" style=\"background-image:url('{$activeuser['images'][1]['url']}')\"><span class=\"others-message\">{$activeuser['images'][1]['title']}</span></a>");
            }
            if (!empty($activeuser['images'][2])){
              print("<a href=\"critique.php?image_id={$activeuser['images'][2]['id']}\" class=\"others-gallery-img\" style=\"background-image:url('{$activeuser['images'][2]['url']}')\"><span class=\"others-message\">{$activeuser['images'][2]['title']}</span></a>");
            }
            print("<br>");
          print("</div>");
          print("<div class=\"horizontal-line\"></div>");
        print("</div>");
      }
    ?>
    </div>
</div>