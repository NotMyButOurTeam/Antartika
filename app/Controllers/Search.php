<?php

namespace App\Controllers;

class Search extends BaseController
{
    public function search(): string
    {
        helper("form");
        $search = $this->request->getGet("search");

        if (strlen($search) < 1) {
            $search = "Search";
        }

        return view("components/header", [ "title" => $search ])
            . view("components/searchbar")
            . view("search")
            . view("components/footer");
    }
}
