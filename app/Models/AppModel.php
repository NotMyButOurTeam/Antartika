<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{
    protected $table = "App";
    protected $primaryKey = "id";
    protected $allowedFields = [ 
        "published",
        "publisher",
        "updated",
        "name",
        "description",
        "category",
    ];

    public $appCategories = [
        "Audio",
        "Developer Tools",
        "Education",
        "Games",
        "Graphics & Photography",
        "Networking",
        "Productivity",
        "Science",
        "System",
        "Utilities",
    ];

    public function searchApps(string $query, string $sortBy = "name", string $order = "asc"): array
    {
        $query = trim($query);
        if (empty($query)) {
            return $this->orderBy($sortBy, $order)->findAll();
        }

        return $this->like("name", $query)->orLike("description", $query)->orderBy($sortBy, $order)->findAll();
    }

    public function getAppById(int $id): array
    {
        return $this->find($id);
    }

    public function getAppsByPublisher(int $publisher): array
    {
        return $this->where(["publisher" => $publisher])->findAll();
    }

    public function createApp(string $name, string $description, int $publisher, int $category = 0): int
    {
        $this->insert([
            "name" => $name,
            "published" => date('Y-m-d H:i:s'),
            "publisher" => $publisher,
            "description" => $description,
            "category" => $category
        ]);

        return $this->getInsertID();
    }

    public function banApp(int $id)
    {
        $this->delete($id);
    }
}
