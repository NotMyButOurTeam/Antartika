<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ApplicationModel;
use App\Models\ApplicationVerificationModel;
use App\Models\ModeratorModel;

class ModeratorController extends BaseController
{
    public function panel()
    {
        $s = session();
        if (!$s->get("id")) return redirect()->to("/");

        $modModel = new ModeratorModel();
        if (!$modModel->isModerator($s->get("id"))) 
            return redirect()->to("/");

        $appModel = new ApplicationModel();
        $appVerModel = new ApplicationVerificationModel();

        $data = [];

        $apps = [];
        $appIDs = $appVerModel->getUnverifiedApplications();
        foreach($appIDs as $appID) {
            $app = $appModel->getApplication($appID["app"]);
            if ($app) {
                $apps[] = $app;
            }
        }

        if ($apps) {
            $data["apps"] = $apps;
        }

        return view("moderator_panel", $data);
    }

    public function verifyApplication()
    {
        if ($this->request->getMethod() !== "POST")
            return redirect()->to("/");

        $s = session();
        if (!$s->get("id")) return redirect()->to("/");

        $modModel = new ModeratorModel();
        if (!$modModel->isModerator($s->get("id"))) 
            return redirect()->to("/");

        $post = $this->request->getPost();

        $appVerModel = new ApplicationVerificationModel();
        if (!$appVerModel->isApplicationVerified($post["app"])) {
            $appVerModel->verifyApplication($post["app"], $s->get("id"));
        }

        return redirect()->back();
    }
}
