<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Repository;

use PHPUnit\Framework\TestCase;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\User;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());

        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->id = 1;
        $user->nama = "Testing Nama";
        $user->username = "test001";
        $user->password = "rahasia001";

        $this->userRepository->save($user);

        $result = $this->userRepository->findByUsername($user->username);
        self::assertEquals($result->nama, $user->nama);
        self::assertEquals($result->username, $user->username);
        self::assertEquals($result->password, $user->password);
    }

    public function testUpdateSuccess()
    {
        $user = new User();
        $user->nama = "Testing Nama 5";
        $user->username = "test005";
        $user->password = "rahasia005";

        $this->userRepository->save($user);

        $id = $this->userRepository->findByUsername($user->username);
        $user->id = $id->id;
        $user->nama = "Nama Testing 5";
        $user->username = "testkosong05";
        
        $this->userRepository->update($user);
        
        $result = $this->userRepository->findById($id->id);

        self::assertEquals($result->id, $user->id);
        self::assertEquals($result->nama, $user->nama);
        self::assertEquals($result->username, $user->username);
        self::assertEquals($result->password, $user->password);
    }

    public function testFindByIdSuccess()
    {
        $user = new User();
        $user->nama = "Testing Nama 9";
        $user->username = "test009";
        $user->password = "rahasia009";

        $this->userRepository->save($user);

        $id = $this->userRepository->findByUsername($user->username);
        $result = $this->userRepository->findById($id->id);

        self::assertNotNull($result);
        self::assertEquals($result->nama, $user->nama);
        self::assertEquals($result->username, $user->username);
        self::assertEquals($result->password, $user->password);
    }

    public function testFindByUsernameSuccess()
    {
        $user = new User();
        $user->nama = "Testing Nama 7";
        $user->username = "test007";
        $user->password = "rahasia007";

        $this->userRepository->save($user);

        $result = $this->userRepository->findByUsername($user->username);

        self::assertNotNull($result);
        self::assertEquals($result->nama, $user->nama);
        self::assertEquals($result->username, $user->username);
        self::assertEquals($result->password, $user->password);
    }
}
