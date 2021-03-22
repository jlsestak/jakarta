<?php

/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * index.php
 * index page routes to all of the pages
 **/
//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

// Connect to the database
require $_SERVER['DOCUMENT_ROOT'].'/../someFolder/config.php';

// Start a session
session_start();

//Create an instance of the Base class
$f3 = Base::instance();

$validator = new Validate();
$controller = new Controller($f3);
$database = new Database($dbh);

// Fatfree error reporting
$f3->set('DEBUG', 3);

// Define a default route
$f3->route('GET /', function() {
    global $controller;
    $controller->home();
});

// Define a cat page route
$f3->route('GET|POST /cat', function ($f3){
    global $controller;
    $controller->cat();
});

// Define a dog page route
$f3->route('GET|POST /dog', function (){
    global $controller;
    $controller->dog();
});

// Define a product route
$f3->route('GET|POST /product', function ($f3){
   global $controller;
   $controller->product();
});

// Define a login route
$f3->route('GET|POST /login', function ($f3){
    global $controller;
    $controller->login();
});

// Define a logout page route
$f3->route('GET /logout', function ($f3){
    global $controller;
    $controller->logout();
});

// Define a registration route
$f3->route('GET|POST /register', function ($f3){
    global $controller;
    $controller->register();
});

// Define a cart page route
$f3->route('GET|POST /cart', function ($f3){
    global $controller;
    $controller->cart();
});

// Define a summary route
$f3->route('GET /summary', function ($f3){
    global $controller;
    $controller->summary();
});

// Define a admin route
$f3->route('GET /admin', function ($f3){
    global $controller;
    $controller->admin();
});

//Run fat free
$f3->run();