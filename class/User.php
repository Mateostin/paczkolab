<?php

class User implements Action
{

    private $id;
    private $name;
    private $surname;
    private $creditQuantity;
    private $address;

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

    }


    public function update()
    {

    }

    public function delete()
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

}