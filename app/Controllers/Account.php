<?php

namespace App\Controllers;

use App\Models\AccountModel;

class Account extends BaseController
{
    public function index()
    {
        if (!session()->get("userId")) {
            return redirect()->back();
        }

        $model = new AccountModel();
        $session = session();

        if ($this->request->getMethod() === "POST") {
            $post = $this->request->getPost();

            if (!empty($post["newName"])) {
                $name = trim($post["newName"]);
                $model->setAccountNameById($session->get("userId"), $name);
                $session->set([ "userName" => $name ]);
            }

            if (!empty($post["newEmail"])) {
                $email = trim($post["newEmail"]);
                if (!$model->isEmailUsed($email)) {
                    $model->setAccountEmailById($session->get("userId"), $email);
                }
            }

            if (!empty($post["oldPassword"])) {
                $oldPassword = $post["oldPassword"];
                $newPassword = $post["newPassword"];
                $verifyPassword = $post["verifyPassword"];

                if ($model->validatePassword($session->get("userId"), $oldPassword)) {
                    if ($newPassword === $verifyPassword) {
                        $model->setAccountPasswordById($session->get("userId"), $newPassword);
                    } else {
                        echo "<script>alert('New password does not match');</script>";
                    }
                } else {
                    echo "<script>alert('Old password does match');</script>";
                }
            }

            return redirect()->to("/account");
        }

        return view("parts/header", [ "title" => $session->get("userName") ] )
            . view("account", [
                "userEmail" => $model->getAccountEmailById($session->get("userId"))
            ]) 
            . view("parts/footer");
    }

    public function login()
    {
        if (session()->get("userId")) {
            return redirect()->back();
        }

        if ($this->request->getMethod() === "POST") {
            $post = $this->request->getPost();

            if (!empty($post["email"]) and !empty($post["password"])) {
                $model = new AccountModel();
                $userId = $model->getAccountIdByValidation($post["email"], $post["password"]);
                if ($userId !== 0) {
                    session()->set([
                        "userId" => $userId,
                        "userName" => $model->getAccountNameById($userId),
                        "userPrivilege" => $model->getAccountPrivilegeById($userId),
                    ]);

                    return redirect()->to("/");
                } else {
                    session()->setFlashdata("error", "Given email or password is wrong...");
                }
            } else {
                session()->setFlashdata("error", "No email or password given...");
            }

            return redirect()->to("/login");
        }

        return view("parts/header", [ "title" => "Home" ]) 
            . view("login")
            . view("parts/footer");
    }

    public function register()
    {
        if ($this->request->getMethod() == "POST") {
            $post = $this->request->getPost();
            if (empty($post["email"])) {
                return redirect()->to("/register");
            }

            $model = new AccountModel();
            if ($model->isEmailUsed($post["email"])) {
                return redirect()->to("/register");
            }

            if (!$model->createNewAccount($post["name"], $post["email"], $post["password"])) {
                return redirect()->to("/register");
            }

            return redirect()->to("/login");
        }

        return view("parts/header", [ "title" => "Home" ]) 
            . view("register")
            . view("parts/footer");
    }

    public function logout()
    {
        $session = session();
        if (!empty($session)) {
            $session->destroy();
        }
    }

    public function elevate()
    {
        $session = session();
        if ($session->get("userId")) {
            $model = new AccountModel();
            $model->elevateAccountById($session->get("userId"));
            $session->set([ "userPrivilege" => 1 ]);
        }

        return redirect()->back();
    }
}
