<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Service;

use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\Grup;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\GrupTambahRequest;
use PRGANYRN\PROJECT\TEST\Repository\GrupTeleRepository;

class GrupServiceTest extends TestCase
{
    private GrupTeleRepository $grupRepo;
    private GrupService $grupService;

    protected function setUp(): void
    {
        $this->grupRepo = new GrupTeleRepository(Database::getConnection());
        $this->grupService = new GrupService($this->grupRepo);

        $this->grupRepo->hapusAll();
    }

    public function testTambahSukses()
    {
        $request = new GrupTambahRequest();
        $request->id_grup = "07986354312";
        $request->nama_grup = "Grup Test 2";
        $request->user_grup = "grup_test2";

        $this->grupService->tambah($request);

        $hasil = $this->grupRepo->findByUserId($request->id_grup);

        self::assertEquals("07986354312", $hasil->id_grup);
        self::assertEquals("Grup Test 2", $hasil->nama_grup);
        self::assertEquals("grup_test2", $hasil->user_grup);
    }

    public function testTambahDataKosong()
    {
        self::expectException(ValidationException::class);

        $request = new GrupTambahRequest();
        $request->id_grup = "";
        $request->nama_grup = "";
        $request->user_grup = "";

        $this->grupService->tambah($request);
    }

    public function testSalahSatuDataKosong()
    {
        $grup = new Grup;
        $grup->id_grup = "07986354312";
        $grup->nama_grup = "Grup Test 2";
        $grup->user_grup = "grup_test2";

        $this->grupRepo->simpan($grup);

        self::expectException(ValidationException::class);

        $request = new GrupTambahRequest();
        $request->id_grup = "07986354312";
        $request->nama_grup = "Grup Test 2";
        $request->user_grup = "grup_test2";

        $this->grupService->tambah($request);
    }
}
