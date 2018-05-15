<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../class/User.php';
require_once __DIR__ . '/../class/database/DBmysql.php';

class UserTest extends TestCase
{
    use TestCaseTrait;

    protected function getConnection()
    {
        $pdo = new PDO($GLOBALS['DB_DSN'],
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWORD'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        return $this->createDefaultDBConnection($pdo, $GLOBALS['DB_NAME']);
    }

    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/fixtures.xml');
    }

    public function testSaveUser()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        User::setDb($db);
        $user = new User('Mateusz', 'Lipecki', 23, 1);
        $this->assertTrue($user->save());
    }

    public function testUpdateUser()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        User::setDb($db);
        $user = new User('Mateusz', 'Lipecki', 23, 1);
        $user->setName('Testowy');
        $user->setSurname('testsurname');
        $this->assertTrue($user->update());
    }

    public function testDeleteUser()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        User::setDb($db);
        $user = new User('Mateusz', 'Lipecki', 23, 1);
        $this->assertTrue($user->delete());
    }

    public function testLoadUser()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        User::setDb($db);
        $this->assertEquals(
            array(
                'id' => '1',
                'name' => 'Iron',
                'surname' => 'Man',
                'address' => '1',
                'creditQuantity' => null
            )
            , User::load(1));
    }

    public function testLoadAllUsers()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        User::setDb($db);
        $sizeArray = User::loadAll();
        $this->assertCount(3, $sizeArray);
    }

}