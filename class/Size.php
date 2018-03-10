<?php

class Size implements Action
{
    private $id;
    private $size;
    private $price;

    public function __construct($size, $price) {
        $this->size = $size;
        $this->price = $price;
    }

    public function getId(){
        return $this->id;
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($size){
        $this->size = $size;

        return $this;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
        return $this;
    }

    public function loadFromDB($id)
    {
        //TODO:
    }
    public function saveToDB()
    {
        //TODO:
    }

    public function update()
    {
        //TODO:
    }

    public function deleteFromDB()
    {
        //TODO:
    }

    public static function loadAllFromDB() {
        //TODO:
    }

}