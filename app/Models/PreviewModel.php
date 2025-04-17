<?php

namespace App\Models;

use CodeIgniter\Model;

class PreviewModel extends Model
{
    protected $table = "Preview";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "url"
    ];

    public function addPreview(string $url): int | bool
    {
        return $this->insert([
            "url" => $url
        ]);
    }

    public function getURL(int $id): string | null
    {
        $data = $this->find($id);

        return $data["url"];
    }
    
    public function removePreview(int $id): void
    {
        $this->delete($id);
    }
}
