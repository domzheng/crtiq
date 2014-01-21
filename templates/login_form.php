<body>
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

    <!-- === === === === === WELCOME === === === === === -->
    <div id="login">
        <h4><img src="http://www.crtiq.com/img/crtiq_logo_welcome.png" alt="crtIQ"></h4>
        <?php if (isset($message)):?>
            <p class='apology'> <?= htmlspecialchars($message) ?></p>
        <?php endif ?>
        <form class="login-input" action="login.php" method="post">
            <div class="input-container login-username">
              <input type="text" name="username" placeholder="Username" class="white-trans"></input>
            </div>
            <div class="input-container login-password">
              <input type="password" name="password" placeholder="Password" class = "white-trans"></input>
            </div>
            <div class="input-container submit-button">
              <input type="submit" name="submit_login" value="Login" class="gray-trans"></submit>
            </div>
            <h1>or <a href="signup.php">sign up!</a></h1>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</div>