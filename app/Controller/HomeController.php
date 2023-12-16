<?php

namespace PRGANYRN\PROJECT\TEST\Controller;

use PRGANYRN\PROJECT\TEST\App\View;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Repository\SessionRepository;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;
use PRGANYRN\PROJECT\TEST\Service\SessionService;

class HomeController
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());

        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public function index()
    {
        $user = $this->sessionService->terkini();
        View::view('Home/index', [
            "title" => "Dashboard",
            "user" => [
                "nama" => $user->nama
            ]
        ]);
    }

    public function error()
    {
        View::view('Error/404', [
            "title" => "not found"
        ]);
    }

    public function editView()
    {
        View::view('edit', [
            "title" => "not found"
        ]);
    }

}
