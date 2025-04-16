<?php

namespace App\Controllers;

use App\Models\PreviewModel;
use App\Models\ApplicationModel;
use App\Models\ApplicationPreviewModel;

class ApplicationController extends BaseController
{
    public function view(int $id)
    {
        $appModel = new ApplicationModel();
        $prevModel = new PreviewModel();
        $appPrevModel = new ApplicationPreviewModel();

        $app = $appModel->getApplication($id);
        if ($app) {
            $data = [
                "id" => $id,
                "title" => $app["title"],
                "description" => $app["description"]
            ];

            $previews = $appPrevModel->getApplicationPreviews($id);
            if ($previews) {
                foreach($previews as $preview) {
                    $url = $prevModel->getURL($preview);
                    if ($url) {
                        $data["previews"][] = $url;
                    }
                }
            }

            return view("app_view", $data);
        }

        return redirect()->to("/");
    }

    public function submit()
    {
        if ($this->request->getMethod() === "POST") {
            $post = $this->request->getPost();
            if ($post) {
                $appModel = new ApplicationModel();

                $appID = $appModel->addApplication($post["appTitle"], 1, $post["appDescription"]);
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
                                        $previews[] = $prevModel->addPreview($fileName);
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
