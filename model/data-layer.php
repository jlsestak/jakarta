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
     * getMember($member_id) gets a single member from the database using their member id
     * @param $productid
     */
    function getProduct($productid)
    {
        //Define the query
        $sql = "SELECT * FROM product WHERE productid = :product_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $id = $productid;
        $statement->bindParam(':product_id', $id, PDO::PARAM_STR);

        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
     //   $product = new Products;
      //  $product = $product->setDescription($result['description']);
      //  $product= $product->setPrice($result['price']);
       // $product = $product->setImage1($result['image1']);
       // $product = $product->setImage2($result['image2']);
       // $_SESSION['product'] = $product;
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