<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = "Account";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "privilege",
        "name",
        "email",
        "phone",
        "password",
        "profile"
    ];

    public function elevateAccountById(int $id): void
    {
        $account = $this->find($id);
        if ($account["privilege"] > 1) {
            $this->update($id, [ "privilege" => 1 ]);
        }
    }

    public function getAccountIdByValidation(string $email, string $password): int
    {
        $account = $this->where([ 
            "email" => $email, 
            "password" => $password
        ])->first();

        if (!empty($account)) {
            return $account["id"];
        }

        return 0;
    }

    public function getAccountEmailById(int $id): string
    {
        return $this->find($id)["email"];
    }

    public function getAccountPrivilegeById(int $id): int
    {
        return $this->find($id)["privilege"];
    }

    public function getAccountNameById(int $id): string
    {
        return $this->find($id)["name"];
    }

    public function validatePassword(int $id, string $password): bool
    {
        return $this->find($id)["password"] === $password;
    }

    public function setAccountNameById(int $id, string $name): void
    {
        $this->update($id, [ "name" => $name ]);
    }

    public function setAccountEmailById(int $id, string $email): void
    {
        $this->update($id, [ "email" => $email ]);
    }

    public function setAccountPasswordById(int $id, string $password): void
    {
        $this->update($id, [ "password" => $password ]);
    }

    public function isEmailUsed($email): bool
    {
        $data = $this->where([ "email" => $email ])->first();

        return !empty($data);
    }

    public function createNewAccount(string $name, string $email, string $password): bool
    {
        return $this->insert([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "privilege" => 2
        ], false);
    }
}
