<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{
    protected $table = "App";

    public function getApps($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->like("name", $slug)
            ->orLike("description", $slug)
            ->orLike("category", $slug)
            ->findAll();
    }
}
