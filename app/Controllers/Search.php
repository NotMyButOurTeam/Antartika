<?php

namespace App\Controllers;

use App\Models\AppModel;

class Search extends BaseController
{
    public function search(): string
    {
        helper("form");

        $model = new AppModel();
        $search = $this->request->getGet("query");

        if (strlen($search) < 1) {
            $search = "Search";
            $data["results"] = $model->getApps();
        } else {
            $data["results"] = $model->getApps($search);
        }

        return view("components/header", [ "title" => $search ])
            . view("components/searchbar")
            . view("search", $data)
            . view("components/footer");
    }
}
