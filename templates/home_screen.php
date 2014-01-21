<div class="darkener"></div>
 <script>
    $.backstretch([
        <?php
            print ("'{$backgroundimage}'");
        ?>
      ], {
        fade: 2500,      //Speed of Fade
        duration: 5000  //Time of image display
    });
 </script>

<div id="container">

    <!-- === === === === === WELCOME === === === === === -->
    <div id="welcome">
        <h4><img src="http://www.crtiq.com/img/crtiq_logo_welcome.png" alt="crtIQ"></h4>
        <h1>You take shots.</h1>
        <h2>We'll take notes.</h2>
        <a href="login.php"><div class="input-container choose-button"><p>Login</p></div></a>
        <a href="signup.php"><div class="input-container choose-button"><p>Sign Up</p></div></a>
        <!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->
    </div>

</div>
</body>

</html>