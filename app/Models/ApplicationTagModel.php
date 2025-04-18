<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationTagModel extends Model
{
    protected $table = "ApplicationTag";
    protected $allowedFields = [
        "app",
        "tag"
    ];

    public function addApplicationTag(int $app, int $tag): void
    {
        $this->insert([
            "app" => $app,
            "tag" => $tag
        ]);
    }

    public function getApplicationsTagged(int $tag): array | null
    {
        $data = $this->where([
            "tag" => $tag
        ])->findColumn("app");

        return $data;
    }

    public function getApplicationTags(int $app): array | null
    {
        $data = $this->where([
            "app" => $app
        ])->findColumn("tag");

        return $data;
    }

    public function removeApplicationTags(int $app): void
    {
        $this->where(["app" => $app])->delete();
    }
}
