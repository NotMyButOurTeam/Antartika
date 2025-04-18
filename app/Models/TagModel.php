<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = "Tag";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "string"
    ];

    public function addTag(string $string): void
    {
        $this->insert([
            "string" => $string
        ]);
    }

    public function getString(int $id): string | null
    {
        return $this->find($id)["string"];
    }

    public function searchTag(string $string): int | null
    {
        $data = $this->where([
            "string" => $string
        ])->first();

        if (!$data) {
            return null;
        }

        return $data["id"];
    }

    public function removeTag(int $id): void
    {
        $this->delete($id);
    }
}
