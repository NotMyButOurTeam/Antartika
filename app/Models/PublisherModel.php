<?php

namespace App\Models;

use CodeIgniter\Model;

class PublisherModel extends Model {
    protected $table = "Publisher";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "id",
        "reputation"
    ];

    public function addPublisher(int $id): int | bool
    {
        return $this->insert([
            "id" => $id,
            "reputation" => 0
        ]);
    }

    public function getReputation(int $id): float | null
    {
        $data = $this->where(["id" => $id])->first();
        if ($data) {
            return $data["reputation"];
        }

        return null;
    }

    public function isPublisher(int $id): bool 
    {
        return $this->getReputation($id) != null;
    }

    public function updateReputation(int $id, float $reputation): void
    {
        $this->update($id, [
            "reputation" => $reputation
        ]);
    }
 
    public function removePublisher(int $id): void
    {
        $this->delete($id);
    }
}
