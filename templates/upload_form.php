<body>

  <!--<div><img class="blackgradient" src="img/blackbg.png" alt="crtIQ"></div>-->
  <div id="darkener"></div>
   <script>
      $.backstretch([
        "img/background/DSC_5655_bracketed.jpg",
        "img/background/wanderer_above_lake_powell_cropped.jpg",
        "img/background/dunster_sunrise_over_the_charles_cropped.jpg",
        "img/background/sleeping_parents_cropped.jpg",
        "img/background/antelope_canyon_cropped.jpg",
        "img/background/DSC_0091_cropped.jpg"
            //NOTE: The last element has NO comma
        ], {
          fade: 2500,      //Speed of Fade
          duration: 5000  //Time of image display
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

  <!-- === === === === === UPLOAD FORM === === === === === -->
  <div id="imguploadform">
    <form class="login-input" method="post" enctype="multipart/form-data" action="upload.php">
        <div id="upload">
          <?php if (isset($message)):?>
            <p class='apologyupload'> <?= htmlspecialchars($message) ?></p>
          <?php endif ?>
            <div class="upload-title-container">
              <input type="text" name="title" placeholder="Title (required)" class="white-trans"></input>
            </div>
            <label class="filebutton">
              +
              <span><input type="file" name="file" id="file"></input></span>
            </label>

            <div class="upload-input-container">
              <input type="text" name="date" placeholder="Date Taken (required) eg. December 7, 2013" class="white-trans"></input>
            </div>

            <div class="upload-input-container">
              <input type="text" name="location" placeholder="Location (required)" class ="white-trans"></input>
            </div>

            <textarea class="descriptionfield" name="description" placeholder="Description (required)" cols="25" rows="5"></textarea>

        </div>

        <div id="cameraupload">
          
            <div class="upload-cam-container">
              <input type="text" name="camera" placeholder="Camera" class="white-trans"></input>
            </div>

            <div class="upload-cam-container">
              <input type="text" name="lens" placeholder="Lens" class="white-trans"></input>
            </div>

            <div class="upload-cam-container">
              <input type="text" name="shutter" placeholder="Shutter" class ="white-trans"></input>
            </div>

            <div class="upload-cam-container">
              <input type="text" name="aperture" placeholder="Aperture" class="white-trans"></input>
            </div>

            <div class="upload-cam-container">
              <input type="text" name="iso" placeholder="ISO" class="white-trans"></input>
            </div>

            <div class="upload-submit-container submit-button">
              <input type="submit" name="submit_upload" value="Submit" class="gray-trans"></submit>
            </div>

        </div>
      </form>
  </div>

</div>