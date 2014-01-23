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
        $("div.a").hover(
        function() {
            $(this).stop().animate({"opacity": ".4"}, "slow");
            $(this).find('.message').fadeIn(600);
        },
        function() {
             $(this).stop().animate({"opacity": "1"}, "slow");
             $(this).find('.message').fadeOut(500);
        });

    });
</script>

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

    <!-- === === === === === USER SIDE BAR === === === === === -->
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

    <!-- === === === === === PROFILE FORM === === === === === -->
    <div class="profile_container">
      <div id="profileform">
          <form class="profile-input" method="post" enctype="multipart/form-data" action="profile.php">
              <div id="profileupdate">
                  <?php if (isset($message)):?>
                      <p class='apologyupload'><?= htmlspecialchars($message)?></p>
                  <?php endif ?>
                  <div class="upload-title-container">
                      <input type="text" name="uploadreadonly" placeholder="Upload a new Photo" class="white-trans" readonly></input>
                  </div>
                  <label class="filebutton">
                    +
                    <span><input type="file" name="profilepic" id="file"></input></span>
                  </label>

                  <div class="upload-input-container">
                    <input type="text" name="fullname" placeholder="Full Name" 
                      <?php if (!empty($user_info["fullname"])):?>
                        value='<?=htmlspecialchars($user_info["fullname"])?>'
                      <?php endif ?>
                      class="white-trans"></input>
                  </div>

                  <div class="upload-input-container">
                    <input type="text" name="hometown" placeholder="Hometown eg. Baltimore, MD" 
                    <?php if (!empty($user_info["hometown"])):?>
                      value='<?=htmlspecialchars($user_info["hometown"])?>'
                    <?php endif ?>
                    class ="white-trans"></input>
                  </div>

                  <div class="upload-input-container">
                    <input type="text" name="email" placeholder="Email" 
                    <?php if (!empty($user_info["email"])):?>
                      value='<?=htmlspecialchars($user_info["email"])?>'
                    <?php endif ?>
                    class="white-trans"></input>
                  </div>

              </div>

              <div id="profileupdate2">
                
                 <textarea class="aboutmefield" name="aboutme" placeholder="Tell us about yourself in 140 characters or less" cols="25" rows="5" maxlength="140">
                  hello
<!--                   <?php 
                    if(!empty($user_info["description"])){
                      print("working");
                      print("{$user_info["description"]}");
                    }
                  ?> -->
                 </textarea>  

                  <div class="upload-submit-container submit-button">
                    <input type="submit" name="submit_upload" value="Submit" class="gray-trans"></submit>
                  </div>

              </div>
          </form>
        </div>
  </div>

</div>