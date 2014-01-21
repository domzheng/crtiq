<body>
 <script>
    $.backstretch([
      "img/background/DSC_5655_bracketed.jpg",
      "img/background/antelope_canyon_cropped.jpg",
      "img/background/DSC_0091_cropped.jpg",
      "img/background/dunster_sunrise_over_the_charles_cropped.jpg",
      "img/background/sleeping_parents_cropped.jpg",
      "img/background/wanderer_above_lake_powell_cropped.jpg"
          //NOTE: The last element has NO comma
      ], {
        fade: 2000,      //Speed of Fade
        duration: 15000  //Time of image display
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
    <div class="display">
        <div class="image_container">
            <img src= '<?=htmlspecialchars($image_data["url"])?>'>
        </div>
        <div class="image_label">
            <h1> <?=htmlspecialchars($image_data["title"])?> </h1>
            <h2> by <?=htmlspecialchars($artist_data["fullname"])?> </h2>
            <h3> <?=htmlspecialchars($image_data["date"])?> </h3>
        </div>
    </div>
    <div class="data">
        <?php if (!isset($quality)): ?>
            <div class="description">
                <h1>DESCRIPTION</h1>
                <div class="scrollbox"><p><?=print($image_data["description"]);?></p></div>
            </div>
            <hr size=".1px" width="90%" align="center">

            <div class="shot-details">
                <h1>SHOT DETAILS</h1>
                <table class="metadata">
                    <?php if (!empty($image_data["camera"])): ?>
                    <tr>
                        <td class="data-title">CAMERA &nbsp</td>
                        <td><?=htmlspecialchars($image_data["camera"])?></td>
                    </tr>
                    <?php endif ?>
                    <?php if (!empty($image_data["lens"])): ?>
                    <tr>
                        <td class="data-title">LENS &nbsp</td>
                        <td><?=htmlspecialchars($image_data["lens"])?></td>
                    </tr>
                    <?php endif ?>
                    <?php if (!empty($image_data["aperture"])): ?>
                    <tr>
                        <td class="data-title">APERTURE &nbsp</td>
                        <td><?=htmlspecialchars($image_data["aperture"])?></td>
                    </tr>
                    <?php endif ?>
                    <?php if (!empty($image_data["shutter"])): ?>
                    <tr>
                        <td class="data-title">SHUTTER &nbsp</td>
                        <td><?=htmlspecialchars($image_data["shutter"])?></td>
                    </tr>
                    <?php endif ?>
                    <?php if (!empty($image_data["iso"])): ?>
                    <tr>
                        <td class="data-title">ISO &nbsp</td>
                        <td><?=htmlspecialchars($image_data["iso"])?></td>
                    </tr>
                    <?php endif ?>
                    <?php if (!empty($image_data["location"])): ?>
                    <tr>
                        <td class="data-title">LOCATION &nbsp</td>
                        <td><?=htmlspecialchars($image_data["location"])?></td>
                    </tr>
                    <?php endif ?>
                    <tr>
                        <td class="data-title">LIKES &nbsp</td>
                        <td><?=htmlspecialchars($image_data["likes"])?></td>
                    </tr>
                    <tr>
                        <td class="data-title">DISLIKES &nbsp</td>
                        <td><?=htmlspecialchars($image_data["dislikes"])?></td>
                    </tr>
                </table>
            </div>
            <hr size=".1px" width="90%" align="center">
            <div class="judgement">
                <h1>YOUR CRITIQUE</h1>
                <div class="thumbs up">
                    <a <?= print("href='critique.php?quality=1&image_id=" . $image_data["id"] . "'") ?> title="Good"><img src="img/thumbs_up.png"></a>
                </div>
                <div class="thumbs">
                    <a <?= print("href='critique.php?quality=2&image_id=" . $image_data["id"] . "'") ?> title="Bad"><img src="img/thumbs_down.png"></a>
                </div>
            </div>
            <?php if (!empty($critiques)): ?>
                <hr size=".1px" width="90%" align="center">
                <div class="critique_display">
                    <h1>CRITIQUES</h1>
                    <?php
                        $counter = count($critiques) - 1;
                        foreach ($critiques as $critique)
                        {
                            print("<h2>{$critiques[$counter]["writer"]},</h2>");
                            print("<h3>&nbsp{$critiques[$counter]["date"]}</h3>");
                            print("<p>{$critiques[$counter]["text"]}</p>");   
                            $counter--;   
                        }             
                    ?>
                </div>
            <?php endif ?>
            <br><br><br><br><br><br>
        <?php else: ?>
            <form class="description" method="POST" action="critique.php">
                <?php if (isset($message)):?>
                    <br><br>
                    <p class='apology'> <?= htmlspecialchars($message) ?></p>
                <?php endif ?>
                <h1 class="critique-text-1">You gave this photograph a</h1>
                <div class="thumbs writing">
                <?php if ($quality == 1):?>
                    <img src="img/thumbs_up.png"></div>
                <?php else: ?>
                    <img src="img/thumbs_down.png"></div>
                <?php endif ?>
                <h1 class="critique-text-5">Why? Please respond thoughtfully.</h1>
                <input type="hidden" name="image_id" value= <?=htmlspecialchars($image_data["id"])?> >
                <input type="hidden" name="quality" value= <?=htmlspecialchars($quality)?> >
                <textarea class="critique-text" name= "critique-text"></textarea>
                <input type="submit" name="critique" value="Submit Critique" class="gray-trans critique-text-button"></submit>
            </form>
        <?php endif ?>
    </div>

</div>
</body>

</html>