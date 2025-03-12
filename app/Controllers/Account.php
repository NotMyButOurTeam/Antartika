<?php

namespace App\Controllers;

use App\Models\AccountModel;

class Account extends BaseController
{
    public function login()
    {
        if (session()->get("user_id")) {
            return redirect()->to("/");
        }

        if ($this->request->getMethod() == "POST") {
            return $this->auth_login();
        }

        return view("components/header", [ "title" => "Login" ])
            . view("login")
            . view("components/footer");
    }

    public function register()
    {
        if (session()->get("user_id")) {
            return redirect()->to("/");
        }

        if ($this->request->getMethod() == "POST") {
            return $this->auth_register();
        }

        return view("components/header", [ "title" => "Register" ])
            . view("register")
            . view("components/footer");
    }

    public function logout()
    {
        if (session()->get("user_id")) {
            session()->destroy();
        }

        return redirect()->to("/");
    }

    public function ascend()
    {
        $session = session();
        if ($session->get("user_id")) {
            $model = new AccountModel();

            if($model->escalatePrivilege($session->get("user_id"))) {
                $data = $model->getDataById($session->get("user_id"));

                $session->set([
                    "user_privilege" => $data["privilege"]
                ]);

                return redirect()->to("/");
            }
        }
    }

    private function auth_login()
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        $model = new AccountModel();
        if ($model->isAccountValid($email, $password)) {
            $data = $model->getDataById($model->getIdByEmail($email));

            $session = session();
            $session->set([
                "user_id" => $data["id"],
                "user_email" => $data["email"],
                "user_name" => $data["name"],
                "user_privilege" => $data["privilege"]
            ]);

            return redirect()->to("/");
        }

        return redirect()->to("/login");
    }

    private function auth_register()
    {
        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $password0 = $this->request->getPost("password0");
        $password1 = $this->request->getPost("password1");

        $model = new AccountModel();
        if ($model->isEmailUsed($email) or $password0 != $password1 
            or $name == "" or $email == "" or $password0 == "") {
            return redirect()->to("/register");
        }

        $model->save([
            "name" => $name,
            "email" => $email,
            "password" => $password0,
            "privilege" => "user"
        ]);

        return redirect()->to("/login");
    }
}
