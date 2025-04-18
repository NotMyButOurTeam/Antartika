<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationVerificationModel extends Model
{
    protected $table = "ApplicationVerification";
    protected $primaryKey = "app";
    protected $allowedFields = [
        "app",
        "moderator"
    ];

    public function addApplication(int $id): void
    {
        $this->insert([
            "app" => $id,
        ]);
    }

    public function getUnverifiedApplications(): array | null
    {
        return $this->where([
            "moderator" => null
        ])->findAll();
    }

    public function isApplicationVerified(int $id): bool
    {
        $app = $this->find($id);
        if (!$app) return false;

        return $app["moderator"] != null;
    }

    public function verifyApplication(int $id, int $moderator)
    {
        $this->update($id, [ "moderator" => $moderator ]);
    }
}
