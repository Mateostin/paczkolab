<?php

class User implements Action
{

    /**
     * @var DBmysql
     */
    public static $db;
    private $id;
    private $name;
    private $surname;
    private $creditQuantity;
    private $address;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getCreditQuantity()
    {
        return $this->creditQuantity;
    }

    public function setCreditQuantity($creditQuantity)
    {
        $this->creditQuantity = $creditQuantity;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function save()
    {
        self::$db->query('INSERT INTO Users(address,name,surname,creditQuantity) VALUES (:address,:name,:surname,:creditQuantity)');
        self::$db->bind('address', $this->getAddress());
        self::$db->bind('name', $this->getName());
        self::$db->bind('surname', $this->getSurname());
        self::$db->bind('creditQuantity', $this->getCreditQuantity());
        return self::$db->execute();
    }


    public function update($id = null)
    {
        self::$db->query('UPDATE Users SET name=:name, surname=:surname, creditQuantity=:creditQuantity WHERE id=:id');
        self::$db->bind('id', $id, null);
        self::$db->bind('name', $this->getName());
        self::$db->bind('surname', $this->getSurname());
        self::$db->bind('creditQuantity', $this->getCreditQuantity());
        return self::$db->execute();
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM Users WHERE id = :id");
        self::$db->bind('id', $id);
        return self::$db->execute();
    }

    public static function load($id = null)
    {
        self::$db->query("SELECT * FROM Users WHERE id=:id");
        self::$db->bind('id', $id, null);
        return self::$db->single();
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM Users");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }

}