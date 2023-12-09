<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Controller;

use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\User;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;
use PRGANYRN\PROJECT\TEST\Service\UserService;

class UserControllerTest extends TestCase
{
    private UserController $userController;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $userService = new UserService($this->userRepository);
        $this->userController = new UserController($userService);

        $this->userRepository->deleteAll();
    }

    public function testDaftar()
    {
        $this->userController->daftar();

        self::expectOutputRegex('[Daftar user baru]');
        self::expectOutputRegex('[Nama]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Password]');
    }

    public function testDaftarSukses()
    {
        $_POST['nama'] = "Hola";
        $_POST['username'] = "hola11";
        $_POST['password'] = "holadiablos";

        $this->userController->postDaftar();
        
        self::expectOutputRegex('[Location: /auth/login]');
    }

    public function testDaftarGagal()
    {
        $_POST['nama'] = "";
        $_POST['username'] = "";
        $_POST['password'] = "";

        $this->userController->postDaftar();

        self::expectOutputRegex('[Daftar user baru]');
        self::expectOutputRegex('[Nama]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[Nama, username, password aja kosong !]');
    }

    public function testDaftarDuplicateUsername()
    {
        $user = new User();
        $user->nama = "Komar";
        $user->username = "ko_mar33";
        $user->password = "kom_ar44";

        $this->userRepository->save($user);

        $_POST['nama'] = "Komar";
        $_POST['username'] = "ko_mar33";
        $_POST['password'] = "kom_ar44";

        $this->userController->postDaftar();

        self::expectOutputRegex('[Daftar user baru]');
        self::expectOutputRegex('[Nama]');
        self::expectOutputRegex('[Komar]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[ko_mar33]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[Username wis kanggo !]');
    }
}
