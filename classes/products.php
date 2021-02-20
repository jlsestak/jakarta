<?php

class Products
{
    private $_petItem;
    private $_size;
    private $_petType;

    /**
     * Products constructor.
     * @param $_petItem
     * @param $_size
     * @param $_petType
     */
    public function __construct($_petItem, $_size, $_petType)
    {
        $this->_petItem = $_petItem;
        $this->_size = $_size;
        $this->_petType = $_petType;
    }

    /**
     * @return mixed
     */
    public function getPetItem()
    {
        return $this->_petItem;
    }

    /**
     * @param mixed $petItem
     */
    public function setPetItem($petItem)
    {
        $this->_petItem = $petItem;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }

    /**
     * @return mixed
     */
    public function getPetType()
    {
        return $this->_petType;
    }

    /**
     * @param mixed $petType
     */
    public function setPetType($petType)
    {
        $this->_petType = $petType;
    }
}
