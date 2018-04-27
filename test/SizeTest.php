<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../class/Size.php';
require_once __DIR__ . '/../class/database/DBmysql.php';

class SizeTest extends TestCase
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

    public function testSaveSize()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Size::setDb($db);
        $size = new Size('XXL', 15);
        $this->assertTrue($size->save());
    }

    public function testUpdateSize()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Size::setDb($db);
        $size = new Size('M', '14');
        $size->setSize('XXXXL');
        $size->setPrice(20);
        $this->assertTrue($size->update());
        $this->assertEquals('XXXXL', $size->getSize());
        $this->assertEquals('20', $size->getPrice());
    }

    public function testDeleteSize()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Size::setDb($db);
        $size = new Size('M', '14');
        $this->assertTrue($size->delete());
    }

    public function testLoadSize()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Size::setDb($db);
        $this->assertEquals(
            array(
                'id' => 1,
                'price' => '8.00',
                'size' => 'M'
            )
            , Size::load(1));
    }

    public function testLoadAllSize()
    {
        $db = new DBmysql($this->getConnection()->getConnection());
        Size::setDb($db);
        $sizeArray = Size::loadAll();
        $this->assertCount(2, $sizeArray);
    }

}