<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="CrtIQ - Intelligent Feedback"/>
    <meta name="apple-mobile-web-app-title" content="#">  <!-- this changes the default name when on the homescreen in apple-->

    <?php if (isset($title)): ?>
            <title>CrtIQ: <?= htmlspecialchars($title) ?></title>
    <?php else: ?>
            <title>CrtIQ: Intelligent Photography</title>
    <?php endif ?>

    <link rel="shortcut icon" href="http://www.crtiq.com/img/favicon.png"> <!-- this is the small photo in the tab -->
    <link rel="apple-touch-icon" href="#.png" />  <!-- this uploads the icon for apple's homescreen shortcuts-->

    <link href="css/bootstrap.css" rel="stylesheet"/> <!-- if folder /css folder is in the same spot as the html file-->
    <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.css" rel="stylesheet"/>
    <link href="css/stylesheet.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/jquery.backstretch.js"></script>
</head>
