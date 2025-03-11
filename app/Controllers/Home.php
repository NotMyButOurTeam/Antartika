<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        helper("form");
        return view("components/header", [ "title" => "Home" ])
            . view("home")
            . view("components/footer");
    }
}
