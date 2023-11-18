<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Cours;
use PDO;

class Courses extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/courses");
            $data = array(
                "courses" => Cours::getAll(),
            );
            $view->render("coursesview", $data);
        }
    }
    public static function create()
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/courses");
            $view->render("addCourse");
        }
    }
    public static function edit($id)
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/courses");
            $data = array(
                "course" => Cours::getById($id),
            );
            $view->render("editCourse", $data);
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "course" => self::clean($_POST['course']),
                "description" => self::clean($_POST['description']),
            );

            $rulset = array(
                "course" => ['required'],
                "description" => ['required'],
            );

            $validate = Validations::validateData($data, $rulset);
            if (empty($validate->errors)) {
                $course = new Cours(...$data);
                if ($course->save()) {
                    self::createNotif("New course added", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/courses");
    }
    public static function update()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => self::clean($_POST['id']),
                "course" => self::clean($_POST['course']),
                "description" => self::clean($_POST['description']),
            );

            $rulset = array(
                "course" => ['required'],
                "description" => ['required'],
            );

            $validate = Validations::validateData($data, $rulset);
            if (empty($validate->errors)) {
                $course = Cours::getById($data['id']);
                $course->setCourse($data['course']);
                $course->setDescription($data['description']);
                if ($course->save()) {
                    self::createNotif("Course is now updated", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/courses");
    }
    public static function confirm($id)
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/confirm");
            $data = array(
                "target" => "courses",
                "id" => $id,
            );
            $view->render("confirm", $data);
        }
    }
    public static function remove()
    {
        if (self::post() and self::verifyRequest()) {
            $course = Cours::getById($_POST['id']);
            if ($course->remove()) {
                self::createNotif("Course is now deleted", 1);
            } else {
                self::createNotif("Something went wrong. Please try again.", 0);
            }
        }
        Redirect::to("/courses");
    }
}
