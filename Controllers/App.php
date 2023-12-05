<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\User;

class App extends Controller
{
    public static function index()
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/home");
            $data = array(
                "pageTitle" => "Dashboard",
                "pageDesc" => "",
                "userdata" => self::usersData($_SESSION['user_id'])
            );
            $view->render("dashboard", $data);
        }
    }
}
