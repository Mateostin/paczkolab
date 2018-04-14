<?php

class Parcel implements Action
{
    private $id;
    private $sender;
    private $size;
    private $address;

    /**
     * @var Database
     */
    public static $db;

    public function __construct($sender,$size,$address)
    {
        $this->sender = $sender;
        $this->size = $size;
        $this->address = $address;

    }

    public function save()
    {
        self::$db->query('INSERT INTO Parcel(sender,size,address) VALUES (:sender,:size,:address)');
        self::$db->bind('sender', $this->getSender());
        self::$db->bind('size', $this->getSize());
        self::$db->bind('address', $this->getAddress());
        return self::$db->execute();
    }

    public function update($id = null)
    {
        self::$db->query('UPDATE Parcel SET sender=:sender,size=:size, address=:address WHERE id=:id');
        self::$db->bind('id', $id, null);
        self::$db->bind('sender', $this->getSender());
        self::$db->bind('size', $this->getSize());
        self::$db->bind('address', $this->getAddress());
        return self::$db->execute();
    }

    public static function delete($id = null)
    {
        self::$db->query("DELETE FROM Parcel WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->execute();
    }

    public static function load($id = null)
    {
        self::$db->query("SELECT * FROM Parcel WHERE id = :id");
        self::$db->bind('id', $id, null);
        return self::$db->single();
    }

    public static function loadAll()
    {
        self::$db->query("SELECT * FROM Parcel");
        return self::$db->resultSet();
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getSender()
    {
        return $this->sender;
    }


    public function setSender($sender)
    {
        $this->sender = $sender;
    }


    public function getSize()
    {
        return $this->size;
    }


    public function setSize($size)
    {
        $this->size = $size;
    }


    public function getAddress()
    {
        return $this->address;
    }


    public function setAddress($address)
    {
        $this->address = $address;
    }



}