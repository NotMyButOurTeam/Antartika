<?php

namespace App\Controllers;

class Search extends BaseController
{
    public function search(): string
    {
        helper("form");
        if ($this->request->getMethod() == "POST") {
            $search = $this->request->getPost("search");

            return view("components/header", [ "title" => $search ])
                . view("components/searchbar")
                . view("search")
                . "<h2>" . $search . "</h2>"
                . view("components/footer");
        }

        return view("components/header", [ "title" => "Search" ])
            . view("components/searchbar")
            . view("search")
            . view("components/footer");
    }
}
