<?php

/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * model/validate.php
 * Routes the user across the website
 **/
class Controller
{
    //fields
    private $_f3;
    private $_user;

    /**
     * Controller constructor.
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_user = new Users("", "", "", "", "");
    }

    /**
     * Display home page
     */
    function home()
    {
        //render home view
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Displays dog page and saves dog toy user picks
     */
    function dog()
    {
        //stores the page for the user
        $_SESSION['page'] = 'dog';

        //if posted save the toy to a variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dogToy = $_POST['dogtoy'];

            //check to see if a dog toy was selected
            if (isset($dogToy)) {

                //save the dog toy to a session
                $_SESSION['productSession'] = $dogToy;

                //reroute to the product page
                $this->_f3->reroute('/product');
            }
        }

        //render the dog view
        $view = new Template();
        echo $view->render('views/dog.html');
    }

    /**
     * Displays cat page and saves cat toy user picks
     */
    function cat()
    {
        //stores the page for the user
        $_SESSION['page'] = 'cat';

        //if posted save the toy to a variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $catToy = $_POST['cattoy'];

            //save the cat toy to a session and reroute to product
            if (isset($catToy)) {
                $_SESSION['productSession'] = $catToy;
                $this->_f3->reroute('/product');
            }
        }

        //renders cat view
        $view = new Template();
        echo $view->render('views/cat.html');
    }

    /**
     * Displays the product the user has picked from
     * grabbing the information from the product from the database
     * and displaying it on the page.
     */
    function product()
    {
        global $database;

        //get the product information from the database
        $database->getProduct($_SESSION['productSession']);

        //if submitted save the quantity to a variable
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quantity = $_POST['quantity'];

            //if quantity is set save to a session and reroute to the cart page
            if (isset($quantity)) {
                $_SESSION['quantity'] = $quantity;
                $this->_f3->reroute('/cart');
            }
        }

        //Display product view
        $view = new Template();
        echo $view->render('views/product.html');

    }

    /**
     * displays the cart page and saves the user's purchase in
     * the database
     */
    function cart()
    {
        global $database;

        //if submitted check to see if the user was logged in and save their purchases to the database
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_SESSION['currentUser']) {
                $database->storePurchases($_SESSION['productSession']);
            }
                //reroute to summary page
                $this->_f3->reroute('/summary');
        }

        //render the cart view
        $view = new Template();
        echo $view->render('views/cart.html');
    }

    /**
     * summary page displays the user's purchase
     */
    function summary()
    {
        //render the summary view
        $view = new Template();
        echo $view->render('views/summary.html');
    }


    /**
     * routes to the login page and stores
     * the grabs the user's information from the database to
     * store to a session then routes the user to their previous page or
     * the home page
     */
    function login()
    {
        global $database;
        global $validator;

        //if submitted validate the username and password
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['usernames'];
            $password = $_POST['passwords'];

            //check the credentials checks that username and password are in the database
            if ($database->checkCredentials($username, $password) && $username != "") {

                //reroutes to the appropriate page if logged in
                if (isset($_SESSION['page'])) {
                    $this->_f3->reroute($_SESSION['page']);
                } else {
                    $this->_f3->reroute('../jakarta');
                }
            }
            //checks if the username is blank
            else if ($username == "") {
                $this->_f3->set('errors["usernameCheck"]', "Please put in your username");
            }
            //checks if the password is blank
            else if ($password == "") {
                $this->_f3->set('errors["passNameCheck"]', "Please put in your password");
            }
            //checks if the username is not in the database
            else if ($validator->checkUserInUse($username)) {
                $this->_f3->set('errors["usernameCheck"]', "This username does not exist");
            }
            //username and/or password is invalid
            else {
                $this->_f3->set('errors["passNameCheck"]', "Please put in a correct username and password");
            }
        }

        //renders login view
        $view = new Template();
        echo $view->render('views/login.html');
    }

    /**
     * logout logs the user out and re-routes to home page
     */
    function logout()
    {
        session_destroy();
        $_SESSION = array();
        $this->_f3->reroute('../jakarta');
    }

    /**
     * register creates a new user storing their information
     * to a database and then re-routing them to the login page
     */
    function register()
    {
        global $database;
        global $datalayer;
        global $validator;

        //if posted validate the submission before storing in the database and re-routing
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //save submissions
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPass = $_POST['confirmPass'];

            //save first name to a session if valid
            if ($validator->validName($fname)) {
                $_SESSION['fname'] = $_POST['fname'];
            }
            //check if firstname is blank
            else if ($fname == "") {
                $this->_f3->set('errors["fname"]', "First Name cannot be blank");
            }
            //checks if firstname is invalid
            else {
                $this->_f3->set('errors["fname"]', "First Name must contain only alphabetic characters");
            }

            //Save last name to session if valid
            if ($validator->validName($lname)) {
                $_SESSION['lname'] = $_POST['lname'];
            }
            //checks if last name is blank
            else if ($lname == "") {
                $this->_f3->set('errors["lname"]', "Last Name cannot be blank");
            }
            //checks if last name is valid
            else {
                $this->_f3->set('errors["lname"]', "Last name must contain only alphabetic characters");
            }

            //save email to a session if valid
            if ($validator->validEmail($email)) {
                $_SESSION['email'] = $email;
            }
            //checks if email is blank
            else if ($email == "") {
                $this->_f3->set('errors["email"]', "Email cannot be blank");
            }
            //checks if email is valid
            else {
                $this->_f3->set('errors["email"]', "Please give a valid email");
            }

            //save username to session if valid
            if ($validator->validUserName($username) && $validator->checkUserInUse($username)) {
                $_SESSION['username'] = $username;
            }
            //checks if username is blank
            else if ($username == "") {
                $this->_f3->set('errors["username"]', "Username cannot be blank");
            }
            //check if username already exists in the database
            else if (!$validator->validUserName($username)) {
                $this->_f3->set('errors["username"]', "Please enter a valid username.");
            }
            //checks if username is valid
            else {
                $this->_f3->set('errors["username"]', "This username has already been chosen please choose another.");
            }

            //save password to session if valid
            if ($validator->validPassword($password) && $password == $confirmPass) {
                $_SESSION['password'] = $password;
            }
            //checks if password is blank
            else if ($password == "") {
                $this->_f3->set('errors["password"]', "Password cannot be blank");
            }
            //checks if password is valid
            else if (!$validator->validPassword($password)) {
                $this->_f3->set('errors["password"]', "Password must be valid");
            }
            //checks if the confirm password is blank
            else if ($confirmPass == "") {
                $this->_f3->set('errors["passCheck"]', "Password confirm your password");
            }
           //checks if password is the same as confirm password
            else if ($confirmPass != $password) {
                $this->_f3->set('errors["passCheck"]', "Your password does not match");
            }
            //checks for invalid password
            else {
                $this->_f3->set('errors["password"]', "Please give a valid password");
            }

            //if there are no errors store the new users information in the database and reroute to login
            if (empty($this->_f3->get('errors'))) {
                $this->_user = new Users($fname, $lname, $email, $username, $password);
                $_SESSION['user'] = $this->_user;
                $database->insertUsers();
                $this->_f3->reroute('login');
            }
        }

        //make the register form sticky
        $this->_f3->set('userFName', isset($fname) ? $fname : "");
        $this->_f3->set('userLName', isset($lname) ? $lname : "");
        $this->_f3->set('userEmail', isset($email) ? $email : "");
        $this->_f3->set('userUserName', isset($username) ? $username : "");
        $this->_f3->set('userPassword', isset($password) ? $password : "");

        //render the register view
        $view = new Template();
        echo $view->render('views/register.html');
    }

    /**
     * admin page displays the member's purchase from the database
     */
    function admin()
    {
        global $database;

        //get the purchases from the database
        $purchases = $database->getUserPurchase();
        $this->_f3->set('purchases', $purchases);

        //render admin view
        $view = new Template();
        echo $view->render('views/admin.html');
    }

}
