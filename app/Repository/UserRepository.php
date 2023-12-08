<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Repository;

use PRGANYRN\PROJECT\TEST\Domain\User;

class UserRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(User $user): User
    {
        $statement = $this->pdo->prepare("INSERT INTO users(nama, username, password) VALUES (?, ?, ?)");
        $statement->execute([
            $user->nama,
            $user->username,
            $user->password
        ]);

        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->pdo->prepare("UPDATE users SET nama = ? , username = ?, password = ? WHERE id = ?");
        $statement->execute([
            $user->nama,
            $user->username,
            $user->password,
            $user->id
        ]);

        return $user;
    }

    public function findById(int $id): ?User
    {
        $statement = $this->pdo->prepare("SELECT id, nama, username, password FROM users WHERE id = ?");
        $statement->execute([$id]);
        
        try{
            if($row = $statement->fetch())
            {
                $user = new User();
                $user->id = $row['id'];
                $user->nama = $row['nama'];
                $user->username = $row['username'];
                $user->password = $row['password'];

                return $user;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->pdo->prepare("SELECT id, nama, username, password FROM users WHERE username = ?");
        $statement->execute([$username]);
        
        try{
            if($row = $statement->fetch())
            {
                $user = new User();
                $user->id = $row['id'];
                $user->nama = $row['nama'];
                $user->username = $row['username'];
                $user->password = $row['password'];

                return $user;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function deleteById(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->pdo->exec("DELETE FROM users");
    }
}
