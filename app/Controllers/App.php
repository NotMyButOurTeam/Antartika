<?php

namespace App\Controllers;

use CodeIgniter\BaseControler;

use App\Models\AppModel;
use App\Models\AccountModel;

class App extends BaseController
{
    private function uploadAppIcon(int $appId, $file)
    {
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . "uploads/apps/icons/";
            $fileName = sprintf("%05d.png", $appId);
            $filePath = $uploadPath . $fileName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $file->move($uploadPath, $fileName);
        }
    }

    public function index()
    {
        return redirect()->to("/");
    }

    public function search()
    {
        $model = new AppModel();
        $query = trim($this->request->getGet("q"));
        $data = null;

        if (empty($query)) {
            $query = "Search";
            $data = $model->searchApps("");
        } else {
            $data = $model->searchApps($query);
        }

        return view("parts/header", [ "title" => $query ]) 
            . view("apps/search", [ "data" => $data ] )
            . view("parts/footer");
    }

    public function view(int $id)
    {
        $appModel = new AppModel();
        $accountModel = new AccountModel();

        $app = $appModel->getAppById($id);
        $publisher = $accountModel->getAccountNameById($app["publisher"]);

        return view("parts/header", [ "title" => $app["name"] ]) 
            . view("apps/view", [ "app" => $app, "publisher" => $publisher ] ) 
            . view("parts/footer");
    }

    public function publish()
    {
        if ($this->request->getMethod() == "POST") {
            $file = $this->request->getFile("appIconFile");
            $post = $this->request->getPost();
            $model = new AppModel();

            echo "<script>console.log($file);</script>";

            $id = $model->createApp($post["appName"], $post["appDescription"], session()->get("userId"), $post["appCategory"]);
            $this->uploadAppIcon($id, $file);

            return redirect()->to("/apps/id/" . $id);
        }

        return view("parts/header", [ "title" => "Publish Your App" ]) 
            . view("apps/publish") 
            . view("parts/footer");
    }

    public function category()
    {
        return view("parts/header", [ "title" => "Category" ]) 
            . view("apps/category") 
            . view("parts/footer");
    }

    public function dashboard()
    {
        if (session()->get("userId")) {
            $mode = new AppModel();
            $apps = $mode->getAppsByPublisher(session()->get("userId"));

            return view("parts/header", [ "title" => "Category" ]) 
                . view("apps/dashboard", [ "apps" => $apps ] ) 
                . view("parts/footer");
        }

        return redirect()->back();
    }

    public function ranking()
    {
        return view("parts/header", [ "title" => "Ranking" ]) 
            . view("apps/ranking") 
            . view("parts/footer");
    }

    public function ban()
    {
        if (session()->get("userId")) {
            $post = $this->request->getPost();
            $model = new AppModel();

            $model->banApp($post["appId"]);
        }

        return redirect()->to("/apps");
    }
}
