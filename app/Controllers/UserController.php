<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() == "POST") {
            return redirect()->to("/user/login");
        }

        return view("user_register");
    }

    public function login()
    {
        if ($this->request->getMethod() == "POST") {
            return redirect()->to("/");
        }

        return view("user_login"):
    }
}
