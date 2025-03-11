<?php

namespace App\Controllers;

use App\Models\AppModel;
use CodeIgniter\RESTful\ResourceController;

class Search extends ResourceController
{
    protected $format = "json";

    public function getApps()
    {
        $model = new AppModel();
        $search = $this->request->getGet("q");

        if ($search) {
            $results = $model->getApps($search);
        } else {
            $results = [ ];
        }

        return $this->respond(["status" => "success", "results" => $results]);
    }
}
