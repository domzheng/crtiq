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

<body>
<div id="container">

    <!-- === === === === === SIGNUP === === === === === -->
    <div id="login">
        <h4><img src="http://www.crtiq.com/img/crtiq_logo_welcome.png" alt="crtIQ"></h4>
        <?php if (isset($message)):?>
            <p class='apology'> <?= htmlspecialchars($message) ?></p>
        <?php endif ?>
        <form class="login-input" method="post" action="signup.php">

            <div class="input-container login-username">
              <input type="text" name="username" 
              <?php if (!empty($feedback[0]["username"])):?>
                value=<?=htmlspecialchars($feedback[0]["username"])?>
              <?php endif ?>
              placeholder="Username" class="white-trans"></input>
            </div>
            <div class="input-container login-password">
              <input type="text" name="fullname" 
              <?php if (!empty($feedback[0]["fullname"])):?>
                value=<?=htmlspecialchars($feedback[0]["fullname"])?>
              <?php endif ?>
              placeholder="Full Name" class="white-trans"></input>
            </div>

            <div class="input-container login-username">
              <input type="text" name="email" 
              <?php if (!empty($feedback[0]["email"])):?>
                value=<?=htmlspecialchars($feedback[0]["email"])?>
              <?php endif ?>
              placeholder="Email" class="white-trans"></input>
            </div>
            <div class="input-container login-password">
              <input type="text" name="hometown" 
              <?php if (!empty($feedback[0]["hometown"])):?>
                value=<?=htmlspecialchars($feedback[0]["hometown"])?>
              <?php endif ?>
              placeholder="Hometown" class="white-trans"></input>
            </div>

            <div class="input-container login-username">
              <input type="password" name="password" placeholder="Password" class="white-trans"></input>
            </div>
            <div class="input-container login-password">
              <input type="password" name="confirm_password" placeholder="Re: Password" class="white-trans"></input>
            </div>

            <div class="input-container submit-button">
              <input type="submit" name="submit_login" value="Sign Up" class="gray-trans">
            </div>

            <h1>or <a href="login.php">login!</a></h1>
            <br><br><br><br><br><br>
        </form>
    </div>
</div>

