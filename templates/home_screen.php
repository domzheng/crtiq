<div id="darkener">
  <img src="img/blackradialbg.png" alt="">
</div>

 <script>
    $.backstretch([
        <?php
            print ("'{$backgroundimage[0]}'");
        ?>
      ], {
        fade: 2500,      //Speed of Fade
        duration: 5000  //Time of image display
    });
 </script>

<div id="container">

    <!-- <div id="welcome">
        <h4><img src="http://www.crtiq.com/img/crtiq_logo_welcome.png" alt="crtIQ"></h4>
        <h1>You take shots.</h1>
        <h2>We'll take notes.</h2>
        <a href="login.php"><div class="input-container choose-button"><p>Login</p></div></a>
        <a href="signup.php"><div class="input-container choose-button"><p>Sign Up</p></div></a>
    </div> -->

    <div id="login">
        <h4><img src="img/crtiq_logo_v2.png" alt="crtIQ"></h4>
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
    </div>

    <div id="fpcredits">
        <?php
            print("<img src=\"{$backgroundimage[3]}\" alt=\"\">");
        ?>
        <div class="fptitle">
          <?php
            print("<a href=\"critique.php?image_id={$backgroundimage[4]}\"><h1>{$backgroundimage[1]}</h1></a>");
            print("<h2>{$backgroundimage[2]}</h2>");
          ?>
        </div>
    </div>

</div>

</div>
</body>

</html>