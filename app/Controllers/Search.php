<?php

namespace App\Controllers;

class Search extends BaseController
{
    public function post(): string
    {
        $search = $this->request->getPost("search");

        helper("form");
        return view("components/header", [ "title" => $search ])
            . view("components/searchbar")
            . view("search")
            . view("components/footer");
    }

    public function get(): string
    {
        helper("form");
        return view("components/header", [ "title" => "Search" ])
            . view("components/searchbar")
            . view("search")
            . view("components/footer");
    }
}
