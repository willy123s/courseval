<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Grade;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;
use Makkari\Models\Student;

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
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "studId" => $_SESSION['user_id'],
                "currDetailsId" => $_POST['id'],
                "grade" => $_POST['grade'],
                "semester" => $_POST['semester'],
                "schoolyear" => $_POST['sy'],
            );
            $ruleset = array(
                "studId" => ['required'],
                "currDetailsId" => ['required'],
                "grade" => ['required'],
                "semester" => ['required'],
                "schoolyear" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $grade = new Grade(...$data);
                if ($grade->save()) {
                    self::createNotif("Your grade is saved", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/myCurriculums");
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
