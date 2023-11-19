<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Semester;
use Makkari\Models\Yearlevel;

class Coursecheck extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/std");
            $data = array(
                "userdata" => self::usersData($_SESSION['user_id']),
                "yearlevels" => Yearlevel::getAll(),
                "semesters" => Semester::getAll()
            );
            $view->render("coursecheck", $data);
        }
    }
    public static function load()
    {
        if (self::post()) {
            $userdata = self::usersData($_SESSION['user_id']);
            $data = array(
                "year" => $_POST['year'],
                "sem" => $_POST['sem'],
                "currid" => $userdata->getCurrId()
            );

            $curr = Curriculumdetail::getCourseCheck(...$data);
            $view = new View(PAGES_PATH . "/std");
            $load = array(
                "loads" => $curr
            );
            $view->render("loadedsubjects", $load);
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
