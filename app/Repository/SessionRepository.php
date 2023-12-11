<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Repository;

use PRGANYRN\PROJECT\TEST\Domain\Session;

class SessionRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function simpan(Session $session): Session
    {
        $statement = $this->pdo->prepare("INSERT INTO sessions(id, user_id) VALUES (?, ?)");
        $statement->execute([$session->id, $session->user_id]);
        return $session;
    }

    public function findById(string $id): ?Session
    {
        $statement = $this->pdo->prepare("SELECT id, user_id FROM sessions WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch())
            {
                $session = new Session();
                $session->id = $row['id'];
                $session->user_id = $row['user_id'];
    
                return $session;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }

    }

    public function deleteById(string $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->pdo->exec("DELETE FROM sessions");
    }
}
