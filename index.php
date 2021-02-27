<?php

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

// Start a session
session_start();

//Create an instance of the Base class
$f3 = Base::instance();
//$validator = new Validate();
//$dataLayer = new DataLayer();
$controller = new Controller($f3);

// Classes
//$products = new Products();
//$users = new Users();

// Fatfree error reporting
$f3->set('DEBUG', 3);

// Define a default route
$f3->route('GET /', function() {

    global $controller;
    $controller->home();
});

// Define a product route
$f3->route('GET|POST /product', function ($f3){
   global $controller;
   $controller->product();
});


// Define a cat page route
$f3->route('GET|POST /cat', function ($f3){
    global $controller;
    $controller->cat();
});

// Define a dog page route
$f3->route('GET|POST /dog', function ($f3){
    global $controller;
    $controller->dog();
});

// Define a cart page route
$f3->route('GET|POST /cart', function ($f3){
    global $controller;
    $controller->cart();
});









//Run fat free
$f3->run();