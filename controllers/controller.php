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
}
