<?php

class Products
{
    private $_productId;
    private $_description;
    private $_price;
    private $_image1;
    private $_image2;
    private $_productname;

    /**
     * @return mixed
     */
    public function getProductname()
    {
        return $this->_productname;
    }

    /**
     * @param mixed $productname
     */
    public function setProductname($productname)
    {
        $this->_productname = $productname;
    }

    /**
     * Products constructor.
     * @param $_productId
     * @param $_description
     * @param $_price
     * @param $_image1
     * @param $_image2
     */
    /*
    public function __construct($_productId, $_description, $_price, $_image1, $_image2)
    {
        $this->_productId = $_productId;
        $this->_description = $_description;
        $this->_price = $_price;
        $this->_image1 = $_image1;
        $this->_image2 = $_image2;
    }
    */

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->_productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->_productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getImage1()
    {
        return $this->_image1;
    }

    /**
     * @param mixed $image1
     */
    public function setImage1($image1)
    {
        $this->_image1 = $image1;
    }

    /**
     * @return mixed
     */
    public function getImage2()
    {
        return $this->_image2;
    }

    /**
     * @param mixed $image2
     */
    public function setImage2($image2)
    {
        $this->_image2 = $image2;
    }
}
