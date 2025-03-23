<?php

namespace App\Models;

use CodeIgniter\Model;


class AppSourceModel extends Model
{
    protected $table = "AppSource";
    protected $allowedFields = [ 
        "app",
        "target",
        "title",
        "link"
    ];

    public $appSourceTargets = [
        // Desktop 0 - 5
        "Linux 32-bit",
        "Linux 64-bit",
        "Windows 32-bit",
        "Windows 64-bit",
        "MacOS Arm",
        "MacOS Intel"
    ];
}
