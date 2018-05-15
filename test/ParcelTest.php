<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../class/Parcel.php';
require_once __DIR__ . '/../class/database/DBmysql.php';

class ParcelTest extends TestCase
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

    public function testSaveParcel()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Parcel::setDb($db);
        $parcel = new Parcel('1', '1', '1');
        $this->assertTrue($parcel->save());
    }

    public function testUpdateParcel()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Parcel::setDb($db);
        $parcel = new Parcel('1', '1', '1');
        $parcel->setSender('2');
        $parcel->setSize(2);
        $this->assertTrue($parcel->update());
        $this->assertEquals('2', $parcel->getSender());
        $this->assertEquals('2', $parcel->getSize());
    }

    public function testDeleteParcel()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Parcel::setDb($db);
        $parcel = new Parcel('1', '1', '1');
        $this->assertTrue($parcel->delete());
    }

    public function testLoadParcel()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Parcel::setDb($db);
        $this->assertEquals(
            array(
                'id' => '1',
                'size' => '1',
                'sender' => '1',
                'address' => '1'
            )
            , Parcel::load(1));
    }

    public function testLoadAllParcel()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Parcel::setDb($db);
        $parcelArray = Parcel::loadAll();
        $this->assertCount(2, $parcelArray);
    }

}