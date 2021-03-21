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

class Database
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
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
        $statement->bindParam(':product_id', $id, PDO::PARAM_INT);

        $statement->execute();

        //Get the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $product = new Products();
        $product->setDescription($result['description']);
        $product->setPrice($result['price']);
        $product->setImage1($result['image1']);
        $product->setImage2($result['image2']);
        $product->setProductname($result['productname']);
        $_SESSION['product'] = $product;

    }
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

    function getProducts()
    {
        $sql = "SELECT * FROM product";

        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
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
            $currentUser = new Users($result['fname'],$result['lname'],$result['email'],$result['username'],$result['password']);
            $_SESSION['currentUser'] = $currentUser;
            return true;
        }
        return false;

    }
}









