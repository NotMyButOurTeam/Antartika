<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ReviewModel;
use App\Models\ModeratorModel;
use App\Models\PublisherModel;
use App\Models\ApplicationModel;
use App\Models\PublisherReviewModel;

class UserController extends BaseController
{
    public function dashboard()
    {
        $pubModel = new PublisherModel();

        $session = session();
        if (!$session->get("id")){
            return redirect()->to("");
        }

        $is_publisher = $pubModel->isPublisher($session->get("id"));
        if (!$is_publisher) {
            return redirect()->back();
        }

        $appModel = new ApplicationModel();
        $apps = $appModel->searchApplicationsByPublisher($session->get("id"));

        return view("user_dashboard", ["apps" => $apps]);
    }

    public function edit()
    {
        $session = session();

        if (!$session->get("id")) {
            return redirect()->back();
        }

        $userModel = new UserModel();
        $pubModel = new PublisherModel();
        $data = $userModel->getUser($session->get("id"));
        $data["is_publisher"] = $pubModel->isPublisher($session->get("id"));

        if ($this->request->getMethod() === "POST") {
            $post = $this->request->getPost();
            $file = $this->request->getFile("newProfile");

            if ($file) {
                $uploadPath = FCPATH . "uploads/users/profiles/";
                $fileName = sprintf("%05d.png", $session->get("id"));
                $filePath = $uploadPath . $fileName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $file->move($uploadPath, $fileName);
            }

            $password = null;
            if ($userModel->validateUser($session->get("id"), 
                $post["oldPassword"])) {
                $password = $post["newPassword"];
            }

            $userModel->updateUser($session->get("id"), 
                email: $post["newEmail"],
                name: $post["newName"],
                profile: $post["newProfile"],
                password: $password,
            );

            return redirect()->back();
        }

        return view("user_edit", $data);
    }

    public function view(int $id)
    {
        $userModel = new UserModel();
        $pubModel = new PublisherModel();
        $pubRevModel = new PublisherReviewModel();
        $revModel = new ReviewModel();

        if ($this->request->getMethod() === "POST") {
            $session = session();
            $post = $this->request->getPost();
            if ($session->get("id")) {
                $reviews = $pubRevModel->getPublisherReviews($id);
                $reputation = $pubModel->getReputation($id);

                $continue = true;
                foreach ($reviews as $review) {
                    $r = $revModel->getReview($review);
                    if ($r) {
                        if ($r["writer"] === $session->get("id")) {
                            $continue = false;
                        }
                    }
                }

                if ($continue) {
                    $review = $revModel->addReview($session->get("id"),
                        $post["reviewRating"],
                        $post["reviewContent"]
                    );

                    if ($review > 0) {
                        $pubRevModel->addPublisherReview($id, $review);
                        $pubModel->updateReputation($id, $reputation + $post["reviewRating"]);
                    }
                }
            }

            return redirect()->back();
        }

        $user = $userModel->getUser($id);
        $user["reputation"] = $pubModel->getReputation($user["id"]);
        if ($user["reputation"]) {
            $reviews = $pubRevModel->getPublisherReviews($id);
            if ($reviews) {
                foreach ($reviews as $review) {
                    $content = $revModel->getReview($review);
                    if ($content) {
                        $writer = $userModel->getUser($content["writer"]);
                        if ($writer) {
                            unset($content["writer"]);
                            $user["reviews"][] = [
                                "writer" => $writer,
                                "content" => $content
                            ];
                        }
                    }
                }
            }
        }

        $user["is_publisher"] = $pubModel->isPublisher($user["id"]);

        return view("user_view", $user);
    }

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
            $pubModel = new PublisherModel();
            $modModel = new ModeratorModel();

            $user = $userModel->validateUser($post["userEmail"], $post["userPassword"]);
            if ($user) {
                $data = $userModel->getUser($user);

                $session = session();

                $session->set([
                    "id" => $data["id"],
                    "name" => $data["name"],
                    "profile" => $data["profile"],
                    "is_publisher" => $pubModel->isPublisher($data["id"]),
                    "is_moderator" => $modModel->isModerator($data["id"])
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
        return redirect()->back();
    }
}
