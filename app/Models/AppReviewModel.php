<?php

namespace App\Models;

use CodeIgniter\Model;

class AppReviewModel extends Model
{
    protected $table = "AppReview";
    protected $allowedFields = [ 
        "reviewer", 
        "reviewed", 
        "published",
        "updated",
        "rating",
        "content"
    ];
}
