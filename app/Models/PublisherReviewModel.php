<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ReviewModel;

class PublisherReviewModel extends Model
{
    protected $table = "PublisherReview";
    protected $allowedFields = [
        "publisher",
        "review"
    ];

    public function addPublisherReview(int $publisher, int $review) : int | bool
    {
        return $this->insert([
            "publisher" => $publisher,
            "review" => $review
        ]);
    }

    public function getPublisherReviews(int $publisher): array | null
    {
        $data = $this->where([ 
            "publisher" => $publisher 
        ]);

        if ($data) {
            $data = $data->findColumn("review");
        }

        return $data;
    }

    public function removePublisherReview(int $publisher, int $review): void
    {
        $this->where([
            "publisher" => $publisher,
            "review" => $review
        ])->delete();
    }
}
