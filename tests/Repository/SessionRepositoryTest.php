<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Repository;

use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\Session;
use PRGANYRN\PROJECT\TEST\Domain\User;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository = new SessionRepository(Database::getConnection());

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->nama = "Gilang Dirgarahayu";
        $user->username = "dirgagilang@gmail.com";
        $user->password = "gilangDirga98";

        $this->userRepository->save($user);
    }

    public function testSimpanSukses()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->user_id = "dirgagilang@gmail.com";
        $this->sessionRepository->simpan($session);

        $hasil = $this->sessionRepository->findById($session->id);

        self::assertEquals($hasil->id, $session->id);
        self::assertEquals($hasil->user_id, $session->user_id);
    }

    public function testHapusById()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->user_id = "dirgagilang@gmail.com";

        $this->sessionRepository->simpan($session);

        $hasil = $this->sessionRepository->findById($session->id);

        self::assertEquals($hasil->id, $session->id);
        self::assertEquals($hasil->user_id, $session->user_id);

        $this->sessionRepository->deleteById($session->id);

        $hasil = $this->sessionRepository->findById($session->id);

        self::assertNull($hasil);
    }

    public function testFindByIdNotFound()
    {
        $hasil = $this->sessionRepository->findById("salah@gmail.com");
        self::assertNull($hasil);
    }
}
