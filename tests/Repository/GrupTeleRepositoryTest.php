<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Repository;

use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\Grup;

class GrupTeleRepositoryTest extends TestCase
{
    private GrupTeleRepository $grupRepo;

    protected function setUp(): void
    {
        $this->grupRepo = new GrupTeleRepository(Database::getConnection());

        $this->grupRepo->hapusAll();
    }
    public function testSimpanSukses()
    {
        $grup = new Grup();
        $grup->id_grup = '079856412';
        $grup->nama_grup = 'Grup Test 1';
        $grup->user_grup = 'grup_test1';

        $this->grupRepo->simpan($grup);

        $hasil = $this->grupRepo->findByUserId($grup->id_grup);

        self::assertEquals('079856412', $hasil->id_grup);
        self::assertEquals('Grup Test 1', $hasil->nama_grup);
        self::assertEquals('grup_test1', $hasil->user_grup);
    }
}
