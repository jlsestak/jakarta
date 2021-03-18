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
    private $_dbh;

    /**
     * DataLayer constructor.
     * @param $dbh
     */
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * insertMember inserts the members information into the database
     */
    /*
    function insertMember()
    {
        //get the member information
        $member = $_SESSION['memberRank'];

        //Define the query
        $sql = "INSERT INTO primeusers (fname, lname, email, username, password) 
	            VALUES (:fname, :lname, :age, :gender , :phone , :email ,:states ,:seeking ,:bio,:premium, :interests)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //check to see if a premiumMember and set the interests and the premiumCheck accordingly
        if ($_SESSION['premiumMember']) {
            $interests = $member->getIndoorInterests() . ", " . $member->getOutdoorInterests();
            $premiumCheck = 1;
        } else {
            $interests = "";
            $premiumCheck = 0;
        }

        //Bind the parameters
        $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':states', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        $statement->bindParam(':premium', $premiumCheck, PDO::PARAM_INT);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        //Execute
        $statement->execute();

    }
    */


    /**
     * getMember($member_id) gets a single member from the database using their member id
     * @param $member_id
     * @return associative array
     */
    function getProduct($productid)
    {
        //Define the query
        $sql = "SELECT * FROM product WHERE productid = $productid";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
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