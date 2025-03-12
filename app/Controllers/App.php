<?php

namespace App\Controllers;

use App\Models\AppModel;

class App extends BaseController
{
    public function view(int $id)
    {
        $model = new AppModel();
        $result = $model->getAppById(esc($id));

        return view("components/header", [ "title" => $result["name"]]) 
            . view("app", [ "app" => $result ]) 
            . view("components/footer");
    }

    public function publish()
    {
    }
}
