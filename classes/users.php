<?php

class Users
{
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_userName;
    private $_passWord;

    /**
     * Users constructor.
     * @param $_firstName
     * @param $_lastName
     * @param $_email
     * @param $_userName
     * @param $_passWord
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
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->_userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->_userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->_passWord;
    }

    /**
     * @param mixed $passWord
     */
    public function setPassWord($passWord)
    {
        $this->_passWord = $passWord;
    }
}
