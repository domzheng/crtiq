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

    <!-- === === === === === WELCOME === === === === === -->
    <div class="cover">
        <div class="display">
            <div class="image_container">
                <div class="image_box" style="background-image:url('<?=htmlspecialchars($image_data["url"])?>');"></div>
                <div class="image_label">
                    <h1><?=htmlspecialchars($image_data["title"])?></h1>
                    <h2>by <?=htmlspecialchars($artist_data["fullname"])?></h2>
                    <h3><?=htmlspecialchars($image_data["date"])?></h3>
                </div>
            </div>
            <div class="data">
                <?php if (!isset($quality)): ?>
                    <div class="description">
                        <h1>DESCRIPTION</h1>
                        <div class="scrollbox"><p><?=htmlspecialchars($image_data["description"]);?></p></div>
                    </div>
                    <hr size=".1px" align="center">
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
                    <hr size=".1px" align="center">
                    <div class="judgement">
                        <h1>YOUR CRITIQUE</h1>
                        <a <?= print("href='critique.php?quality=1&image_id=" . $image_data["id"] . "'") ?> title="Good"><div class="thumbs up"></div></a>
                        <a <?= print("href='critique.php?quality=2&image_id=" . $image_data["id"] . "'") ?> title="Bad"><div class="thumbs down"></div></a>
                    </div>

                    <?php if (!empty($critiques)): ?>
                        <hr size=".1px" width="90%" align="center">
                        <div class="critique_display">
                            <h1>CRITIQUES</h1>
                            <?php
                                $counter = count($critiques) - 1;
                                $counter2 = 1;
                                foreach ($critiques as $critique)
                                {
                                    print("<div align='center'><strong>{$counter2}</strong></div><h2><strong>");
                                    print(htmlspecialchars($critiques[$counter]["writer"]));
                                    print("</strong>,</h2><h3>&nbsp written on &nbsp");
                                    print(htmlspecialchars($critiques[$counter]["date"]));
                                    print("</h3><div style='opacity: .8;'><p style='margin-bottom:0px; font-weight:bolder;'>Composition: &nbsp");
                                    print(htmlspecialchars($critiques[$counter]["compositionrating"]));
                                    print("</p><p>");
                                    print(htmlspecialchars($critiques[$counter]["compositioncomment"]));
                                    print("</p></div><div style='opacity: .8;'><p style='margin-bottom:0px; font-weight:bolder;'>Colors: &nbsp");
                                    print(htmlspecialchars($critiques[$counter]["colorsrating"]));
                                    print("</p><p>");
                                    print(htmlspecialchars($critiques[$counter]["colorscomment"]));
                                    print("</p></div><div style='opacity: .8;'><p style='margin-bottom:0px; font-weight:bolder;'>Editing: &nbsp");
                                    print(htmlspecialchars($critiques[$counter]["editingrating"]));
                                    print("</p><p>");
                                    print(htmlspecialchars($critiques[$counter]["editingcomment"]));
                                    print("</p></div><div style='opacity: .8;'><p style='margin-bottom:0px; font-weight:bolder;'>General Observations:</p><p>");
                                    print(htmlspecialchars($critiques[$counter]["text"]));
                                    print("</p></div><br>");
                                    $counter--;   
                                    $counter2++;
                                }             
                            ?>
                            <br><br><br>
                        </div>
                    <?php endif ?>
                <?php else: ?>
                <link href="dragdealer-master/lib/jasmine.css" type="text/css" rel="stylesheet">
                <link href="dragdealer-master/lib/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
                <script src="dragdealer-master/lib/jquery-1.10.2.js"></script>
                <script src="dragdealer-master/lib/jquery.simulate.js"></script>
                <script src="dragdealer-master/lib/jasmine.js"></script>
                <script src="dragdealer-master/lib/jasmine-html.js"></script>
                <script src="dragdealer-master/lib/jasmine-jquery.js"></script>
                <link href="dragdealer-master/src/dragdealer.css" type="text/css" rel="stylesheet">
                <script src="dragdealer-master/src/dragdealer.js"></script>
                <script src="dragdealer-master/spec/helpers.js"></script>
                <script src="dragdealer-master/spec/matchers.js"></script>
                <script src="dragdealer-master/spec/optionsSpec.js"></script>
                <script src="dragdealer-master/spec/draggingSpec.js"></script>
                <script src="dragdealer-master/spec/callbacksSpec.js"></script>
                <script src="dragdealer-master/spec/apiSpec.js"></script>
                <script src="dragdealer-master/spec/resizingSpec.js"></script>
                <script src="dragdealer-master/spec/eventsSpec.js"></script>
                <script src="dragdealer-master/spec/browser-runner.js"></script>
                <link href="dragdealer-master/demo/style/index.css" type="text/css" rel="stylesheet">
                <link href="dragdealer-master/demo/style/jasmine-reporter.css" type="text/css" rel="stylesheet">
                <script src="dragdealer-master/demo/script/index.js"></script>
                <form class="critique-submission" method="POST" action="critique.php">
                    <h1 class="critique-text-1">You gave this photograph a</h1>
                    <?php if ($quality == 1):?>
                        <div class="thumbswhy" style="background-image: url('img/thumbs-up.png');"></div>
                    <?php else: ?>
                        <div class="thumbswhy" style="background-image: url('img/thumbs-down.png');"></div>
                    <?php endif ?>
                    <h1 class="critique-text-5">Why? Please respond thoughtfully.</h1>
                    <?php if (isset($message)):?>
                        <p class='apology'> <?= htmlspecialchars($message) ?></p>
                    <?php endif ?>

                    <hr size=".1px" align="center">
                    <h1> Composition </h1>
                    <div class="sliderholder">
                        <div id="just-a-slider" class="dragdealer">
                            <div class="handle white-bar">
                                <span class="value"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="compositionslider" id="compositionslider" value="1">
                    <textarea class="critique-text" name="composition-text" maxlength="500" 
                    <?php if (!empty($post["composition-text"])):?>
                        value='<?=htmlspecialchars($user_info["composition-text"])?>'
                    <?php endif ?>
                    placeholder="Please rate and comment on the composition of this image. (Required)"></textarea><br>
                    <hr size=".1px" align="center">
                    <h1> Colors </h1>
                    <div class="sliderholder">
                        <div id="just-a-slider2" class="dragdealer">
                            <div class="handle white-bar">
                                <span class="value"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="colorsslider" id="colorsslider" value="1">
                    <textarea class="critique-text" name="colors-text" maxlength="500" 
                    <?php if (!empty($post["colors-text"])):?>
                        value='<?=htmlspecialchars($post["colors-text"])?>'
                    <?php endif ?>
                    placeholder="Please rate and comment on the colors of this image. (Required)"></textarea><br>
                    <hr size=".1px" align="center">
                    <h1> Editing </h1>
                    <div class="sliderholder">
                        <div id="just-a-slider3" class="dragdealer">
                            <div class="handle white-bar">
                                <span class="value"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="editingslider" id="editingslider" value="1">
                    <textarea class="critique-text" name="editing-text" maxlength="500" 
                    <?php if (!empty($post["editing-text"])):?>
                        value='<?=htmlspecialchars($post["editing-text"])?>'
                    <?php endif ?>
                    placeholder="Please rate and comment on the editing of this image. (Required)"></textarea><br>
                    <hr size=".1px" align="center">
                    <h1> Additional Comments </h1>
                    <textarea class="critique-text" name="critique-text" maxlength="500" 
                    <?php if (!empty($post["critique-text"])):?>
                        value='<?=htmlspecialchars($post["critique-text"])?>'
                    <?php endif ?>
                    placeholder="Please comment on the editing of this image."></textarea><br>
                    <input type="hidden" name="image_id" value= <?=htmlspecialchars($image_data["id"])?> >
                    <input type="hidden" name="quality" value= <?=htmlspecialchars($quality)?> >
                    <input type="submit" name="critique" value="Submit Critique" class="gray-trans critique-text-button">
                </form>
                    <br><br><br>
                <?php endif ?>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            new Dragdealer('just-a-slider', {
                animationCallback: function(x, y) {
                    $('#just-a-slider .value').text(Math.ceil((x * 9.8)+.1)+"/10");
                    document.getElementById("compositionslider").setAttribute("value",Math.ceil((x * 9.8)+.1));
                }
            })
            new Dragdealer('just-a-slider2', {
                animationCallback: function(x, y) {
                    $('#just-a-slider2 .value').text(Math.ceil((x * 9.8)+.1)+"/10");
                    document.getElementById("colorsslider").setAttribute("value",Math.ceil((x * 9.8)+.1));
                }
            })
            new Dragdealer('just-a-slider3', {
                animationCallback: function(x, y) {
                    $('#just-a-slider3 .value').text(Math.ceil((x * 9.8)+.1)+"/10");
                    document.getElementById("editingslider").setAttribute("value",Math.ceil((x * 9.8)+.1));
                }
            })
        });
    </script>
</div>
