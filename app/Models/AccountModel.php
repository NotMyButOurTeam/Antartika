<?php

namespace App\Models;

use CodeIgniter\Model;

enum AccountPrivelege
{
    case Admin;
    case Publisher;
    case User;
}

class AccountModel extends Model
{
    protected $table = "Account";
    protected $primaryKey = "id";
    protected $allowedFields = ["email", "name", "password", "privilege"]; 

    public function isEmailUsed(string $email): bool
    {
        $result = $this->where("email", $email)->first();

        return !empty($result);
    }

    public function escalatePrivilege(int $id): bool
    {
        $result = $this->where("id", $id)->first();
        if ($result["privilege"] != "user") {
            return False;
        }

        return $this->update($id, [
            "privilege" => "publisher"
        ]);
    }

    public function getDataById(int $id)
    {
        $result = $this->where("id", $id)->first();
        return $result;
    }

    public function getIdByEmail(string $email): int
    {
        $result = $this->where("email", $email)->first();

        return $result["id"];
    }

    public function isAccountValid(string $email, string $password): bool
    {
        $result = $this->where("email", $email)
                        ->where("password", $password)->first();
        return !empty($result);
    }
}
