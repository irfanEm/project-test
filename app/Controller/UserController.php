<?php

namespace PRGANYRN\PROJECT\TEST\Controller;

use PRGANYRN\PROJECT\TEST\App\View;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\DataPembaruanUserRequest;
use PRGANYRN\PROJECT\TEST\Model\DataRequestSandiUser;
use PRGANYRN\PROJECT\TEST\Model\UserDaftarRequest;
use PRGANYRN\PROJECT\TEST\Model\UserLoginRequest;
use PRGANYRN\PROJECT\TEST\Repository\SessionRepository;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;
use PRGANYRN\PROJECT\TEST\Service\SessionService;
use PRGANYRN\PROJECT\TEST\Service\UserService;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function daftar()
    {
        View::view('Auth/daftar', [
            "title" => "Daftar",
            "heading" => "Daftar user baru"
        ]);
    }

    public function postDaftar()
    {
        $request = new UserDaftarRequest();
        $request->nama = $_POST['nama'];
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try{
            $this->userService->daftar($request);
            View::redirect('/auth/login');
        }catch(ValidationException $err){
            View::view('Auth/daftar', [
                "title" => "Daftar",
                "error" => $err->getMessage(),
                "heading" => "Daftar user baru"
            ]);
        }
    }

    public function login()
    {
        View::view("Auth/login", [
            "title" => "Login",
            "heading" => "Login user"
        ]);
    }

    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try{
            $response = $this->userService->login($request);
            $this->sessionService->buat($response->user->id);
            View::redirect('/');
        }catch(ValidationException $err){
            View::view("Auth/login", [
                "title" => "Login",
                "error" => $err->getMessage(),
                "heading" => "Login user"
            ]);
        }
    }

    public function logout()
    {
        $this->sessionService->hapus();
        View::redirect("/auth/login");
    }

    public function perbaruiProfil()
    {
        $user = $this->sessionService->terkini();

        View::view_user("User/perbarui", [
            "title" => "Pembaruan profil",
            "heading" => "Pembaruan profil",
            "user" => [
                "nama" => $user->nama,
                "username" => $user->username
            ]
        ]);
    }

    public function postPerbaruiProfil()
    {
        $user = $this->sessionService->terkini();

        $request = new DataPembaruanUserRequest();
        $request->id = $user->id;
        $request->nama = $_POST['nama'];
        $request->username = $_POST['username'];

        try{
            $this->userService->perbarui($request);
            View::redirect('/user/perbarui');
        }catch(ValidationException $err){
            View::view_user("User/perbarui",[
                "title" => "Pembaruan profil",
                "heading" => "Pembaruan profil user",
                "error" => $err->getMessage(),
                "user" => [
                    "nama" => $user->nama,
                    "username" => $user->username
                ]
            ]);
        }
    }

    public function postUbahSandi()
    {
        $user = $this->sessionService->terkini();

        $request = new DataRequestSandiUser();
        $request->id = $user->id;
        $request->sandiLama = $_POST['sandiLama'];
        $request->sandiBaru = $_POST['sandiBaru'];
        $request->konfirmasiSandiBaru = $_POST['konfirmasiSandi'];

        try{
            $this->userService->perbaruiSandi($request);
            View::redirect('/user/perbarui');
        }catch(\Exception $err){
            View::view_user("User/perbarui",[
                "title" => "Pembaruan profil",
                "heading" => "Pembaruan profil user",
                "error" => $err->getMessage()
            ]);
        }
    }
}
