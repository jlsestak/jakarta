<?php

class DataLayer
{
    /**
     * insertUsers inserts the members information into the database
     */

    function insertUsers()
    {
        //get the member information
        $user = $_SESSION['user'];

        //Define the query
        $sql = "INSERT INTO primeusers (fname, lname, email, username, password)
	            VALUES (:fname, :lname, :email, :username , :password)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);


        //Bind the parameters

        $statement->bindParam(':fname', $user->getFirstName(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $user->getLastName(), PDO::PARAM_STR);
        $statement->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':username', $user->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(':password', $user->getPassWord(), PDO::PARAM_STR);


        //Execute
        $statement->execute();

    }


    /**
     * checkUserName checks the database if a username has already been taken
     * @param $username String
     * @return boolean
     */
    function checkUserName($username){

        return true;
    }

    /**
     * getInterests($member_id) gets the interests from the member based on their member id
     * @param $member_id
     * @return associative array
     */
    /*
    function getInterests($member_id)
    {
        //Define the query
        $sql = "SELECT interests FROM member WHERE member_id = $member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    */

}