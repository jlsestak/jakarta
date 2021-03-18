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

    // Display Cat Page
    function cat()
    {
        $view = new Template();
        echo $view->render('views/cat.html');
    }

    // Display Dog Page
    function dog()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dogToy = $_POST['dogtoy'];

            if(isset($dogToy))
            {
                $_SESSION['product'] = $dogToy;
                $this->_f3->reroute('/product');
            }
        }

        $view = new Template();
        echo $view->render('views/dog.html');
    }

    // Display Product Page
    function product()
    {
        global $datalayer;
        $products = $_SESSION['product'];

        $product = $datalayer->getProduct($products);
        $this->_f3->set('product', $product);

        //Display a view
        $view = new Template();
        echo $view->render('views/product.html');
    }
    // Display About Page
    function about()
    {
        $view = new Template();
        echo $view->render('views/about.html');
    }

    // Display Contact Page
    function contact()
    {
        $view = new Template();
        echo $view->render('views/contact.html');
    }

    // Display Login Page
    function login()
    {
        $view = new Template();
        echo $view->render('views/login.html');
    }

    // Display Registration Page
    function register()
    {
        $view = new Template();
        echo $view->render('views/register.html');
    }


    // Display Cart Page
    function cart()
    {
        $view = new Template();
        echo $view->render('views/cart.html');
    }

}
