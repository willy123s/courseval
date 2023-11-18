<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Cours;
use Makkari\Models\User;

class Users extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/users");
            $data = array(
                "users" => User::getAll(),
                "userdata" => self::usersData($_SESSION['user_id'])
            );
            $view->render("usersview", $data);
        }
    }
    public static function create()
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/users");
            $data = array(
                "courses" => Cours::getAll()
            );
            $view->render("addUser", $data);
        }
    }
    public static function edit()
    {
        // Your edit code goes here
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $password = self::generatePassword(6);
            $data = array(
                "id" => NULL,
                "empno" => $_POST['empno'],
                "fname" => $_POST['fname'],
                "lname" => $_POST['lname'],
                "mname" => $_POST['mname'],
                "email" => $_POST['email'],
                "password" => password_hash($password, PASSWORD_BCRYPT),
                "courseId" => $_POST['course'],
                "userType" => $_POST['userType'],
            );

            $ruleset = array(
                "empno" => ['required'],
                "fname" => ['required'],
                "lname" => ['required'],
                "email" => ['required'],
                "courseId" => ['required'],
                "userType" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $user = new User(...$data);
                if ($user->save()) {
                    self::createNotif("New user added.", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 1);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/users");
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
