<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Service;

use PRGANYRN\PROJECT\TEST\Domain\User;
use PRGANYRN\PROJECT\TEST\Config\Database;
use PRGANYRN\PROJECT\TEST\Model\UserLoginRequest;
use PRGANYRN\PROJECT\TEST\Model\UserDaftarRequest;
use PRGANYRN\PROJECT\TEST\Model\UserLoginResponse;
use PRGANYRN\PROJECT\TEST\Model\UserDaftarResponse;
use PRGANYRN\PROJECT\TEST\Repository\UserRepository;
use PRGANYRN\PROJECT\TEST\Exception\ValidationException;
use PRGANYRN\PROJECT\TEST\Model\DataPembaruanUserRequest;
use PRGANYRN\PROJECT\TEST\Model\DataPembaruanUserResponse;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getConnection());

    }

    public function daftar(UserDaftarRequest $request): UserDaftarResponse
    {
        $this->validasiUserDaftar($request);

        try{
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if($user != null){
                throw new ValidationException("Username wis kanggo !");
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

    protected function validasiUserDaftar(UserDaftarRequest $request): void
    {
        if($request->nama == null || $request->username == null || $request->password == null ||
        trim($request->nama) == "" || trim($request->username) == "" || trim($request->password) == "")
        {
            throw new ValidationException("Nama, username, password aja kosong !");
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validasiUserLogin($request);

        $user = $this->userRepository->findByUsername($request->username);
        if($user == null){
            throw new ValidationException("Username ra ketemu !");
        }

        if(password_verify($request->password, $user->password))
        {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new ValidationException("Username / passworde salah !");
        }
    }

    protected function validasiUserLogin(UserLoginRequest $request)
    {
        if($request->username == null || $request->password == null ||
        trim($request->username) == "" || trim($request->password) == ""){
            throw new ValidationException("Username karo password raulih kosong !");
        }
    }

    public function perbarui(DataPembaruanUserRequest $request): DataPembaruanUserResponse
    {
        $this->validasiDataPembaruanUser($request);
        try{
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if($user == null){
                throw new ValidationException("User ra ana !");
            }

            $user->nama = $request->nama;
            $user->username = $request->username;

            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new DataPembaruanUserResponse();
            $response->user = $user;
            return $response;
        }catch(\Exception $err){
            Database::rollback();
            throw $err;
        }
    }

    protected function validasiDataPembaruanUser(DataPembaruanUserRequest $request)
    {
        if($request->username == null || $request->nama == null ||
        trim($request->username) == "" || trim($request->nama) == ""){
            throw new ValidationException("Username karo namane aja kosong !");
        }
    }
}
