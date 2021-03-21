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
        $_SESSION['page'] = 'home';
        $view = new Template();
        echo $view->render('views/home.html');
    }

    // Display Cat Page
    function cat()
    {
        $_SESSION['page'] = 'cat';
        $view = new Template();
        echo $view->render('views/cat.html');
    }

    // Display Dog Page
    function dog()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $dogToy = $_POST['dogtoy'];

            if(isset($dogToy))
            {
                $_SESSION['productSession'] = $dogToy;
                $this->_f3->reroute('/product');
            }
        }

        $view = new Template();
        echo $view->render('views/dog.html');
    }

    // Display Product Page
    function product()
    {
       echo "<pre>";
       var_dump($_SESSION);
       echo "</pre>";

        global $database;
        $database->getProduct($_SESSION['productSession']);

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $quantity = $_POST['quantity'];

            if(isset($quantity))
            {
                $_SESSION['quantity'] = $quantity;
                $this->_f3->reroute('/cart');
            }
        }

        //Display a view
        $view = new Template();
        echo $view->render('views/product.html');

        //session_destroy();
    }

    // Display Cart Page
    function cart()
    {
        echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";

        $view = new Template();
        echo $view->render('views/cart.html');
    }

    // Display About Page
    function about()
    {
        $_SESSION['page'] = 'about';
        $view = new Template();
        echo $view->render('views/about.html');
    }

    // Display Contact Page
    function contact()
    {
        $_SESSION['page'] = 'contact';
        $view = new Template();
        echo $view->render('views/contact.html');
    }

    // Display Login Page
    function login()
    {
        global $database;
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['usernames'];
            $password = $_POST['passwords'];
            if($database->checkCredentials($username, $password) && $username != "") {
                if(isset($_SESSION['page'])) {
                    $this->_f3->reroute($_SESSION['page']);
                } else {
                    $this->_f3->reroute('/home');
                }
            }
            else if($username == "") {
                $this->_f3->set('errors["usernameCheck"]', "Please put in your username");
            }
            else if($password == "") {
                $this->_f3->set('errors["passNameCheck"]', "Please put in your password");
            }
            else if($validator->checkUserInUse($username)) {
                $this->_f3->set('errors["usernameCheck"]', "This username does not exist");
            }
            else {
                $this->_f3->set('errors["passNameCheck"]', "Please put in a correct user and password");
            }
        }
        $view = new Template();
        echo $view->render('views/login.html');
    }

    // Display Registration Page
    function register()
    {
        global $database;
        global $datalayer;
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPass = $_POST['confirmPass'];
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

            if ($validator->validPassword($password) && $password == $confirmPass) {
                $_SESSION['password'] = $password;
            } else if ($password == "") {
                $this->_f3->set('errors["password"]', "Password cannot be blank");
            } else if ($validator->validPassword($password)) {
                $this->_f3->set('errors["password"]', "Password must be valid");
            }else if($confirmPass == "") {
                $this->_f3->set('errors["passCheck"]', "Password confirm your password");
            } else if($confirmPass != $password) {
                $this->_f3->set('errors["passCheck"]', "Your password does not match");
            } else {
                $this->_f3->set('errors["password"]', "Please give a valid password");
            }


            if(empty($this->_f3->get('errors'))) {
                $this->_user = new Users($fname, $lname, $email,$username,$password);
                $_SESSION['user'] = $this->_user;
                $database->insertUsers();
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

}
