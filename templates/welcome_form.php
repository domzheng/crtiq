<body onload="popup('popUpDiv')">
    <script type="text/javascript" src="js/jquery.imagefit.js"></script>
    <script type="text/javascript" src="js/csspopup.js"></script>
    <link rel="stylesheet" href="css/superslides.css"/>
    <link rel="stylesheet" href="css/stylesheet.css"/>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.animate-enhanced.min.js"></script>
    <script src="js/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    
    <div id="slides">
        <div class="slides-container">
            <a <?= print("href='critique.php?image_id=" . $randomimgurl[0]["id"] . "'") ?> > <img src= '<?=htmlspecialchars($randomimgurl[0]["url"])?>' ></a>
            <a <?= print("href='critique.php?image_id=" . $randomimgurl[1]["id"] . "'") ?> > <img src= '<?=htmlspecialchars($randomimgurl[1]["url"])?>' width="1024" height="682"></a>
            <a <?= print("href='critique.php?image_id=" . $randomimgurl[2]["id"] . "'") ?> > <img src= '<?=htmlspecialchars($randomimgurl[2]["url"])?>' width="1024" height="683"></a>
        </div>

    <nav class="slides-navigation">
      <a href="#" class="next">
        <i class="icon-chevron-right"></i>
      </a>
      <a href="#" class="prev">
        <i class="icon-chevron-left"></i>
      </a>
    </nav>
    </div>

    <div id="blanket" style="display:none"></div>
    <div id="popUpDiv" style="display:none">
        <h1>Welcome!</h1>
        <h2>Please submit a critique <br> to access your profile.</h2>s
        <a href="#" onclick="popup('popUpDiv')"><img src="img/gotitbutton.png" /></a>
    </div>

    <script>
    $('#slides').superslides({
      animation: 'fade'
    });
    </script>
    <img class="welcomedescrip" style="display:none" src="http://www.crtiq.com/img/welcomedescrip.png">
    <div id="container">
   <!-- === === === === === HEADER === === === === === -->
    <div id="header">
        <a href="home.php" title="Back to Home"><div class="logo-nav"></div></a>
        
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