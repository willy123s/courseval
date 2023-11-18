<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;

class Grades extends Controller
{
    public static function index()
    {
        // Your code here
    }
    public static function create($id)
    {
        self::checkAuth();
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/std");
            $data = array(
                "id" => $id,
                "semesters" => Semester::getAll(),
                "schoolyear" => Schoolyear::getAll()
            );
            $view->render("addGrade", $data);
        }
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
