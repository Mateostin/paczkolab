<?php

class Address implements Action
{
    private $id;
    private $city;
    private $postcode;
    private $street;
    private $house;

    public static $db;

    public function __construct($city,$postcode,$street,$house)
    {
        $this->city = '';
        $this->postcode = '';
        $this->street = '';
        $this->house = '';
    }
    /**
     * @var Database
     */

    public function save()
    {

    }

    public function update($id = null)
    {
    }

    public static function delete($id = null)
    {
    }

    public static function load($id = null)
    {
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM Address");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db=$db;
    }


    public function getId()
    {
        return $this->id;
    }




    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }


    public function getPostcode()
    {
        return $this->postcode;
    }


    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }


    public function getStreet()
    {
        return $this->street;
    }


    public function setStreet($street)
    {
        $this->street = $street;
    }


    public function getHouse()
    {
        return $this->house;
    }


    public function setHomeNumber($house)
    {
        $this->house = $house;
    }

}

