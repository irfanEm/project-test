<?php

declare(strict_types=1);

namespace PRGANYRN\PROJECT\TEST\Repository;

use PRGANYRN\PROJECT\TEST\Domain\Grup;

class GrupTeleRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function simpan(Grup $grup): Grup
    {
        $statement = $this->pdo->prepare("INSERT INTO grup_tele(id_grup, nama_grup, user_grup, time_add) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $grup->id_grup,
            $grup->nama_grup,
            $grup->user_grup,
            date("YYYY-mm-dd H:i:s")
        ]);

        return $grup;
    }

    public function findByUserId(string $userId): Grup
    {
        $statement = $this->pdo->prepare("SELECT id, id_grup, nama_grup, user_grup, time_add FROM grup_tele WHERE id_grup = ?");
        $statement->execute([$userId]);

        try{
            if($row = $statement->fetch())
            {
                $grup = new Grup();
                $grup->id = $row['id'];
                $grup->id_grup = $row['id_grup'];
                $grup->nama_grup = $row['nama_grup'];
                $grup->user_grup = $row['user_grup'];
                $grup->time_add = $row['time_add'];

                return $grup;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function hapusAll()
    {
        $this->pdo->exec("DELETE FROM grup_tele");
    }
}
