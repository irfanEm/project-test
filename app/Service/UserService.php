<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Service;

use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Domain\User;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\UserDaftarRequest;
use PRGANYRN\PROJECT\TEST\Model\UserDaftarResponse;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getConnection());

    }

    public function daftar(UserDaftarRequest $request): UserDaftarResponse
    {
        $this->validationUserDaftar($request);

        try{
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if($user != null){
                throw new ValidationException("Username wis kanggo!");
            }
            
            $user = new User();
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new UserDaftarResponse();
            $response->user = $user;

            Database::commitTransaction();

            return $response;
        }catch(\Exception $error){
            Database::rollback();
            throw $error;
        }
    }

    protected function validationUserDaftar(UserDaftarRequest $request): void
    {
        if($request->nama == null || $request->username == null || $request->password == null ||
        trim($request->nama) == "" || trim($request->username) == "" || trim($request->password) == "")
        {
            throw new ValidationException("Nama, username, password aja kosong!");
        }
    }
}
