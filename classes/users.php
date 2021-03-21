<?php

/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * classes/users.php
 * Users class stores the user information when they register
 **/
class Users
{
    //fields
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_userName;
    private $_passWord;

    /**
     * Users constructor.
     * @param $_firstName String
     * @param $_lastName String
     * @param $_email String
     * @param $_userName String
     * @param $_passWord String
     */
    public function __construct($_firstName, $_lastName, $_email, $_userName, $_passWord)
    {
        $this->_firstName = $_firstName;
        $this->_lastName = $_lastName;
        $this->_email = $_email;
        $this->_userName = $_userName;
        $this->_passWord = $_passWord;
    }

    /**
     * getFirstName gets the first name of the user
     * @return String
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * setFirstName sets the first name of the user
     * @param String $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * getLastName gets the last name of the user
     * @return String
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * setLastName sets the last name of the user
     * @param String $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * getEmail gets the email of the user
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * setEmail sets the email of the user
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * getUserName gets the username from the user
     * @return String
     */
    public function getUserName()
    {
        return $this->_userName;
    }

    /**
     * setUserName sets the username of the user
     * @param String $userName
     */
    public function setUserName($userName)
    {
        $this->_userName = $userName;
    }

    /**
     * getPassWord gets the password of the user
     * @return String
     */
    public function getPassWord()
    {
        return $this->_passWord;
    }

    /**
     * setPassWord sets the password of the user
     * @param String $passWord
     */
    public function setPassWord($passWord)
    {
        $this->_passWord = $passWord;
    }
}
