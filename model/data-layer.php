<?php
/*
     CREATE TABLE primeusers (
        userid int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        fname varchar(20) NOT NULL,
        lname varchar(20) NOT NULL,
        email varchar(30) NOT NULL,
        username varchar(20) NOT NULL,
        password varchar(40) NOT NULL
    );

    INSERT INTO primeusers (fname, lname, email, username, password) VALUES
        ('Joe', 'Shmo', 'jshmo@gmail.com', 'jshmo', sha1('shmo123')),
        ('John', 'Doe', 'johndoe@gmail.com', 'jdoe', sha1('doe456'));

 */
/*
CREATE TABLE product (
    productid varchar(20) NOT NULL PRIMARY KEY,
        description varchar(100) NOT NULL,
        price decimal(6,2) NOT NULL,
        image1 varchar(30) NOT NULL,
        image2 varchar(30) NOT NULL
    );

*/
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