<?php

class Parcel implements Action
{
    private $id;
    private $sender;
    private $size;
    private $address;

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
    }

    public static function setDb(Database $db)
    {
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
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