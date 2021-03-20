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
        $_SESSION['product'] = $product;

    }

    function getProducts()
    {
        $sql = "SELECT * FROM product";

        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}









