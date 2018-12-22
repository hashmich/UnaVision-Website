<?php

function debug($msg = null) {
    $trace = debug_backtrace();
    echo $trace[0]['file'].', LINE '.$trace[0]['line'];
    echo '<pre>';
    print_r($msg);
    echo '</pre>';
    exit;
}

define('DS', DIRECTORY_SEPARATOR);

session_start();

set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

require_once 'Request.php';
$Request = new Request();

// instantiate the Router
require_once 'Router.php';



?>