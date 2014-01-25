<body>
<div class="darkener"></div>
<script>
  $.backstretch([
    '<?= htmlspecialchars($background_url) ?>'
        //NOTE: The last element has NO comma
    ], {
      fade: 500,      //Speed of Fade
      duration: 5000  //Time of image display
  });
</script>
<script type='text/javascript'>
    $(document).ready(function(){
        console.log("loaded!");
        var iterations = 0;
        $("#more").click(function(){
          console.log("clicked!");
          $.post("moregalleryimg.php",
          {
            iterationnum: iterations,
          },
          function(data,status){
            iterations++;
            console.log(JSON.parse(data));
          });
        });
    });
</script>

<div id="container">
  <!-- === === === === === HEADER === === === === === -->
    <div id="header">
        <a href="home.php" title="Back to Home"><div class="logo-nav"></div></a>
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
  <?php if (isset($user_info)):?>
    <div class="profile-box">
      <div class="usersidebar">
            <div class="username">
            <?php
                $counter = 0;
                foreach($user_info["splitname"] as $name)
                {
                    if ($counter > 0)
                    {
                        print("<br>");
                    }
                    print($name);
                    $counter++;
                }
            ?>
            </div>
            <?php if (!empty($user_info["profile_url"])):?>
                <div class="usericon" style="background-image: url('<?=$user_info["profile_url"]?>');"></div>
            <?php else: ?>
                <div class="usericon" style="background-image: url('img/man-silhouette-svg-med-copy.png');"></div>
            <?php endif ?>
            <div class="userbasicinfo">
                <p><?= htmlspecialchars($user_info["hometown"])?> &nbsp&nbsp&nbsp&nbsp&nbsp|
                      &nbsp&nbsp&nbsp&nbsp&nbsp <?= htmlspecialchars(sizeof($user_images))?> &nbsp images</p>
                <p class="userlikes"><?= htmlspecialchars($user_info["likes"])?> likes</p>
                <p class="userchecks"></p>
            </div>
          <?php if (!empty($user_info["profile_url"])):?>
              <h1 class="about-me title">ABOUT ME</h1>
              <p class="about-me"><?=$user_info["description"]?></p>
          <?php endif ?>
      </div>
      <div class="profile_container">
          <?php
              foreach($user_images as $image)
              {
                  print("<a href=\"critique.php?image_id={$image['id']}\" class=\"gallery-img\" style=\"background-image: url('{$image["url"]}')\">");
                  print("<span class='message'>{$image["title"]}</span></a>");
              }
          ?>
          <?php
            if(isset($session_id))
            {
              if ($user_id == $session_id)
              {
                  print("<a href=\"upload.php\" class=\"gallery-img\" style=\"background-image: url('img/upload_gallery_plus.png');\" title=\"Upload a new photograph.\"></a>");
              }
            }
            elseif ($athome == 1)
            {
                print("<a href=\"upload.php\" class=\"gallery-img\" style=\"background-image: url('img/upload_gallery_plus.png');\" title=\"Upload a new photograph.\"></a>");
            }

          ?>  
      </div>
    </div>
  <?php else: ?>
    <div class="gallery_container">
        <div class="browsecontainer">
        <?php
            foreach($user_images as $image)
            {
                print("<a href=\"critique.php?image_id={$image['id']}\" class=\"gallery-img\" style=\"background-image: url('{$image["url"]}')\">");
                print("<span class='message'>{$image["title"]}</span></a>");
            }
        ?>
        <div style="width:100%;"><button id="more" class="getmoreimg">GET MORE IMAGES</button></div>
      </div>
    </div>
  <?php endif ?>
</div>