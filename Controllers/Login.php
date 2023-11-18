<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;

class Login extends Controller
{
    public static function index()
    {
        self::isLogedIn("/");
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/login");
            $view->render("login");
        }
    }
    public static function admin()
    {
        self::isLogedIn("/");
        if (self::get()) {
            $view = new View(PAGES_PATH . "/login");
            $view->render("adminlogin");
        }
    }
    public static function create()
    {
        // Your code here
    }
    public static function edit()
    {
        // Your edit code goes here
    }
    public static function save()
    {
        // Your save code goes here
    }

    public static function confirm()
    {
        // Your code goes here
    }
    public static function delete()
    {
        //your delete code goes here
    }
}
