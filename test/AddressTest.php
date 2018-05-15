<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../class/Address.php';
require_once __DIR__ . '/../class/database/DBmysql.php';

class AddressTest extends TestCase
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

    public function testLoadAddress()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Address::setDb($db);
        $this->assertEquals(
            array(
                'id' => 1,
                'city' => 'Sw.Katarzyna',
                'postcode' => '55010',
                'street' => 'Zernicka',
                'house' => '8'
            )
            , Address::load(1));
    }

    public function testLoadAllAddress()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Address::setDb($db);
        $addressArray = Address::loadAll();
        $this->assertCount(3, $addressArray);
    }

    public function testSaveAddress()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Address::setDb($db);
        $address = new Address('Wrocław', '55010', 'Żelazna', '5');
        $this->assertTrue($address->save());

        $this->assertEquals('Wrocław', $address->getCity());
        $this->assertEquals('55010', $address->getPostCode());
        $this->assertEquals('Żelazna', $address->getStreet());
        $this->assertEquals('5', $address->getHouse());
    }

    public function testUpdateAddress()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Address::setDb($db);

        $address = Address::load(1);
        $address->setCity('Wrocław');
        $address->setPostCode('55010');
        $address->setStreet('Żelazna');
        $address->setHouse('5');
        $this->assertTrue($address->update());

        $this->assertEquals('Wrocław', $address->getCity());
        $this->assertEquals('55010', $address->getPostCode());
        $this->assertEquals('Żelazna', $address->getStreet());
        $this->assertEquals('5', $address->getHouse());
    }

    public function testDeleteAddress()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Address::setDb($db);
        $address = Address::load(1);
        $this->assertTrue($address->delete());
    }
}