<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ReviewModel;
use App\Models\PreviewModel;
use App\Models\ApplicationModel;
use App\Models\ApplicationPreviewModel;
use App\Models\ApplicationReviewModel;

class ApplicationController extends BaseController
{
    public function search(): string
    {
        $get = $this->request->getGet();
        $data = [];

        $data["query"] = "Search";
        if (!empty($get["q"])) {
            $data["query"] = $get["q"];
        }

        $appModel = new ApplicationModel();
        $apps = $appModel->searchApplications($get["q"]);
        if ($apps) {
            $data["results"] = $apps;
        }

        return view("app_search", $data);
    }

    public function view(int $id)
    {
        $userModel = new UserModel();
        $appModel = new ApplicationModel();
        $prevModel = new PreviewModel();
        $appPrevModel = new ApplicationPreviewModel();
        $revModel = new ReviewModel();
        $appRevModel = new ApplicationReviewModel();

        if ($this->request->getMethod() === "POST") {
            $session = session();
            $post = $this->request->getPost();
            if ($session->get("id")) {
                $reviews = $appRevModel->getApplicationReviews($id);

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
                        $appRevModel->addApplicationReview($id, $review);
                    }
                }
            }

            return redirect()->back();
        }

        $app = $appModel->getApplication($id);
        if ($app) {
            $data = [
                "id" => $id,
                "title" => $app["title"],
                "description" => $app["description"]
            ];

            $previews = $appPrevModel->getApplicationPreviews($id);
            if ($previews) {
                foreach ($previews as $preview) {
                    $url = $prevModel->getURL($preview);
                    if ($url) {
                        $data["previews"][] = $url;
                    }
                }
            }

            $reviews = $appRevModel->getApplicationReviews($id);
            if ($reviews) {
                $rating = 0.0;
                $rating_count = 0;
                foreach ($reviews as $review) {
                    $content = $revModel->getReview($review);
                    if ($content) {
                        $writer = $userModel->getUser($content["writer"]);
                        if ($writer) {
                            unset($content["writer"]);
                            $data["reviews"][] = [
                                "writer" => $writer,
                                "content" => $content
                            ];

                            $rating += $content["rating"];
                            $rating_count += 1;
                        }
                    }
                }

                $rating = $rating / $rating_count;
                $data["rating"] = $rating;
            }

            $publisher = $userModel->getUser($app["publisher"]);
            $data["publisher"] = $publisher;

            return view("app_view", $data);
        }

        return redirect()->to("/");
    }

    public function submit()
    {
        if (!session()->get("id")) return redirect()->back();

        if ($this->request->getMethod() === "POST") {
            $post = $this->request->getPost();
            if ($post) {
                $appModel = new ApplicationModel();

                $appID = $appModel->addApplication($post["appTitle"], session()->get("id"), 
                    $post["appDescription"]);
                if ($appID) {
                    $files = $this->request->getFiles();
                    if ($files) {
                        if (isset($files["appIcon"]) 
                            && $files["appIcon"]->isValid()
                            && !$files["appIcon"]->hasMoved()) {
                            $uploadPath = FCPATH . "uploads/apps/icons/";
                            $fileName = sprintf("%05d.png", $appID);
                            $filePath = $uploadPath . $fileName;

                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }

                            $files["appIcon"]->move($uploadPath, $fileName);
                        }

                        if (isset($files["appPreviews"])) {
                            $prevModel = new PreviewModel();
                            $appPrevModel = new ApplicationPreviewModel();

                            $previews = [];
                            foreach ($files["appPreviews"] as $file) {
                                if ($file->isValid() && !$file->hasMoved()) {
                                    log_message("info", print_r($file));
                                    $uploadPath = FCPATH . "uploads/apps/previews/";
                                    $fileName = $file->getName();
                                    $filePath = $uploadPath . $fileName;

                                    if (file_exists($filePath)) {
                                        unlink($filePath);
                                    }

                                    if($file->move($uploadPath, $fileName)) {
                                        $preview = $prevModel->addPreview($fileName);
                                        if ($preview) {
                                            $previews[] = $preview;
                                        }
                                    }
                                }
                            }

                            foreach ($previews as $preview) {
                                $appPrevModel->addApplicationPreview($appID, $preview);
                            }
                        }
                    }

                    return redirect()->to("app/" . sprintf("%05d", $appID));
                }
            }
        }

        return view("app_submit");
    }
}
