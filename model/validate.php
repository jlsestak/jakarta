<?php
/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * model/validate.php
 * Contains validation for User Registration form
 **/

class Validate
{
    private $_dataLayer;

    function __construct($_dataLayer)
    {
        $this->_dataLayer = $_dataLayer;
    }

    /**
     * validName() Checks to see if user's names are alphabetic and are not empty
     * @param String $name
     * @return bool
     */
    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);

    }

    /**
     * validEmail() Checks to see if the user has a valid email
     * @param String $email
     * @return bool
     */
    function validEmail($email)
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * validUserName checks to see if a valid username is input
     * @param $username takes in username String
     * @return boolean
     */
    function validUserName($username)
    {
        return !empty($username) && ctype_alpha($username);
    }

    /**
     * Checks to see if the username is already in use
     * @param $username String
     * @return boolean
     */
    function checkUserInUse($username)
    {
        global $database;

        return $database->checkUserName($username);
    }

    /**
     * Checks to see if user puts in a valid password
     * @param $password String
     * @return bool
     */
    function validPassword($password)
    {
        return !empty($password) && strlen($password) >= '8'
            && preg_match("#[0-9]+#",$password)
            && preg_match("#[A-Z]+#",$password)
            && preg_match("#[a-z]+#",$password);
    }


}