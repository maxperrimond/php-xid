<?php

namespace Tests;

use MP\XID\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testNewXID()
    {
        $xid = Factory::newXID();

        echo  $xid;

        $this->assertTrue(is_string($xid));
        $this->assertEquals(20, strlen($xid));
    }
}
