<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class File extends Controller
{
    public function uploadProfileImage()
    {
        if (session()->get("userId")) {
            $file = $this->request->getFile("file");

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $uploadPath = FCPATH . "uploads/accounts/profiles/";
                $fileName = sprintf("%05d.png", session()->get("userId"));
                $filePath = $uploadPath . $fileName;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $file->move($uploadPath, $fileName);
            }
        }

        return redirect()->back();
    }

}
