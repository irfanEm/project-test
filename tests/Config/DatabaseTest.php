<?php

namespace PRGANYRN\PROJECT\TEST\Config;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testDBConnect()
    {
        $conn = Database::getConnection();
        self::assertNotNull($conn);
    }

    public function testDBConnectSingleton()
    {
        $conn1 = Database::getConnection();
        $conn2 = Database::getConnection();
        self::assertSame($conn1, $conn2);
    }
}
