<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = "Review";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "writer",
        "rating",
        "content"
    ];

    public function addReview(int $writer, int $rating, string $content): int 
    {
        return $this->insert([
            "writer" => $writer,
            "rating" => $rating,
            "content" => $content
        ]);
    }

    public function getReview(int $id): array | null
    {
        $data = $this->find($id);

        return $data;
    }
    
    public function removeReview(int $id): void
    {
        $this->delete($id);
    }
}
