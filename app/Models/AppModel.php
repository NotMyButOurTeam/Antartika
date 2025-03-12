<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{
    protected $table = "App";
    protected $primaryKey = "id";

    public function getApps($text = false)
    {
        if ($text === false) {
            return $this->findAll();
        }

        return $this->like("name", $text)
            ->orLike("description", $text)
            ->orLike("category", $text)
            ->findAll();
    }

    public function getAppById(int $id)
    {
        return $this->where("id", $id)->first();
    }
}
