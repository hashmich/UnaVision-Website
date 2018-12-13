<?php require_once '..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'bootstrap.php'; ?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $Request->title; ?></title>

        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width,shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800"
              rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Router::asset('css/styles.css'); ?>">
        <link rel="stylesheet" type="text/safari" href="<?php echo Router::asset('css/safari.css'); ?>">

        <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css" rel="stylesheet">
	</head>
	<body>

        <div id="container" class="theme-<?php echo $Request->getTheme(); ?>">

            <?php require 'content'.DS.'menu.php'; ?>
			

			<div id="content">
                <?php //require $content_path; ?>
                <?php echo $Request->getLanguageContent(); ?>
			</div>
			
			<div id="footer">
                <div class="slogan">
                    <a href="<?php echo Router::url('participate'); ?>">
                        <?php
                        if($Request->getUserLanguage() == 'de') echo 'Visionär*innen gesucht!';
                        else echo 'Visionaries wanted!'
                        ?>
                    </a>
                    <hr>
                </div>

                <hr>

                <ul>
                    <li>&copy; <?php echo date("Y"); ?></li>
                    <li><a href="<?php echo Router::url('imprint'); ?>">Impressum</a></li>
                    <li><a href="<?php echo Router::url('privacy'); ?>">Datenschutz</a></li>
                    <li class="language">
                        Languages:
                        <span class="lang-select<?php if($lang == 'en') echo ' active'; ?>" value="en">EN</span> /
                        <span class="lang-select<?php if($lang == 'de') echo ' active'; ?>" value="de">DE</span>
                    </li>
                </ul>

                <div class="address">
                    <p>ThinkCamp gem. eG.</p>
                    <p>Herzershof 10</p>
                    <p>15328 Küstriner Vorland</p>
                    <p>Germany</p>
                </div>

                <div class="thinkcamp">
                    <a href="https://www.thinkcamp.eu" target="_blank">
                            <img alt="ThinkCamp"
                                    src="<?php echo Router::asset('img/logos/thinkcamp_black.png'); ?>">
                    </a>
                    <p>Innovation for Sustainability</p>
                </div>



                <hr>

			</div>
			
		</div>

        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <script type="text/javascript">
            window.jQuery || document.write('<script type="text/javascript" src="<?php echo Router::asset('js/jquery-3.3.1.min.js'); ?>"><\/script>');
        </script>
        <script type="text/javascript" src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js"></script>
        <script id="scripts" type="text/javascript" src="<?php echo Router::asset('js/scripts.js'); ?>"></script>
	</body>
</html>
