<?php

include_once __DIR__.'/interface/Action.php';

class Address implements Action
{
    private $id;
    private $city;
    private $postcode;
    private $street;
    private $house;

    /**
     * @var Database
     */
    public static $db;

    public function __construct($city,$postcode,$street,$house)
    {
        $this->city = $city;
        $this->postcode = $postcode;
        $this->street = $street;
        $this->house = $house;
    }

    public function save()
    {
        self::$db->query("INSERT INTO Address(id, city, postcode, street, house) VALUES (null, '".$this->getCity()."', '".$this->getPostcode()."', '".$this->getStreet()."', '".$this->getHouse()."')");
        return self::$db->execute();
    }

    public function update($id = null)
    {
        self::$db->query("UPDATE Address SET city = '".$this->getCity()."', postcode = '".$this->getPostcode()."', street = '".$this->getStreet()."', house = '".$this->getHouse()."' WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM Address WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function load($id = null)
    {
        self::$db->query("SELECT * FROM Address WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->single();
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
        return intval($this->house);
    }

    public function setHomeNumber($house)
    {
        $this->house = $house;
    }

}

