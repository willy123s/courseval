<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Cours;
use Makkari\Models\Curriculum;
use Makkari\Models\Student;
use Makkari\Models\User;

class Students extends Controller
{
    public static function index()
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/students");
            $students = Student::getAll();
            $data = array(
                "students" => $students,
                "userdata" => self::usersData($_SESSION['user_id'])
            );
            $view->render("/studentsview", $data);
        }
    }
    public static function create()
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/students");
            $data = array(
                "courses" => Cours::getAll(),
                "curriculums" => Curriculum::getAll(),
            );
            $view->render("/addStudent", $data);
        }
    }
    public static function edit($id)
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/students");
            $data = array(
                "student" => Student::getById($id),
                "courses" => Cours::getAll(),
                "curriculums" => Curriculum::getAll(),
            );
            $view->render("editStudent", $data);
        }
    }
    public static function save()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            // $password = self::generatePassword(6);
            $password = "psu12345";
            $data = array(
                "id" => NULL,
                "studNo" => $_POST['stnumber'],
                "fname" => $_POST['fname'],
                "lname" => $_POST['lname'],
                "mname" => $_POST['mname'],
                "email" => $_POST['email'],
                "courseId" => $_POST['course'],
                "currId" => $_POST['curr'],
                "password" => password_hash($password, PASSWORD_BCRYPT),
            );

            $ruleset = array(
                "studNo" => ['required'],
                "fname" => ['required'],
                "lname" => ['required'],
                "mname" => ['required'],
                "email" => ['required'],
                "courseId" => ['required'],
                "currId" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $student = new Student(...$data);
                if ($student->save()) {
                    self::createNotif("New student added. {$password}", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 1);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/students");
    }
    public static function update()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => $_POST['id'],
                "studNo" => $_POST['stnumber'],
                "fname" => $_POST['fname'],
                "lname" => $_POST['lname'],
                "mname" => $_POST['mname'],
                "email" => $_POST['email'],
                "courseId" => $_POST['course'],
                "currId" => $_POST['curr'],
            );

            $ruleset = array(
                "studNo" => ['required'],
                "fname" => ['required'],
                "lname" => ['required'],
                "mname" => ['required'],
                "email" => ['required'],
                "courseId" => ['required'],
                "currId" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $student = Student::getById($data['id']);
                $student->setStudNo($data['studNo']);
                $student->setFname($data['fname']);
                $student->setLname($data['lname']);
                $student->setMname($data['mname']);
                $student->setEmail($data['email']);
                $student->setCourseId($data['courseId']);
                $student->setCurrId($data['courseId']);
                if ($student->save()) {
                    self::createNotif("Student record is now updated.", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 1);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/students");
    }
    public static function confirm($id)
    {
        self::checkAuth();
        if (self::get()) {
            $students = Student::getById($id);
            $view = new View(PAGES_PATH . "/confirm");
            $data = array(
                "target" => "students",
                "id" => $students->getId()
            );
            $view->render("confirm", $data);
        }
    }
    public static function delete()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $student = Student::getById($_POST['id']);
            if ($student->remove()) {
                self::createNotif("Student has been removed", 1);
            } else {
                self::createNotif("Something went wrong. Please try again", 0);
            }
        }
        Redirect::to("/students");
    }
}
