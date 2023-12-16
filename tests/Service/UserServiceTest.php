<?php

namespace PRGANYRN\PROJECT\TEST\Service;
use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\User;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\DataRequestSandiUser;
use PRGANYRN\PROJECT\TEST\Model\UserDaftarRequest;
use PRGANYRN\PROJECT\TEST\Model\UserLoginRequest;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserRepository $userRepository;
    private UserService $userService;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService();

        $this->userRepository->deleteAll();
    }

    public function testDaftarSuccess()
    {
        $request = new UserDaftarRequest();
        $request->nama = "Zaidun Qoimun";
        $request->username = "zaid99";
        $request->password = "zaid2711";

        $response = $this->userService->daftar($request);

        self::assertEquals($response->user->nama, $request->nama);
        self::assertEquals($response->user->username, $request->username);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testDaftarGagal()
    {
        self::expectException(ValidationException::class);
        $request = new UserDaftarRequest();
        $request->nama = "";
        $request->username = "";
        $request->password = "";

        $this->userService->daftar($request);
    }

    public function testDaftarDuplicate()
    {
        $user = new User();
        $user->nama = "Zaidun";
        $user->username = "zaid97";
        $user->password = "ratidokan";

        $this->userRepository->save($user);

        self::expectException(ValidationException::class);

        $request = new UserDaftarRequest();
        $request->nama = "Zaidun";
        $request->username = "zaid97";
        $request->password = "ratidokan";

        $this->userService->daftar($request);
    }

    public function testLoginSukses()
    {
        $user = new User();
        $user->nama = "Pengguna 112";
        $user->username = "user112";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $request = new UserLoginRequest();
        $request->username = "user112";
        $request->password = "rahasianegara";

        $response = $this->userService->login($request);

        self::assertEquals($response->user->username, $user->username);
        self::assertEquals($response->user->nama, $user->nama);

        self::assertTrue(password_verify($request->password, $response->user->password));

    }

    public function testLoginPasswordSalah()
    {
        $user = new User();
        $user->nama = "Pengguna 112";
        $user->username = "user112";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        self::expectException(ValidationException::class);

        $request = new UserLoginRequest();
        $request->username = "user112";
        $request->password = "rahasiadesa";

        $this->userService->login($request);
    }

    public function testLoginUserTidakAda()
    {
        $user = new User();
        $user->nama = "Pengguna 112";
        $user->username = "user112";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        self::expectException(ValidationException::class);

        $request = new UserLoginRequest();
        $request->username = "user110";
        $request->password = "rahasianegara";

        $this->userService->login($request);
    }

    public function testUbahSandiSukses()
    {
        $user = new User();
        $user->nama = "Pengguna 112";
        $user->username = "user112";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $id = $this->userRepository->findByUsername($user->username);
        $userId = $id->id;

        $request = new DataRequestSandiUser();
        $request->id = $userId;
        $request->sandiLama = "rahasianegara";
        $request->sandiBaru = "rahasiaDesa";
        $request->konfirmasiSandiBaru = "rahasiaDesa";

        $response = $this->userService->perbaruiSandi($request);

        self::assertTrue(password_verify($request->sandiBaru, $response->user->password));
        self::assertNotTrue(password_verify($request->sandiLama, $response->user->password));
    }

    public function testUbahSandiKonfirmasiTidakSama()
    {
        $user = new User();
        $user->nama = "Pengguna 112";
        $user->username = "user112";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        self::expectException(ValidationException::class);

        $id = $this->userRepository->findByUsername($user->username);
        $userId = $id->id;

        $request = new DataRequestSandiUser();
        $request->id = $userId;
        $request->sandiLama = "rahasianegara";
        $request->sandiBaru = "rahasiaDesa";
        $request->konfirmasiSandiBaru = "rahasiaLurah";

        $this->userService->perbaruiSandi($request);

        self::expectOutputRegex("[Konfirmasi sandi kudu pada !]");
    }

    public function testUbahSandiLamaSalah()
    {
        $user = new User();
        $user->nama = "Pengguna 112";
        $user->username = "user112";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        self::expectException(ValidationException::class);

        $id = $this->userRepository->findByUsername($user->username);
        $userId = $id->id;

        $request = new DataRequestSandiUser();
        $request->id = $userId;
        $request->sandiLama = "rahasiaprovinsi";
        $request->sandiBaru = "rahasiaLurah";
        $request->konfirmasiSandiBaru = "rahasiaLurah";

        $this->userService->perbaruiSandi($request);

        self::expectOutputRegex("[Sandi lama salah !]");
    }
}
