<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Controller;

use PRGANYRN\PROJECT\TEST\App\View;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\GrupTambahRequest;
use PRGANYRN\PROJECT\TEST\Repository\GrupTeleRepository;
use PRGANYRN\PROJECT\TEST\Service\GrupService;

class GrupController
{
    private GrupTeleRepository $grupRepo;
    private GrupService $grupService;

    public function __construct()
    {
        $this->grupRepo = new GrupTeleRepository(Database::getConnection());
        $this->grupService = new GrupService($this->grupRepo);
    }

    public function index()
    {
        $grups = $this->grupRepo->getAll();
        View::view_user("Group/index", [
            "title" => "Grup",
            "heading" => "List grup telegram",
            "grups" => $grups->fetchAll()
        ]);
    }

    public function daftar()
    {
        View::view_user("Group/tambah", [
            "title" => "Grup",
            "heading" => "Tambah grup baru"
        ]);
    }

    public function postTambah()
    {
        $request = new GrupTambahRequest();
        $request->id_grup = $_POST['id_grup'];
        $request->nama_grup = $_POST['nama_grup'];
        $request->user_grup = $_POST['user_grup'];

        try{
            $this->grupService->tambah($request);
            View::redirect('/grup/index');
        }catch(ValidationException $err){
            View::view_user("Grup/tambah", [
                "title" => "Grup",
                "heading" => "Tambah grup baru",
                "error" => $err->getMessage()
            ]);
        }
    }
}
