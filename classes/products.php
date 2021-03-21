<?php

/**
 * @author Safal Adhikari and Jessica Sestak
 * @Version 1.0
 * classes/products.php
 * Products class stores the product's information that the user has chosen
 **/
class Products
{
    //fields
    private $_productId;
    private $_description;
    private $_price;
    private $_image1;
    private $_image2;
    private $_productname;

    /**
     * getProductname gets the product name
     * @return String
     */
    public function getProductname()
    {
        return $this->_productname;
    }

    /**
     * setProductname sets the products name
     * @param String $productname
     */
    public function setProductname($productname)
    {
        $this->_productname = $productname;
    }

    /**
     * getProductId gets the id of the product
     * @return int
     */
    public function getProductId()
    {
        return $this->_productId;
    }

    /**
     * setProductId sets the product's id
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->_productId = $productId;
    }

    /**
     * getDescription gets the description of the product
     * @return String
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * setDescription sets the description of the product
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * getPrice gets the price of the product
     * @return float
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * setPrice sets the price of the product
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * getImage1 gets the first image name of the product
     * @return String
     */
    public function getImage1()
    {
        return $this->_image1;
    }

    /**
     * setImage1 sets the first image name of the product
     * @param String $image1
     */
    public function setImage1($image1)
    {
        $this->_image1 = $image1;
    }

    /**
     * getImage2 gets the second image name of the product
     * @return String
     */
    public function getImage2()
    {
        return $this->_image2;
    }

    /**
     * setImage2 sets the second image name of the product
     * @param String $image2
     */
    public function setImage2($image2)
    {
        $this->_image2 = $image2;
    }
}
