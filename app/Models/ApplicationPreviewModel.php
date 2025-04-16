<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationPreviewModel extends Model
{
    protected $table = "ApplicationPreview";
    protected $allowedFields = [
        "app",
        "preview"
    ];

    public function addApplicationPreview(int $app, int $preview): void
    {
        $this->insert([
            "app" => $app,
            "preview" => $preview
        ]);
    }

    public function getApplicationPreviews(int $app): array | null
    {
        $data = $this->where([ 
            "app" => $app
        ])->findColumn("preview");

        return $data;
    }
    
    public function removeApplicationPreview(int $app, int $preview): void
    {
        $this->where([
            "app" => $app,
            "preview" => $preview
        ])->delete();
    }
}
