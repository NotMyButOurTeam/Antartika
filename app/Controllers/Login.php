<?php

namespace App\Controllers;

use App\Models\AccountModel;

class Login extends BaseController
{
    public function index(): string
    {
        helper("form");
        return view("components/header", [ "title" => "Login" ])
            . view("login")
            . view("components/footer");
    }

    public function auth()
    {
        $name = $this->request->getPost("name");
        $password = $this->request->getPost("password");

        $model = new AccountModel();
        if ($model->isValid($name, $password)) {
            return redirect()->to("/");
        }

        return redirect()->to("/login");
    }
}
