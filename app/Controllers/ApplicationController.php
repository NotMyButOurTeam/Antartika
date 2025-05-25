<?php

namespace App\Controllers;

use App\Models\TagModel;
use App\Models\UserModel;
use App\Models\ModeratorModel;
use App\Models\ReviewModel;
use App\Models\PreviewModel;
use App\Models\ApplicationModel;
use App\Models\ApplicationTagModel;
use App\Models\ApplicationPreviewModel;
use App\Models\ApplicationReviewModel;
use App\Models\ApplicationVerificationModel;

class ApplicationController extends BaseController
{
    public function edit()
    {
        $s = session();
        if (!$s->get("id")) return redirect()->back();

        $appModel = new ApplicationModel();
        $appID = $this->request->getGet("id");

        $app = $appModel->getApplication($appID);
        if (!$app) return redirect()->back();

        if ($app["publisher"] != $s->get("id"))
            return redirect()->back();

        $tagModel = new TagModel();
        $appTagModel = new ApplicationTagModel();

        if ($this->request->getMethod() === "POST") {
            $post = $this->request->getPost();

            $tagline = $post["newTags"];
            if (!empty($tagline)) {
                $appTagModel->removeApplicationTags($appID);
            }

            foreach (explode("#", $tagline) as $t) {
                $t = trim($t);
                if ($t) {
                    if (!$tagModel->searchTag($t)) {
                        $tagModel->addTag($t);
                    }

                    $tag = $tagModel->searchTag($t);

                    $appTagModel->addApplicationTag($appID, $tag);
                }
            }

            $appModel->updateApplication($appID, 
                title: $post["newTitle"], 
                description: $post["newDescription"],
                source: $post["newSource"]);
            return redirect()->to("/app/" . sprintf("%05d", $appID));
        }

        $tags = "";
        $appTags = $appTagModel->getApplicationTags($appID);
        if ($appTags) {
            foreach($appTags as $appTag) {
                $tag = $tagModel->getString($appTag);
                $tags = $tags . "#" . $tag . " ";
            }
        }

        $app["tags"] = $tags;
        return view("app_edit", $app);
    }

    public function search(): string
    {
        $get = $this->request->getGet();
        $data = [];

        $data["query"] = "Search";
        if (!empty($get["q"])) {
            $data["query"] = $get["q"];
        }

        $tagModel = new TagModel();
        $appTagModel = new ApplicationTagModel();
        $appModel = new ApplicationModel();
        $apps = [];
        if (!empty($get["q"]) && $get["q"][0] === "#") {
            $tags = [];
            foreach (explode("#", $get["q"]) as $t) {
                $t = trim($t);
                if (!empty($t)) {
                    $tag = $tagModel->searchTag($t);
                    $tags[] = $tag;
                }
            }

            $appIDs = [];
            foreach ($tags as $tag) {
                if (!empty($tag)) {
                    $appIDs = array_merge($appTagModel->getApplicationsTagged($tag), 
                        $appIDs);
                }
            }

            if ($appIDs) {
                $appIDsDiff = array_unique(array_diff_assoc($appIDs, array_unique($appIDs)));
                if (!empty($appIDsDiff)) {
                    $appIDs = $appIDsDiff;
                }
                foreach ($appIDs as $appID) {
                    $app = $appModel->getApplication($appID);
                    if ($app) {
                        $apps[] = $app;
                    }
                }
            }
        } else {
            $apps = $appModel->searchApplications($get["q"]);
        }

        if (!empty($get["q"])) {
            $data["search"] = $get["q"];
        }

        $appVerModel = new ApplicationVerificationModel();

        for ($i = 0; $i < count($apps); $i++) {
            if (!$appVerModel->isApplicationVerified($apps[$i]["id"])) {
                unset($apps[$i]);
            }
        }

        if ($apps) {
            $data["results"] = $apps;
        }


        return view("app_search", $data);
    }

    public function view(int $id)
    {
        $userModel = new UserModel();
        $modModel = new ModeratorModel();
        $appModel = new ApplicationModel();
        $prevModel = new PreviewModel();
        $tagModel = new TagModel();
        $revModel = new ReviewModel();
        $appPrevModel = new ApplicationPreviewModel();
        $appRevModel = new ApplicationReviewModel();
        $appTagModel = new ApplicationTagModel();
        $appVerModel = new ApplicationVerificationModel();

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
                            $revModel->updateReview($r["id"],
                                $post["reviewRating"],
                                $post["reviewContent"]
                            );
                            $continue = false;
                            break;
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
                "description" => $app["description"],
                "source" => $app["source"]
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

            $tags = "";
            $appTags = $appTagModel->getApplicationTags($id);
            if ($appTags) {
                foreach($appTags as $appTag) {
                    $tag = $tagModel->getString($appTag);
                    $tags = $tags . "#" . $tag . " ";
                }
            }

            $data["tags"] = $tags;

            $publisher = $userModel->getUser($app["publisher"]);
            $data["publisher"] = $publisher;

            if (!$appVerModel->isApplicationVerified($id)) {
                if (session()->get("id") 
                    && session()->get("id") === $app["publisher"]) {
                } else if (session()->get("id") 
                    && $modModel->isModerator(session()->get("id"))) {
                } else {
                    return redirect()->to("/");
                }

                $data["is_verified"] = false;
            }

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
                    $post["appDescription"], $post["appSource"]);
                if ($appID) {
                    $appVerMod = new ApplicationVerificationModel();
                    $appVerMod->addApplication($appID);

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

                    $tagModel = new TagModel();
                    $appTagModel = new ApplicationTagModel();

                    $tagline = $post["appTags"];
                    foreach (explode("#", $tagline) as $t) {
                        $t = trim($t);
                        if ($t) {
                            if (!$tagModel->searchTag($t)) {
                                $tagModel->addTag($t);
                            }

                            $tag = $tagModel->searchTag($t);

                            $appTagModel->addApplicationTag($appID, $tag);
                        }
                    }

                    return redirect()->to("app/" . sprintf("%05d", $appID));
                }
            }
        }

        return view("app_submit");
    }
}
