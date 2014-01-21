<div class="darkener"></div>
 <script>
    $.backstretch([
      "http://www.crtiq.com/img/background/DSC_5655_bracketed.jpg",
      "http://www.crtiq.com/img/background/wanderer_above_lake_powell_cropped.jpg",
      "http://www.crtiq.com/img/background/dunster_sunrise_over_the_charles_cropped.jpg",
      "http://www.crtiq.com/img/background/sleeping_parents_cropped.jpg",
      "http://www.crtiq.com/img/background/antelope_canyon_cropped.jpg",
      "http://www.crtiq.com/img/background/DSC_0091_cropped.jpg"
          //NOTE: The last element has NO comma
      ], {
        fade: 2500,      //Speed of Fade
        duration: 5000  //Time of image display
    });
 </script>

<div id="container">
  <div id="login">
    <h4><img src="http://www.crtiq.com/img/crtiq_logo_welcome.png" alt="crtIQ"></h4>
    <p class="apology"><?= htmlspecialchars($message) ?></p>
    <p class="apology"><a href="javascript:history.go(-1);">Back</a></p>
  </div>
</div>