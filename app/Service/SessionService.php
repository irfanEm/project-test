<?php

namespace PRGANYRN\PROJECT\TEST\Service;

use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\Session;
use PRGANYRN\PROJECT\TEST\Domain\User;
use PRGANYRN\PROJECT\TEST\Repository\SessionRepository;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;

class SessionService
{
    private static $COOKIE_NAME = "IRFANEM";
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
    }

    public function buat(string $user_id): Session
    {
        $session = new Session();
        $session->id = uniqid();
        $session->user_id  = $user_id;

        $this->sessionRepository->simpan($session);

        setcookie(self::$COOKIE_NAME, $session->id, time() + (60*60*24), "/");

        return $session;
    }

    public function hapus()
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
        $this->sessionRepository->deleteById($sessionId);

        setcookie(self::$COOKIE_NAME,"", 1, "/");
    }

    public function terkini(): ?User
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
        $session = $this->sessionRepository->findById($sessionId);

        if($session == null){
            return null;
        }

        return $this->userRepository->findById($session->user_id);
    }

}
