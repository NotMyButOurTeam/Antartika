<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view("parts/header", [ "title" => "Home" ]) 
            . view("home")
            . view("parts/footer");
    }
}
