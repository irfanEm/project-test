<?php

namespace PRGANYRN\PROJECT\TEST\Controller;

use PRGANYRN\PROJECT\TEST\App\View;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
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
            $this->sessionService->buat($response->user->username);
            View::redirect('/');
        }catch(ValidationException $err){
            View::view("Auth/login", [
                "title" => "Login",
                "error" => $err->getMessage(),
                "heading" => "Login user"
            ]);
        }
    }
}
