<?php

interface Action
{
    const db = null;

    public function save();

    public function update($id);

    public static function delete($id);

    public static function load($id = null);
    
    public static function loadAll();

    public static function setDb(Database $db);
}
