<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Service;

use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\Grup;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\GrupTambahRequest;
use PRGANYRN\PROJECT\TEST\Model\GrupTambahResponse;
use PRGANYRN\PROJECT\TEST\Repository\GrupTeleRepository;

class GrupService
{
    private GrupTeleRepository $grupRepo;

    public function __construct()
    {
        $this->grupRepo = new GrupTeleRepository(Database::getConnection());
    }

    public function tambah(GrupTambahRequest $request): GrupTambahResponse
    {
        $this->validasiGrupTele($request);

        try{
            Database::beginTransaction();

            $grup = new Grup();
            $grup->id_grup = $request->id_grup;
            $grup->nama_grup = $request->nama_grup;
            $grup->user_grup = $request->user_grup;

            $this->grupRepo->simpan($grup);

            $response = new GrupTambahResponse();
            $response->grup = $grup;

            Database::commitTransaction();

            return $response;
        }catch(\Exception $err){

            Database::rollback();
            throw $err;
        }
    }

    private function validasiGrupTele(GrupTambahRequest $request)
    {
        if($request->id_grup == null || $request->nama_grup == null || $request->user_grup == null ||
        trim($request->id_grup) == "" || trim($request->nama_grup) == "" || trim($request->user_grup) == "")
        {
            return new ValidationException("Aja ana sing kosong !");
        }
    }
}
