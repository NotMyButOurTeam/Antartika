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

    public function searchTags(string $string): array | null
    {
        $data = $this->where([
            "string" => $string
        ])->findAll();

        return $data;
    }

    public function removeTag(int $id): void
    {
        $this->delete($id);
    }
}
