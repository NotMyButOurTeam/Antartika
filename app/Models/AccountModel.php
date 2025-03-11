<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = "Account";
    protected $primaryKey = "id";

    public function isValid(string $name, string $password): bool
    {
        $result = $this->where("name", $name)
                        ->where("password", $password)->first();
        if (!empty($result)) {
            return True;
        }

        return False;
    }
}
