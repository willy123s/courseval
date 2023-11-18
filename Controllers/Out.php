<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Activitylog;

require_once("./Controllers/Controller.php");

class Out extends Controller
{
    public static function index()
    {
        // Record Logs
        session_destroy();
        header("Location: /clogin");
    }
}
