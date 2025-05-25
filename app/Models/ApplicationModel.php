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
        "description",
        "source"
    ];

    public function addApplication(string $title, int $publisher, string $description = "", string $source = ""): int | null
    {
        $data = [
            "title" => $title,
            "publisher" => $publisher,
            "description" => $description,
            "source" => $source
        ];

        return $this->insert($data);
    }

    public function getApplication(int $id): array | null
    {
        $data = $this->find($id);

        return $data;
    }

    public function updateApplication(int $id, string $title = null, string $description = null, string $source = null): void
    {
        $data = [];
        if ($title) {
            $data["title"] = $title;
        }

        if ($description) {
            $data["description"] = $description;
        }

        if ($source) {
            $data["source"] = $source;
        }

        $this->update($id, $data);
    }

    public function searchApplications(string $query = ""): array | null
    {
        $data = [];
        if (!empty($query)) {
            $data = $this->like("title", $query)
                ->orLike("description", $query)
                ->orderBy('title', 'ASC')
                ->findAll();

        } else {
            $data = $this->orderBy('title', 'ASC')->findAll();
        }

        return $data;
    }

    public function searchApplicationsByPublisher(int $id): array | null
    {
        return $this->where("publisher", $id)
            ->findAll();
    }

    public function removeApplication(int $id): void
    {
        $this->delete($id);
    }
}
