<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table = "Application";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "title",
        "publisher",
        "description"
    ];

    public function addApplication(string $title, int $publisher, string $description = ""): int | bool
    {
        $data = [
            "title" => $title,
            "publisher" => $publisher,
            "description" => $description
        ];

        return $this->insert($data, false);
    }

    public function getApplication(int $id): array | null
    {
        $data = $this->find($id);

        return $data;
    }

    public function updateApplication(int $id, string $title = null, string $description = null): void
    {
        $data = [];
        if ($title) {
            $data["title"] = $title;
        }

        if ($description) {
            $data["description"] = $description;
        }

        $this->update($id, $data);
    }

    public function searchApplications(string $query = ""): array | null
    {
        $data = [];
        if (!empty($query)) {
            $data = $this->like("title", $query)
                ->orLike("description", $query)
                ->findAll();

        } else {
            $data = $this->findAll();
        }

        return $data;
    }

    public function removeApplication(int $id): void
    {
        $this->delete($id);
    }
}
