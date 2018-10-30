<?php require_once '..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'bootstrap.php'; ?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $Request->title; ?></title>
		<link rel="stylesheet" href="<?php echo Router::asset('css/styles.css'); ?>">


	</head>
	<body>

        <div id="container" class="theme-<?php echo $Request->getTheme(); ?>">

            <?php require 'content'.DS.'menu.php'; ?>
			

			<div id="content">
                <?php //require $content_path; ?>
                <?php echo $Request->getLanguageContent(); ?>
			</div>
			
			<div id="footer">
				<p>
                    &copy; 2018 by UnaVision |
                    <a href="<?php echo Router::url('imprint'); ?>">Impressum</a> |
                    <a href="<?php echo Router::url('privacy'); ?>">Datenschutz</a>
                </p>
			</div>
			
		</div>

        <script
                src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
                crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo Router::asset('js/scripts.js'); ?>"></script>
	</body>
</html>
