<?php

namespace PRGANYRN\PROJECT\TEST\Middleware;

use PRGANYRN\PROJECT\TEST\App\View;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Repository\SessionRepository;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;
use PRGANYRN\PROJECT\TEST\Service\SessionService;

class AuthMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function cek(): void
    {
        $user = $this->sessionService->terkini();
        if($user == null){
            View::redirect('/auth/login');
        }
    }
}
