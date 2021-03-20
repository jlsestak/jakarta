<?php

class Controller
{
    private $_f3;
    private $_user;

    function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_user = new Users("","","","","");
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
        global $dataLayer;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $dogToy = $_POST['dogtoy'];

            $product = new Products();

            if(isset($dogToy))
            {
                $product->setProductId($dogToy);

                $_SESSION['product'] = $product;
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

        $productType = $datalayer->getProduct($_SESSION['product']);
        $this->_f3->set('productType', $productType);



       // echo $product;
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
        global $datalayer;
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            //Save first name to session if valid
            if ($validator->validName($fname)) {
                $_SESSION['fname'] = $_POST['fname'];
            }
            else if($fname ==""){
                $this->_f3->set('errors["fname"]', "First Name cannot be blank");
            }
            else {
                $this->_f3->set('errors["fname"]', "First Name must contain only alphabetic characters");
            }

            //Save last name to session if valid
            if ($validator->validName($lname)) {
                $_SESSION['lname'] = $_POST['lname'];
            }
            else if($lname == ""){

                $this->_f3->set('errors["lname"]', "Last Name cannot be blank");
            }
            else {
                $this->_f3->set('errors["lname"]', "Last name must contain only alphabetic characters");
            }

            //save email to session
            if ($validator->validEmail($email)) {
                $_SESSION['email'] = $email;
            } else if ($email == "") {
                $this->_f3->set('errors["email"]', "Email cannot be blank");
            } else {
                $this->_f3->set('errors["email"]', "Please give a valid email");
            }
            //save username to session
            if ($validator->validUserName($username) && $validator->checkUserInUse($username)) {
                $_SESSION['username'] = $username;
            } else if ($username == "") {
                $this->_f3->set('errors["username"]', "Username cannot be blank");
            } else if(!$validator->validUserName($username)) {
                $this->_f3->set('errors["username"]', "Please enter a valid username.");
            } else {
                $this->_f3->set('errors["username"]', "This username has already been chosen please choose another.");
            }
            //save password to session

            if ($validator->validPassword($email)) {
                $_SESSION['email'] = $_POST['email'];
            } else if ($email == "") {
                $this->_f3->set('errors["email"]', "Email cannot be blank");
            } else {
                $this->_f3->set('errors["email"]', "Please give a valid email");
            }

            if(empty($this->_f3->get('errors'))) {
                $this->_user = new Users($fname, $lname, $email,$username,$password);
                $_SESSION['user'] = $this->_user;
                $datalayer->insertUsers();
                $this->_f3->reroute('login');
            }



        }

        $this->_f3->set('userFName', isset($fname) ? $fname : "");
        $this->_f3->set('userLName', isset($lname) ? $lname : "");
        $this->_f3->set('userEmail', isset($email) ? $email : "");
        $this->_f3->set('userUserName', isset($username) ? $username : "");
        $this->_f3->set('userPassword', isset($password) ? $password : "");

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
