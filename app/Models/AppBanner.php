<?php

namespace App\Models;

use CodeIgniter\Model;

class AppBannerModel extends Model
{
    protected $table = "AppBanner";
    protected $allowedFields = [ "app", "src" ];

    public function pushImage(int $app, string $src): void
    {
        if ($src !== null) {
            $this->insert($app, $src);
        }
    }
}
