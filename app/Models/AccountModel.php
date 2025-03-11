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

    public function getUserData(string $email): array
    {
        $result = $this->where("email", $email)->first();

        return $result;
    }

    public function isAccountValid(string $email, string $password): bool
    {
        $result = $this->where("email", $email)
                        ->where("password", $password)->first();
        return !empty($result);
    }
}
