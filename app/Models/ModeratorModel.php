<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeratorModel extends Model
{
    protected $table = "Moderator";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "id",
        "authority"
    ];

    public function getAuthority(int $id): int | null
    {
        $data = $this->find($id);
        if ($data) return $data["authority"];

        return null;
    }

    public function isModerator(int $id): bool
    {
        return ($this->getAuthority($id) != null);
    }
}
