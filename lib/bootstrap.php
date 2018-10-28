<?php
define('DS', DIRECTORY_SEPARATOR);

set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

$accept_languages = array('de','en');
$default_lang = 'en';
// determine the user language, use default if not accepted language
$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$language = in_array($browser_lang, $accept_languages) ? $browser_lang : $default_lang;

if(!empty($_COOKIE['language']) AND in_array($_COOKIE['language'], $accept_languages)) {
    $language = $_COOKIE['language'];
}


function debug($msg = null) {
    $trace = debug_backtrace();
    echo $trace[0]['file'].', LINE '.$trace[0]['line'];
    echo '<pre>';
    print_r($msg);
    echo '</pre>';
    exit;
}

$request = 'vision';
$title = 'UnaVision';
$crumbs = array();
$content_path = 'content'.DS.$language.DS.$request.'.php';

// go for the query parameter defined in .htaccess
if(!empty($_GET['q'])) {
    $string = rtrim($_GET['q'], '/');
    $expl = explode('/', $string);
    $request = implode(DS, $expl);
    foreach($expl as $part) {
        $crumbs[$part] = ucfirst(str_replace(array('_','-'), ' ', $part));
    }
    $title = ucfirst(str_replace(array('_','-'), ' ', end($expl)));
    $content_path = 'content'.DS.$language.DS.$request.'.php';
}

// check availability of the file in preferred language, use available language if not
if(!file_exists('..'.DS.'webroot'.DS.$content_path)) {
    foreach($accept_languages as $al) {
        $content_path = 'content'.DS.$al.DS.$request.'.php';
        if(file_exists('..'.DS.'webroot'.DS.$content_path)) {
            $language = $al;
            break;
        }
    }
}

// render error page if no file exists
if(!file_exists($content_path)) {
    $content_path = 'content'.DS.'error.php';
    $title = 'Error';
}


// instantiate the Router
require_once '..'.DS.'lib'.DS.'Router.php';
?>