<?php

namespace PRGANYRN\PROJECT\TEST\Service;
use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\Session;
use PRGANYRN\PROJECT\TEST\Domain\User;
use PRGANYRN\PROJECT\TEST\Repository\SessionRepository;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;

class SessionServiceTest extends TestCase
{
    private SessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->username = "test@email.com";
        $user->nama = "Galih Bangun";
        $user->password = password_hash("galih2123", PASSWORD_BCRYPT);

        $this->userRepository->save($user);
    }

    public function testBuatSessionSukses()
    {
        $session = $this->sessionService->buat("test@email.com");
        self::expectOutputRegex("[IRFANEM: $session->id]");

        $hasil = $this->sessionRepository->findById($session->id);
        self::assertEquals("test@email.com", $hasil->id);
    }

    public function testHapus()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->user_id = "test@email.com";

        $this->sessionRepository->simpan($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        self::expectOutputRegex("[IRFANEM: ]");

        $hasil = $this->sessionRepository->findById($session->id);

        self::assertNull($hasil);
    }

    public function testTerkini()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->user_id = "test@email.com";

        $this->sessionRepository->simpan($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $user = $this->sessionService->terkini();

        self::assertEquals($session->user_id, $user->username);
    }
}
