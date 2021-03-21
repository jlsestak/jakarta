<?php

/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * model/database.php
 * Contains queries to access the database to store and retrieve user and product information
 **/
class Database
{
    //fields
    private $_dbh;

    /**
     * Database constructor.
     * @param $dbh
     */
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * getMember($member_id) gets a single member from the database using their member id
     * @param $productid int
     */
    function getProduct($productid)
    {
        //Define the query
        $sql = "SELECT * FROM product WHERE productid = :product_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //bind parameters
        $id = $productid;
        $statement->bindParam(':product_id', $id, PDO::PARAM_INT);

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //Store the product information from the database into the Product class
        $product = new Products();
        $product->setDescription($result['description']);
        $product->setPrice($result['price']);
        $product->setImage1($result['image1']);
        $product->setImage2($result['image2']);
        $product->setProductname($result['productname']);
        $_SESSION['product'] = $product;
    }

    /**
     * insertUsers inserts the user information from the registration
     * into the database
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
     * getProducts get the product information from the database
     * @return associative array
     */
    function getProducts()
    {
        //define the query
        $sql = "SELECT * FROM product";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //execute the statement
        $statement->execute();

        //return the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getUserPurchases gets the user
     * @return associative array
     */
    function getUserPurchase() {
        //define the query
        $sql = "SELECT primeusers.fname, primeusers.lname, primeusers.email, product.productname
        FROM primeusers
        JOIN productprime ON primeusers.primeuserid = productprime.primeuserid 
        JOIN product ON product.productid = productprime.productid";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function checkUserName($username){
        $sql = "SELECT * FROM primeusers WHERE username = :username";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $id = $username;
        $statement->bindParam(':username', $id, PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($username == $result['username']) {
            return false;
        }
        return true;
    }

    function checkCredentials($username, $password) {
        $sql = "SELECT * FROM primeusers WHERE username = :username";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $id = $username;
        $statement->bindParam(':username', $id, PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($username == $result['username'] && $password ==$result['password']) {
            $currentUser = new CurrentUser($result['fname'],$result['fname'],$result['email'],$result['username'],
                $result['password']);
            $currentUser->setMemberid($result['primeuserid']);
            $_SESSION['currentUser'] = $currentUser;
            return true;
        }
        return false;


    }
    function storePurchases( $productid) {
        $sql = "INSERT INTO productprime (productid, primeuserid)
	            VALUES (:productid, :userid)";

        $user = $_SESSION['currentUser'];
        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':userid', $user->getMemberId(), PDO::PARAM_INT);
        $statement->bindParam(':productid', $productid, PDO::PARAM_INT);

        //Execute
        $statement->execute();

    }
}









