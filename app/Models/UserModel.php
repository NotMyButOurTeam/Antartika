<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "User";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "email",
        "name",
        "profile",
        "password"
    ];

    public function addUser(string $email, string $name, string $password, 
        string $profile = ""): int
    {
        return $this->insert([
            "email" => $email,
            "name" => $name,
            "profile" => $profile,
            "password" => $password
        ]);
    }

    public function updateUser(int $id, string $email = null, string $name = null, 
        string $profile = null, string $password = null): void
    {
        $data = [];

        if ($email) {
            $data["email"] = $email;
        }

        if ($name) {
            $data["name"] = $name;
        }

        if ($profile) {
            $data["profile"] = $profile;
        }

        if ($password) {
            $data["password"] = $password;
        }

        $this->update($id, $data);
    }

    public function getUser(int $id): array | null
    {
        $data = $this->find($id);
        if ($data) {
            unset($data["password"]);
        }

        return $data;
    }
}
