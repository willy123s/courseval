<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Controllers\Controller;
use Makkari\Models\Semester;

class Semesters extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/semesters");
            $data = array(
                "pageTitle" => "Courses",
                "pageDesc" => "Manage courses",
                "userdata" => self::usersData($_SESSION['user_id']),
                "semesters" => Semester::getAll()
            );
            $view->render("semsestersview", $data);
        }
    }
    public static function create()
    {
        // Your code here
    }
    public static function edit($id)
    {
        if (self::get()) {
            self::csrfToken();
            $semester = Semester::getById($id);
            $data = array(
                "semid" => $semester->getId()
            );
            $view = new View(PAGES_PATH . "/semesters");
            $view->render("activate", $data);
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $semesters = Semester::getAll();
            foreach ($semesters as $semester) {
                $semester->setStatus("");
                $semester->save();
            }

            $sem = Semester::getById($_POST['id']);
            $sem->setStatus($_POST['status']);
            if ($sem->save()) {
                self::createNotif("Semester is now active", 1);
            } else {
                self::createNotif("Something went wrong. Please try again.", 0);
            }
        } else {
            self::createNotif("Something went wrong. Please try again.", 0);
        }
        Redirect::to("/semesters");
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
