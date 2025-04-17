<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ReviewModel;

class ApplicationReviewModel extends Model
{
    protected $table = "ApplicationReview";
    protected $allowedFields = [
        "app",
        "review"
    ];

    public function addApplicationReview(int $app, int $review) : int | bool
    {
        return $this->insert([
            "app" => $app,
            "review" => $review
        ]);
    }

    public function getApplicationReviews(int $app): array | null
    {
        $data = $this->where([ 
            "app" => $app 
        ]);

        if ($data) {
            $data = $data->findColumn("review");
        }

        return $data;
    }

    public function removeApplicationReview(int $app, int $review): void
    {
        $this->where([
            "app" => $app,
            "review" => $review
        ])->delete();
    }
}
