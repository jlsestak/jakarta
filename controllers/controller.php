<?php

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    // Display Home Page
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    // Display Product Page
    function cat()
    {
        $view = new Template();
        echo $view->render('views/cat.html');
    }

    // Display Product Page
    function dog()
    {
        $view = new Template();
        echo $view->render('views/dog.html');
    }

    // Display Product Page
    function product()
    {
        $view = new Template();
        echo $view->render('views/product.html');
    }
    
    // Display Product Page
    function cart()
    {
        $view = new Template();
        echo $view->render('views/cart.html');
    }

}
