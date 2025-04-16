<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() == "POST") {
            $post = $this->request->getPost();

            $userModel = new UserModel();
            $user = $userModel->addUser($post["userEmail"], $post["userName"], $post["userPassword"]);
            if ($user) {
                return redirect()->to("/user/login");
            }
        }

        return view("user_register");
    }

    public function login()
    {
        if (session()->get("id")) {
            return redirect()->back();
        }

        if ($this->request->getMethod() == "POST") {
            $post = $this->request->getPost();
            $userModel = new UserModel();

            $user = $userModel->validateUser($post["userEmail"], $post["userPassword"]);
            if ($user) {
                $data = $userModel->getUser($user);

                $session = session();

                $session->set([
                    "id" => $data["id"],
                    "name" => $data["name"],
                    "profile" => $data["profile"]
                ]);

                return redirect()->to("/");
            }
        }

        return view("user_login");
    }

    public function logout()
    {
        $session = session();
        if ($session->get("id")) {
            $session->destroy();
        }
        return redirect()->to("/");
    }
}
