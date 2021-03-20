<?php

class DataLayer
{
    /**
     * insertUsers inserts the members information into the database
     */




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